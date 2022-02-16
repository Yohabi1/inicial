<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Session;
use App\Deposit;


class PayFastController extends Controller
{
    public function success(DepositController $controller)
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx',$track)->first();
        if($deposit instanceof Deposit){
            return $controller->userDataUpdate($deposit);
        }
        return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('users.showDepositMethods')->with('alert', 'Sorry you payment is canceled');
    }

    public function notify(Request $request)
    {
        return redirect()->route('users.showDepositMethods')->with('alert', 'Notify Page Viewed.');
    }
}
