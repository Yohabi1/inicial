@extends ('front.layouts.master')
@section('title',__('Authorization'))
@section('content')
<div class="signin-form-area pd-top-100 pd-bottom-90">
    <div class="container">
        @if (Auth::user()->status != '1')
            <h3 class="subr text-center">{{__('Your account is Deactivated')}}</h3>
        @elseif(Auth::user()->emailv != '0')     
        <div class="signin-form">
            <div class="container">
                <div class="row justify-content-left">
                    <div class="col-lg-6">
                        <form action="{{route('sendemailver')}}" method="POST">
                            {{csrf_field()}}>
                            <div class="title text-center">
                                <h5>{{__('Please Verify your Email')}}</h5>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" readonly placeholder="{{__('Your Email address')}}" value="{{Auth::user()->email}}">
                                <i class="icon fas fa-envelope"></i>
                            </div>
                            <button type="submit" class="btn btn-base btn-block">{{__('Send Verification Code')}}</button>
                        </form>
                    </div>
                    <div class="col-md-6 my-4">
                        <form action="{{route('emailverify') }}" method="POST">
                            {{csrf_field()}}
                            <div class="title text-center">
                                <h5>{{__('Verify Code')}}</h5>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="{{__('Enter Verification Code')}}" required>
                                <i class="icon fas fa-lock"></i>
                            </div>
                            <form action="{{route('sendemailver')}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-base btn-block">{{__('Verify')}}</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @elseif(Auth::user()->tfver != '0')

        <div class="signin-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form action="{{route('go2fa.verify') }}" method="POST">
                            {{csrf_field()}}
                            <div class="title text-center">
                                <h5>{{__('Verify Google Authenticator Code')}}</h5>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="{{__('Enter Google Authenticator Code')}}" required>
                            </div>
    
                            <button type="submit" class="btn btn-success btn-block">{{__('Verify')}}</button>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        @endif
    </div>
</div>

@endsection
