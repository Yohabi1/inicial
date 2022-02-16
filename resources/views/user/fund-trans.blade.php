@extends('front.layouts.master')
@section('title',__('Transfer Your Balance'))
@section('content')
    <div class="signin-form-area pd-top-100 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="signin-form">
                    <form method="POST" action="{{ route('transfer.store') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Share your Balance with Other User')}}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="text-danger"> {{$general->bal_trans_percentage_charge}}% {{__('Transfer Charge will Applied and transferred Fund will go to Secondary Balance.')}}</p>
                                <p class="text-danger"> {{$general->bal_trans_fixed_charge}} {{$general->currency}} {{__('fixed transfer Charge will Applied and transferred Fund will go to Secondary Balance.')}}</p>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="{{__('Email to Transfer')}}" required autocomplete="email" autofocus>
                            <i class="icon fas fa-envelope"></i>
                        </div>
                        <div class="form-group">
                            <input type="text" name="amount" class="form-control" id="amount" placeholder="{{__('AMOUNT YOU WANT TO SHARE')}}" autocomplete="off" required>
                            <i class="icon fas fa-dollar-sign"></i>
                            <span class="text-danger wrnMsg"></span>
                        </div>
                        <button type="submit" class="btn btn-base w-100">{{__('Transfer Now')}}</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($) {
            "use strict";
        $(document).ready(function () {
            let fixedCharge, percentCharge;
            fixedCharge = '{{$general->bal_trans_fixed_charge}}';
            percentCharge = '{{$general->bal_trans_percentage_charge}}';
            $('#amount').on('keyup',function () {
                var amt = this.value;
                if (($.isNumeric(amt)) && (parseFloat(amt) > 0)){
                    var perCharge = (parseFloat(amt)*parseFloat(percentCharge))/100;
                    var totalCharge = perCharge+parseFloat(fixedCharge);
                    var total = parseFloat(amt)+parseFloat(totalCharge);
                    msg('Total '+parseFloat(total)+' {{$general->currency}} will deduct from your balance.');
                } else {
                    msg('Amount should be numeric & greater than 0');
                }

            });
            function msg(msg) {
                $('.wrnMsg').text(msg);
            }
        });
        })(jQuery);
    </script>
@endsection
