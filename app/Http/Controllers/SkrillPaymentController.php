<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SkrillPayment;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;
use Redirect;
use Illuminate\Support\Facades\Session;
use App\Deposit;
use App\General;
use App\Http\Controllers\DepositController;
use App\PaymentGatway;
use App\User;

class SkrillPaymentController extends Controller
{
    private $skrilRequest;

    public function __construct()
    {
        // skrill config
        $gateway = PaymentGatway::find(8);
        $this->skrilRequest = new SkrillRequest();
        $this->skrilRequest->pay_to_email = $gateway->gateway_key_one;
        $this->skrilRequest->return_url = route('skrill.payment.complete');
        $this->skrilRequest->cancel_url = round('skrill.payment.cancelled');
        $this->skrilRequest->logo_url = asset('images/logo/logo.png');
        $this->skrilRequest->status_url = route('skrill.ipn');
        $this->skrilRequest->status_url2 = route('skrill.ipn');
    }

    public function makePayment()
    {
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $user =  User::find($data->user_id);
        $gnl = General::first();
        // return $user;
        // create object instance of SkrillRequest
        $this->skrilRequest->transaction_id = $track; // generate transaction id
        $this->skrilRequest->amount = $data->usd_amo;
        $this->skrilRequest->currency = 'USD';
        $this->skrilRequest->language = 'EN';
        $this->skrilRequest->prepare_only = '1';
        $this->skrilRequest->merchant_fields = $gnl->web_name.' , '.$user->email;
        $this->skrilRequest->site_name = $gnl->web_name;
        $this->skrilRequest->customer_email = $user->email;
        $this->skrilRequest->detail1_description = 'Add Balance';
        $this->skrilRequest->detail1_text = '101';

        // create object instance of SkrillClient
        $client = new SkrillClient($this->skrilRequest);
        $sid = $client->generateSID(); //return SESSION ID

        // handle error
        $jsonSID = json_decode($sid);
        if ($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
            return $jsonSID->message;

        // do the payment
        $redirectUrl = $client->paymentRedirectUrl($sid); //return redirect url
        return Redirect::to($redirectUrl); // redirect user to Skrill payment page
    }

   

    /**
     * Instant Payment Notification (IPN) from Skrill
     */
    public function ipn(Request $request)
    {
        // skrill data - get more fields from Skrill Quick Checkout Integration Guide 7.9 (page 23)
        $transaction_id = $request->transaction_id;
        $mb_transaction_id = $request->mb_transaction_id;
        $invoice_id = $request->invoice_id; // custom field
        $order_from = $request->order_from; // custom field
        $customer_email = $request->customer_email; // custom field
        $biller_email = $request->pay_from_email;
        $customer_id = $request->customer_id;
        $amount = $request->amount;
        $currency = $request->currency;
        $status = $request->status;

        // status message
        if ($status == '-2') {
            $status_message = 'Failed';
        } else if ($status == '2') {
            $status_message = 'Processed';
        } else if ($status == '0') {
            $status_message = 'Pending';
        } else if ($status == '-1') {
            $status_message = 'Cancelled';
        }

        // $track = Session::get('Track');
        // $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        // now store data to database
        // $skrill_ipn = new SkrillPayment();
        // $skrill_ipn->transaction_id = $transaction_id;
        // $skrill_ipn->mb_transaction_id = $mb_transaction_id;
        // $skrill_ipn->invoice_id = $invoice_id;
        // $skrill_ipn->order_from = $order_from;
        // $skrill_ipn->customer_email = $customer_email;
        // $skrill_ipn->biller_email = $biller_email;
        // $skrill_ipn->customer_id = $customer_id;
        // $skrill_ipn->amount = $amount;
        // $skrill_ipn->currency = $currency;
        // $skrill_ipn->status = $status_message;
        // $skrill_ipn->created_at = Date('Y-m-d H:i:s');
        // $skrill_ipn->updated_at = Date('Y-m-d H:i:s');
        // $skrill_ipn->save();
    }

    public function complete(DepositController $controller)
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx',$track)->first();
        if($deposit instanceof Deposit){
            return $controller->userDataUpdate($deposit);
        }
    }
   
    public function cancelled(){
        return redirect()->route('users.showDepositMethods')->with('alert', 'Payment cancelled.');
    }
}
