<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\General;
use App\User;
use Exception;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Session;

class FlutterwaveController extends Controller
{
    public function initialize()
    {
        $depositTable = Deposit::where('trx', request()->orderID)->first();
        $user = User::find($depositTable->user_id);
        $general = General::first();

        if(($depositTable instanceof Deposit) && ($user instanceof User)){

            config([
                'flutterwave.publicKey'     => $depositTable->gateway->gateway_key_one,
                'flutterwave.secretKey'     => $depositTable->gateway->gateway_key_two,
                'flutterwave.secretHash'     => $depositTable->gateway->gateway_key_three,
            ]);


            $reference = Flutterwave::generateReference();
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $depositTable->amount,
                'email' => $user->email,
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => route('rave.callback'),
                'customer' => [
                    'email' => $user->email,
                    "phonenumber" => $user->mobile,
                    "name" => $user->name
                ],
                "customizations" => [
                    "title" => $general->web_name,
                    "description" => "Add Fund"
                ]
            ];
            $payment = Flutterwave::initializePayment($data);
            if ($payment['status'] !== 'success') {
                return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong please try again latter.');
            }
            return redirect($payment['data']['link']);
        }
        return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());   
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback(DepositController $controller)
    {
        try{
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);
            if(isset($data)){
                $track = Session::get('Track');
                $deposit = Deposit::where('trx',$track)->first();
                if($deposit instanceof Deposit){
                    return $controller->userDataUpdate($deposit);
                }
                // dd($data);
            }
        }catch(Exception $e){
            return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong please try again latter.');
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the $data['data']['status'] is 'successful'
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here
    }

}
