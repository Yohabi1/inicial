@extends('front.layouts.master')
@section('title',__('Login & Invest To Earn'))
@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Login to get access')}}</h5>
                        </div>

                        @if ($general->social_api != 0)
                        <div class="social__login">
                            <a href="{{route('login.google')}}" class="btn__login btn__google"><i class="fa fa-google"></i> {{__('GOOGLE')}}</a>
                    
                            <a href="{{route('login.facebook')}}" class="btn__login btn__facebook"><i class="fa fa-facebook"></i> {{__('FACEBOOK')}}</a>
                        </div>
                        <h5 class="login__h5"><span>{{__('Or sign in with')}}</span></h5>
                        @endif

                        <div class="form-group">
                            <label>{{__('Email')}} :</label>
                            <input type="email" name="email" class="form-control" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label>{{__('Password')}} :</label>
                            <input type="password" name="password" class="form-control" required autocomplete="current-password">
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

                        <button type="submit" class="btn btn-success btn-block">{{__('Login')}}</button>

                        <div class="row mt-2">
                            <div class="col-md-6 mt-2">
                                <a  href="{{route('user.showEmailForm')}}">{{__('Forget Password ?')}}</a>
                            </div>

                            <div class="col-md-6 mt-2">
                                <a href="{{route('register')}}">{{__('Do not have an account ?')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
