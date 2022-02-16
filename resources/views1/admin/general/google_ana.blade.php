@extends('admin.layouts.master')
@section('title',__('Api Settings'))
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <h2> {{__('API Settings')}}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('general.store') }}" method="POST">
            @csrf
                <div class="row mb-2">
                    <div class="col-md-12 mb-2">
                        <div class="d-flex align-items-center justify-content-between pdb-1x">
                            <h5 class="card-title-md text-primary">{{__('Google reCaptcha')}}</h5>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('Captcha')</label>
                        <select class="form-control" name="g_captcha">
                            <option value="0" {{$general->g_captcha == 0?'selected':''}}>{{__('Off')}}</option>
                            <option value="1" {{$general->g_captcha == 1?'selected':''}}>{{__('On')}}</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Site Key')}}</label>
                        <input type="text" class="form-control" name="captcha_key_one" value="{{$general->captcha_key_one}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Secret Key')}}</label>
                        <input type="text" class="form-control" name="captcha_key_two" value="{{$general->captcha_key_two}}">
                    </div>
                </div>
                <div class="input-note pt-0">{{__('Get the API Key')}} <strong class="text-primary"><a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a></strong></div>
                <hr>

                <div class="row mb-2">
                    <div class="col-md-12 mb-2">
                        <div class="d-flex align-items-center justify-content-between pdb-1x">
                            <h5 class="card-title-md text-primary">{{__('Social Login API Credentials')}}</h5>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">@lang('Social Login Api')</label>
                        <select class="form-control" name="social_api">
                            <option value="0" {{$general->social_api == 0?'selected':''}}>{{__('Off')}}</option>
                            <option value="1" {{$general->social_api == 1?'selected':''}}>{{__('On')}}</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Facebook Client ID')}}</label>
                        <input type="text" class="form-control" name="fb_client_id" value="{{$general->fb_client_id}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Facebook Client Secret')}}</label>
                        <input type="text" class="form-control" name="fb_client_secret" value="{{$general->fb_client_secret}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Facebook Callback URL')}}</label>
                        <input type="text" class="form-control" name="fb_callback_url" value="{{$general->fb_callback_url}}">
                    </div>
                </div>
                <div class="input-note pt-0">{{__('In Facebook App set redirect URL')}}: <strong class="text-primary">https://investpro.wowtheme7.com/login/facebook/callback</strong></div>

                <div class="row mt-4 mb-2">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Google Client ID')}}</label>
                        <input type="text" class="form-control" name="google_client_id" value="{{$general->google_client_id}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Google Client Secret')}}</label>
                        <input type="text" class="form-control" name="google_client_secret" value="{{$general->google_client_secret}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="validationDefault011">{{__('Google Callback URL')}}</label>
                        <input type="text" class="form-control" name="google_callback_url" value="{{$general->google_callback_url}}">
                    </div>
                </div>
                <div class="input-note pt-0">{{__('In Google App set redirect URL')}}: <strong class="text-primary">https://investpro.wowtheme7.com/login/google/callback</strong></div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="submit">{{__('Save')}}</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@stop