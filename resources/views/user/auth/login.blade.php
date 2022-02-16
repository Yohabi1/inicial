@extends('front.layouts.master')
@section('title',__('Login & Invest To Earn'))
@section('content')
    <div class="signin-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-wrap my-5">
                            <div class="signin-top d-flex justify-content-center align-items-center">
                                <h2 class="signin-title">{{__('Login to get access')}}</h2>
                            </div>
                            <div class="signin-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @if ($general->social_api != 0)
                                    <div class="social__login">
                                        <a href="{{route('login.google')}}" class="btn__login btn__google"><i class="fab fa-google"></i> {{__('GOOGLE')}}</a>
                                
                                        <a href="{{route('login.facebook')}}" class="btn__login btn__facebook"><i class="fab fa-facebook"></i> {{__('FACEBOOK')}}</a>
                                    </div>
                                    <h5 class="login__h5"><span>{{__('Or sign in with')}}</span></h5>
                                    @endif
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{__('Enter Email')}}" autofocus/>
                                        <i class="icon fas fa-envelope"></i>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="{{__('Enter Password')}}" autocomplete="current-password"/>
                                        <i class="icon fas fa-lock"></i>
                                    </div>
                                    @if ($general->g_captcha == 1)
                                    <div class="form-group mb-3">
                                        <div class="col-md-12">
                                            <div class="g-recaptcha" data-sitekey="{{$general->captcha_key_one}}"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="invalid-feedback" style="display: block;">
                                                    <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="forgot-password">
                                            <a href="{{route('user.showEmailForm')}}">{{__('Forget Password ?')}} </a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-base w-100">{{__('Login')}}</button>
                                </form>
                            </div>
                            <div class="signin-bottom text-center">
                                <p class="have-account">{{__('Do not have an account ?')}} <a href="{{route('register')}}">{{__('Sign Up now')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
