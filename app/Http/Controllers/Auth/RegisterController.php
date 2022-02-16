<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\General;
use App\Wallet;
use App\PaymentGatway;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $basic = General::first();

        if ($basic->emailver == 1) {
            $email_verify = 1;
        } else {
            $email_verify = 0;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'emailv' => $email_verify,
            'tfver' => 0,
            'balance' => 0,
            'password' => Hash::make($data['password']),
            'referral_token' => uniqid(),
            'ref_id' => isset($data['ref_id']) ? $data['ref_id'] : null,
        ]);

        
        

    //     $pin = substr(time(), 4);

    //     $ref_id = $data['ref_id'];
    //     $posid =  getLastChildOfLR($ref_id);

    //     $message = '<tr>';
    //      $message .='<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">';
    //      $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;color:green;">Our warmest congratulations on your new account opening! This only shows that you have grown your business well. I pray for your prosperous.</p>';
                       
    //      $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have taken this path knowing that you can do it. Good luck with your new business. I wish you all the success and fulfillment towards your goal.</p>';
    //      $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your username is '.$data['username'].' .</p>';

    //      $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your password is '.$data['password'].' .</p>';

    //       $message .='<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color:red;">Remember, never share your password with otherone. And you are agree with our Terms and Policy.</p>';
    //       $message .='</td>';
    //       $message .='</tr>';

    //    send_email($data['email'], 'Account Created Successfully', $data['first_name'], $message);

    //     $sms =  'Congratulation, for registration. Your username is '.$data['username'].'. Your password is '.$data['password'].'';
    //     send_sms($data['mobile'], $sms);
        
    }

    public function showRegistrationForm($referral_token = null)
    {
        if($referral_token){
            $data['refName'] = User::where('referral_token',$referral_token)->first();
        }

        $data['page_title'] = "Sign-up";
        $data['gateways'] = PaymentGatway::where('status', 1)->get();
        return view('user.auth.register',$data);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ran_address = Str::random(16)
                    .mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];
           Wallet::create([
                'user_id' => $user['id'],
                'wallet_name' => 'Default',
                'address' => $ran_address,
                'balance' => 0,
                'status' => 1,
            ]);
       
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
