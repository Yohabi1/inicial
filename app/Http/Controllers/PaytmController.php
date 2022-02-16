<?php

namespace App\Http\Controllers;

use App\Deposit;
use Illuminate\Http\Request;
use PaytmWallet;
use App\EventRegistration;
use App\User;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Session;

class PaytmController extends Controller
{
    public function order(Request $request){

        $depositTable = Deposit::where('trx', request()->orderID)->first();
        $user = User::find($depositTable->user_id);
      
        config([
            'services.paytm-wallet.merchant_id'     => $depositTable->gateway->gateway_key_one,
            'services.paytm-wallet.merchant_key'     => $depositTable->gateway->gateway_key_two,
            'services.paytm-wallet.merchant_website'     => request()->getHttpHost(),
            'services.paytm-wallet.channel'     => 'WEB',
            'services.paytm-wallet.industry_type'     => 'Retail',
        ]);

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => request()->orderID,
          'user' => $user->name,
          'mobile_number' => $user->mobile,
          'email' => $user->email,
          'amount' => $depositTable->amount,
          'callback_url' => route('paytm.callback')
        ]);

        return $payment->receive();

    }

    public function paymentCallback(DepositController $controller){

        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response();
        $order_id = $transaction->getOrderId();
        if($transaction->isSuccessful()){

        //   EventRegistration::where('order_id',$order_id)->update(['status'=>2, 'transaction_id'=>$transaction->getTransactionId()]);

          $track = Session::get('Track');
          $deposit = Deposit::where('trx',$track)->first();
          if($deposit instanceof Deposit){
              return $controller->userDataUpdate($deposit);
          }

        //   dd('Payment Successfully Paid.');

        }else if($transaction->isFailed()){
            return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong please try again latter.');
        //   EventRegistration::where('order_id',$order_id)->update(['status'=>1, 'transaction_id'=>$transaction->getTransactionId()]);

        //   dd('Payment Failed.');

        }

    }    
}
