@extends('admin.layouts.master')
@section('title',__('ICO Settings'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('ICO Settings')</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('general.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">@lang('ICO')</label>
                                <select class="form-control" name="ico">
                                    <option value="0" {{$general->ico == 0?'selected':''}}>{{__('Off')}}</option>
                                    <option value="1" {{$general->ico == 1?'selected':''}}>{{__('On')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">@lang('Crypto Currency (Ex: BTC, BTC, ADA)')</label>
                                <input type="text" class="form-control" name="cp_currency" value="{{$general->cp_currency}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-label">@lang('Crypto Currency Rate')</label>
                                <input type="text" class="form-control" name="cp_currency_rt" value="{{$general->cp_currency_rt}}">
                            </div>

                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">@lang('Coin Fixed Charge (Balance Transfer)')</label>
                                <input type="text" class="form-control" name="bal_trans_coin_fixed_charge" value="{{$general->bal_trans_coin_fixed_charge}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">@lang('Coin Percentage (%) Charge (Balance Transfer)')</label>
                                <input type="text" class="form-control" name="bal_trans_coin_percentage_charge" value="{{$general->bal_trans_coin_percentage_charge}}">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-2">{{__('Update')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
