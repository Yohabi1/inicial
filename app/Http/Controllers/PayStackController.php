<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Session;
use App\PaymentGatway;
use App\Deposit;
use Paystack;




class PayStackController extends Controller
{
    public function redirectToGateway()
    {
        try{
            $gateway = PaymentGatway::find(5);
            config([
                'paystack.publicKey'     => $gateway->gateway_key_one,
                'paystack.secretKey'     => $gateway->gateway_key_two,
                'paystack.paymentUrl'     => 'https://api.paystack.co',
                'paystack.merchantEmail'     => $gateway->gateway_key_three,
            ]);
            
            
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
             return redirect()->route('users.showDepositMethods')->with('alert', 'The paystack token has expired. Please refresh the page and try again.');
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(DepositController $controller)
    {
        $gateway = PaymentGatway::find(5);
        config([
            'paystack.publicKey'     => $gateway->gateway_key_one,
            'paystack.secretKey'     => $gateway->gateway_key_two,
            'paystack.paymentUrl'     => 'https://api.paystack.co',
            'paystack.merchantEmail'     => $gateway->gateway_key_three,
        ]);

        $paymentDetails = Paystack::getPaymentData();
        $track = Session::get('Track');
        $deposit = Deposit::where('trx',$track)->first();
        
        if (($paymentDetails['status'] == true) && ($paymentDetails['data']['status'] == 'success') ) {
            return $controller->userDataUpdate($deposit);
        }
        return redirect()->route('users.showDepositMethods')->with('alert', 'Something is wrong.');
    }
}
