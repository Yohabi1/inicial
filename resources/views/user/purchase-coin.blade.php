@extends('front.layouts.master')
@section('title',__('Min Crypto'))
@section('content')
<div class="signin-form-area pd-top-100 pd-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="signin-form">
                <form method="POST" action="{{ route('purchase-coin.store') }}">
                    @csrf
                    <div class="title text-center">
                        <h5>{{__('MIN CRYPTO')}}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="text-danger">1 {{$general->currency}} = {{$general->cp_currency_rt}} {{$general->cp_currency}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="form-label">{{$general->cp_currency}} :</label>
                            <input type="text" name="amount" class="form-control" id="amount" placeholder="{{$general->cp_currency}} {{__('YOU WANT TO BUY')}}" autocomplete="off" required>
                            <span class="text-danger wrnMsg"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-base btn-success w-100">{{__('Buy Now')}}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" value="{{$general->cp_currency_rt}}" id="cp_currency_rt">
    <input type="hidden" value="{{$general->bal_trans_percentage_charge}}" id="bal_trans_percent">
    <input type="hidden" value="{{$general->currency}}" id="currency">
@endsection
