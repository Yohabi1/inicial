@extends ('front.layouts.master')
@section('title',__('2FA Authentication'))
@section('content')
    <div class="clearfix"></div>
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-left">
                <div class="col-lg-6">
                @if(Auth::user()->tauth == '1')
                    <form>
                        <div class="title text-center">
                            <h5>{{__('QR Code')}}</h5>
                        </div>
                        
                        <div class="form-group text-center">
                            <img src="{{$prevqr}}">
                        </div>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#disableModal">{{__('Disable Two Factor Authenticator')}}</button>
                    </form>
                @else
                    <form>
                        <div class="title text-center">
                            <h5>{{__('QR Code')}}</h5>
                        </div>
                        <div class="form-group text-center">
                            <img src="{{$qrCodeUrl}}">
                        </div>
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#enableModal">{{__('Enable Two Factor Authenticator')}}</button>
                    </form>
                @endif
                </div>
                <div class="col-lg-6">
                    <form>
                        <div class="title text-center">
                            <h5>{{__('Authenticator')}}</h5>
                        </div>
                        <div class="part-text">
                            <h5>{{__('Use Google Authenticator to Scan the QR code  or use the code')}}</h5><hr/>
                        </div>
                        <div class="part-text">
                            <p>{{__('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')}}</p>
                        </div>
                        <a type="submit" class="button btn btn-success btn-block text-center" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">{{__('DOWNLOAD APP')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Verify Your OTP')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('go2fa.create')}}" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="key" value="{{$secret}}">
                        <input type="text" class="form-control" name="code" placeholder="{{__('Enter Google Authenticator Code')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{__('Verify')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Verify Your OTP to Disable')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('disable.2fa')}}" method="POST">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="{{__('Enter Google Authenticator Code')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{__('Verify')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection