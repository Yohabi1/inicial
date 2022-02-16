<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\PaymentGatway;
use App\General;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $data['page_title'] = "Sign-in";
        $data['gateways'] = PaymentGatway::where('status', 1)->get();
        return view('user.auth.login',$data);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $usr = User::where('email',$request->email)->first();
        if (($usr instanceof User) && ($usr->status != 1)){
            return back()->withErrors(['Account Banned']);
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if(Auth::user()->tauth==1)
        {
            $user['tfver'] = 1;
        }else{
            $user['tfver'] = 0;

        }
        $user->save();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/');
    }

    public function redirectToGoogle(){
        $gen = General::first();
        config([
            'services.google.client_id'     => $gen->google_client_id,
            'services.google.client_secret'     => $gen->google_client_secret,
            'services.google.redirect'     => $gen->google_callback_url,
        ]);

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){

        $gen = General::first();
        config([
            'services.google.client_id'     => $gen->google_client_id,
            'services.google.client_secret' => $gen->google_client_secret,
            'services.google.redirect'      => $gen->google_callback_url,
        ]);

        $user = Socialite::driver('google')->user();

        $this->_registerOrLogin($user);

        return redirect()->route('home');
    }

    public function redirectToFacebook(){
        $gen = General::first();
        config([
            'services.facebook.client_id'     => $gen->fb_client_id,
            'services.facebook.client_secret' => $gen->fb_client_secret,
            'services.facebook.redirect'      => $gen->fb_callback_url,
        ]);
        
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $gen = General::first();
        config([
            'services.facebook.client_id'     => $gen->fb_client_id,
            'services.facebook.client_secret' => $gen->fb_client_secret,
            'services.facebook.redirect'      => $gen->fb_callback_url,
        ]);

        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLogin($user);

        return redirect()->route('home');
    }

    protected function _registerOrLogin($data){

        $user = User::where('email', '=', $data->email)->first();

        $characters = 'ABCDEFGHIJKLM';
        $ran_address = Str::random(16)
                    .mt_rand(100000, 999999)
                    . mt_rand(100000, 999999)
                    . $characters[rand(0, strlen($characters) - 1)];
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($ran_address);
            $user->save();
        }

        Auth::login($user);
    }
}
