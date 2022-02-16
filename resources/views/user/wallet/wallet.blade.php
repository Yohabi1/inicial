@extends('front.layouts.master')
@section('title',__('Wallets'))
@section('content')
<div class="transaction-area left-bottom-line-bg pd-top-100 pd-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-base text-center">
                        <h5 class="text-dark pt-2">{{__('WALLET ADDRESSES')}} <a href="#addwallet" data-toggle="modal" class="btn btn-warning btn-sm float-right"><i class="fa fa-plus"></i> @lang('New Wallet')</a></h5>
                    </div>
                    <div class="card-body walet-address-wrap">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Wallet Address')}}</th>
                                    <th scope="col">{{__('Balance')}}</th>
                                </tr>
                                @foreach ($wallet as $item)
                                <tr>
                                    <td>{{$item->wallet_name}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{number_format($item->balance,8)}} {{$general->cp_currency}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                                <div id="addwallet" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fixTitle">{{__('Create New Wallet')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('new-wallet.store')}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <h6 class="text-danger text-center tAmountFix"></h6>
                                                    <h5 class="text-success text-center totalGetAmountFix"></h5>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="investAmount">{{__('Wallet Name')}}</label>
                                                            <input type="text" class="form-control" id="investAmount" name="wallet_name" placeholder="{{__('Optional.Eg: My Wallet')}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                                    <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#addwalletsend" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-upload" aria-hidden="true"></i> @lang('Send')</a>
                        <a href="#addwalletreceived" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i> @lang('Receive')</a>
                    </div>
                    <div id="addwalletsend" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fixTitle">{{__('Send')}} {{$general->cp_currency}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="purPlanTwo" action="{{route('purchase-coin-send.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <h6 class="text-danger text-center tAmountFix"></h6>
                                        <h5 class="text-success text-center totalGetAmountFix"></h5>
                                            <div class="form-group mb-2">
                                            <label>{{__('Send From')}}</label>
                                            <select class="form-select" aria-label="Default select example" name="from_wallet_id" id="fromad">
                                                @foreach ($wallet as $item)
                                                    <option value="{{$item->id}}">{{$item->wallet_name}} | {{$item->address}} | {{$item->balance}} {{$general->cp_currency}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                            <label>{{__('To')}}</label>
                                            <input type="text" name="to_wallet_id" id="toadd" class="form-control input-sz" placeholder="Enter Recipient Wallet Address" required="">
                                            </div>
                                            <div class="form-group mb-2">
                                            <label>{{__('Amount')}}</label>
                                                <div class="input-group">
                                                    <input type="text" name="coin_amount" class="form-control" id="amount" required="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">{{$general->cp_currency}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        <button type="submit" class="btn btn-success">{{__('Send')}} {{$general->cp_currency}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="addwalletreceived" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fixTitle">{{__('Receive')}} {{$general->cp_currency}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="purPlanTwo" action="{{route('purchase-coin-receive.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <h6 class="text-danger text-center tAmountFix"></h6>
                                        <h5 class="text-success text-center totalGetAmountFix"></h5>
                                        <div class="form-group mb-2">
                                            <label>{{__('Sender Wallet Address')}}</label>
                                            <input type="text" name="to_wallet_id" id="toadd" class="form-control input-sz" placeholder="Enter Recipient Wallet Address" required="">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>{{__('Receive Wallet Address')}}</label>
                                            <select class="form-select" aria-label="Default select example" name="from_wallet_id" id="fromad">
                                                @foreach ($wallet as $item)
                                                <option value="{{$item->id}}">{{$item->wallet_name}} | {{$item->address}} | {{$item->balance}} {{$general->cp_currency}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                        <label>{{__('Amount')}}</label>
                                            <div class="input-group">
                                                <input type="text" name="coin_amount" class="form-control" id="amount" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">{{$general->cp_currency}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
