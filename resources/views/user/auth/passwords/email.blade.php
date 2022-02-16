@extends('front.layouts.master')
@section('title',__('Forget Password'))

@section('content')

    <div class="signin-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-wrap my-5">
                            <div class="signin-top text-center">
                                <h2 class="signin-title ">{{__('Forget Password')}}</h2>
                                <p>{{__('Enter your Email to reset your password')}}</p>
                            </div>
                            <div class="signin-form">
                                <form method="POST" action="{{ route('user.sendResetPassMail') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="resetEmail" placeholder="{{__('Enter Email')}}" required autocomplete="resetEmail" autofocus />
                                        <i class="icon fas fa-envelope"></i>
                                    </div>
                                    <button type="submit" class="btn btn-base w-100">{{__('Send Password Reset Link')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
