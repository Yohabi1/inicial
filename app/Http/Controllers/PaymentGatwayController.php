<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentGatway;

use App\General;
use App\Deposit;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Transaction;
use App\DepositRequest;

use App\Lib\coinPayments;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PaymentGatwayController extends Controller
{
    public function addDeposit() {
        $data['gateways'] = PaymentGatway::where('status', 1)->get();
        $data['page_title'] = 'Add Fund';
        return view('user.deposit.deposit', $data);
    }

    public function depositAmountInsert(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'gateway' => 'required|integer'
        ]);

       $gateway = PaymentGatway::whereStatus(1)->whereId($request->gateway)->first();
       if ($gateway instanceof PaymentGatway){
           $trx = Str::random(16);
           if ($gateway->minimum_deposit_amount <= $request->amount && $gateway->maximum_deposit_amount >= $request->amount) {
               $charge = $gateway->fixed_charge + ($request->amount * $gateway->percentage_charge / 100);
               $usdamo = ($request->amount + $charge) / $gateway->rate;

               if ($gateway->id > 69) {
                   $dr = new DepositRequest;
                   $dr->user_id = Auth::user()->id;
                   $dr->gateway_id = $gateway->id;
                   $dr->amount = floatval($request->amount);
                   $dr->charge = $charge;
                   $dr->usd_amo = floatval($usdamo);
                   $dr->trx = $trx;
                   if ($request->hasFile('receipt')) {
                       $image = $request->file('receipt');
                       if (!in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                           Session::flash('alert', 'File format must be jpg, jpeg, png');
                           return redirect()->back();
                       }
                       $fileName = time() . '.jpg';
                       $location = './public/images/receipt_img/' . $fileName;
                       Image::make($image)->save($location);
                       $dr->r_img = $fileName;
                   } else {
                       Session::flash('alert', 'Receipt image is required');
                       return redirect()->back();
                   }
                   $dr->save();
               }
               $depo['user_id'] = Auth::id();
               $depo['gateway_id'] = $gateway->id;
               $depo['amount'] = $request->amount;
               $depo['charge'] = $charge;
               $depo['usd_amo'] = round($usdamo, 2);
               $depo['btc_amo'] = 0;
               $depo['btc_wallet'] = "";
               $depo['trx'] = $trx;
               $depo['try'] = 0;
               $depo['status'] = 0;
               Deposit::create($depo);
               Session::put('Track', $depo['trx']);
               return redirect()->route('user.deposit.preview');
           }
           return back()->with('alert', 'Minimum :'.$gateway->minimum_deposit_amount. ' & Maximum'. $gateway->maximum_deposit_amount.' amount is required for '.$gateway->name);
       }
        return back()->with('alert', 'Gateway not found please try again.');
    }

    public function depositPreview(){
        $track = Session::get('Track');
        $data = Deposit::where('status',0)->where('trx',$track)->first();

        
        $drcount = DepositRequest::where('trx',$track)->count();
        if ($drcount > 0) {
            $dr = DepositRequest::where('trx',$track)->first();
        } else {
            $dr = '';
        }
        $page_title = 'Deposit Preview';
        $data['gateways'] = PaymentGatway::where('status', 1)->get();

        return view('user.deposit.preview',$data ,compact('page_title','data', 'dr'));
    }

      public function depositPayNow(){

        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $gnl = General::first();

        if(!$data instanceof Deposit) {

            return redirect()->route('users.showDepositMethods')->with('alert', 'Invalid Deposit Request');
        }

        try {
            $method = $data->gateway;

            if ($data->gateway_id == 1){
                return App::call('App\Http\Controllers\PayPalController@payment');
            }

            if ($data->gateway_id == 8){

                $skrill = new SkrillPaymentController;
                return $skrill->makePayment(); 
           }

            if ($data->gateway_id == 7){

                $page_title = $data->gateway->name;
               return view('user.deposit.payment_views.paytm',$data, compact('track','page_title'));  
           }

            if ($data->gateway_id == 6){
                $page_title = $data->gateway->name;
               return view('user.deposit.payment_views.rave',$data, compact('track','page_title'));  
           }

            if ($data->gateway_id == 5){
               
                $gatewayData = $data;
                $page_title = $gatewayData->name;
                $data['gateways'] = PaymentGatway::where('status', 1)->get();
                $gateway = PaymentGatway::find(5);
                config([
                    'paystack.publicKey'     => $gateway->gateway_key_one,
                    'paystack.secretKey'     => $gateway->gateway_key_two,
                    'paystack.paymentUrl'     => 'https://api.paystack.co',
                    'paystack.merchantEmail'     => $gateway->gateway_key_three,
                ]);
           
                return view('user.deposit.payment_views.paystack',$data, compact('track','page_title','gatewayData'));
                 
            }

            if ($data->gateway_id == 2){

            	$all = file_get_contents("https://blockchain.info/ticker");
               $res = json_decode($all);
               $btcrate = $res->USD->last;
               $amon = $data->amount;
               $usd = $data->usd_amo;
               $bcoin = round($usd/$btcrate,8);
               $callbackUrl = route('ipn.coinpayemnt');
               $CP = new coinPayments();


               $CP->setMerchantId($method->gateway_key_one);
               $CP->setSecretKey($method->gateway_key_two);
               $ntrc = $data->trx;
               $form = $CP->createPayment('Deposit', 'BTC',  $bcoin, $ntrc, $callbackUrl);
               $page_title = $method->name;
               $data['gateways'] = PaymentGatway::where('status', 1)->get();
               return view('user.deposit.payment_views.coinpay',$data, compact('bcoin','form','page_title','amon', 'gnl'));
            }

           if ($data->gateway_id == 3){
            $gatewayData = $data->gateway;
             $page_title = $gatewayData->name;
             $data['gateways'] = PaymentGatway::where('status', 1)->get();
              return view('user.deposit.payment_views.stripe',$data, compact('track','page_title','gatewayData'));
            }

            if ($data->gateway_id == 4) {
                $url = 'https://www.payfast.co.za/eng/process'; //https://sandbox.payfast.co.za​/eng/process
                $user = Auth::user();
                $n = explode(" ",$user->name);
                if(count($n) > 1){
                    $fn =$n['0'];
                    $ln =$n['1'];
                }else{
                    $fn =$user->name;
                    $ln =$user->name;
                }
                // Construct variables
                $cartTotal = floatval($data->usd_amo);// This amount needs to be sourced from your application
                $payFast = array(
                    // Merchant details
                    'merchant_id' => $data->gateway->gateway_key_one,
                    'merchant_key' => $data->gateway->gateway_key_two,

                    'return_url' => route('payfast.payment.success'),
                    'cancel_url' => route('payfast.payment.cancel'),
                    'notify_url' => route('payfast.payment.notify'),

                    // Buyer details
                    'name_first' => $fn,
                    'name_last'  => $ln,
                    'email_address'=> $user->email,
                    // Transaction details
                    'm_payment_id' => $data->trx, //Unique payment ID to pass through to notify_url
                    'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
                    'item_name' => 'Deposit#'.$data->trx
                );

                $signature = $this->generateSignature($payFast);
                $payFast['signature'] = $signature;

                // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
                $testingMode = true;
                $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                $htmlForm = '<form id="PayForm" action="https://'.$pfHost.'/eng/process" method="post">';
                foreach($payFast as $name=> $value)
                {
                    $htmlForm .= '<input name="'.$name.'" type="hidden" value="'.$value.'" />';
                }

                return view('user.deposit.payment_views.payfast',compact('htmlForm'));
            }

            if ($data->gateway_id > 3) {

                $dr = DepositRequest::where('trx',$track)->first();
                $dr->sent = 1;
                $dr->save();
                $data->status = 1;
                $data->save();
                Session::flash('success', 'Deposit request sent successfully!');
                return redirect()->route('users.showDepositMethods');
            }


        return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong please try again latter.');

        }catch (\Exception $e){
            // return  $e->getMessage();
            return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
        }

    }

    function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if(!empty($val)) {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    }
}
