@extends('front.layouts.master')
@section('title',__('Edit Your Profile'))
@section('content')
    <div class="signin-form-area pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-wrap my-5">
                            <div class="signin-top d-flex justify-content-center align-items-center">
                                <h2 class="signin-title">{{__('Update Profile')}}</h2>
                            </div>
                            <div class="signin-form">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}" value="{{$user->name}}" />
                                    <i class="icon fas fa-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" value="{{$user->mobile}}" placeholder="{{__('Mobile')}}" />
                                    <i class="icon fas fa-phone"></i>
                                </div>
                                <div class="form-group profdiv">
                                    <select name="gender" class="form-control profsel">
                                        <option {{$user->gender == 1? 'selected':''}} value="1">{{__('Men')}}</option>
                                        <option {{$user->gender == 0? 'selected':''}} value="0">{{__('Female')}}</option>
                                    </select>
                                    <i class="icon fas fa-venus-mars profico"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="{{__('Address')}}" value="{{$user->address}}" />
                                    <i class="icon fas fa-map-marker-alt"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="zip_code" placeholder="{{__('Zip-Code')}}" value="{{$user->zip_code}}" />
                                    <i class="icon fas fa-lock"></i>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="city" placeholder="{{__('City')}}" value="{{$user->city}}" type="text">
                                    <i class="icon fas fa-city"></i>
                                </div>
                                <div class="form-group autocomplete">
                                    <input type="text" id="myInput" class="form-control" name="country" placeholder="{{__('Country')}}" value="{{$user->country}}" autocomplete="off" />
                                    <i class="icon fas fa-flag"></i>
                                </div>
                                <button type="submit" class="btn btn-base w-100">{{__('Submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-wrap my-5">
                        <div class="signin-top d-flex justify-content-center align-items-center">
                            <h2 class="signin-title">{{__('Change Password')}}</h2>
                        </div>
                        <div class="signin-form">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="password" class="form-control" name="current_password" placeholder="{{__('Current Password')}}" required />
                                    <i class="icon fas fa-lock"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="{{__('New Password')}}" required />
                                    <i class="icon fas fa-lock"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation"  placeholder="{{__('Confirm Password')}}" required />
                                    <i class="icon fas fa-lock"></i>
                                </div>
                                <button type="submit" class="btn btn-base w-100">{{__('Submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('user/js/countryWiseCity.js')}}"></script>
@endsection

