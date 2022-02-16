@extends('front.layouts.master')
@section('title',__('Register From Here'))
@section('content')
    <div class="signin-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-wrap my-5">
                            <div class="signin-top d-flex justify-content-center align-items-center">
                                <h2 class="signin-title">{{__('Register & Get Start the Journey')}}</h2>
                            </div>
                            <div class="signin-form">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    @isset($refName)
                                    <div class="form-group">
                                        <input type="text" disabled class="form-control" value="{{$refName->name}}">
                                    </div>
                                    <input type="hidden" value="{{$refName->id}}" name="ref_id">
                                    @endisset
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Full Name')}}" required value="{{old('name')}}" autocomplete="name" autofocus />
                                        <i class="icon fas fa-user"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{__('Enter Email')}}" required autocomplete="email" value="{{old('email')}}" autofocus />
                                        <i class="icon fas fa-envelope"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="{{__('Enter Password')}}" required />
                                        <i class="icon fas fa-lock"></i>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="confirm-password" name="password_confirmation"  placeholder="{{__('Confirm Password')}}" required />
                                        <i class="icon fas fa-lock"></i>
                                    </div>
                                    <button type="submit" class="btn btn-base w-100">{{__('Register')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
