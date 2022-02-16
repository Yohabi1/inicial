@extends('front.layouts.master')
@section('title',__('Other Wallets Transaction Log'))
@section('content')
    <div class="transaction-area left-bottom-line-bg pd-top-100 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="transaction-tab-area">
                        <div class="transaction-table tab-content">
                            <div class="tab-pane deposit-tab fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> {{__('Form User Name')}} </th>
                                            <th> {{__('Form Wallet')}} </th>
                                            <th> {{__('Amount')}} </th>
                                            <th> {{__('Charge')}} </th>
                                            <th> {{__('Type')}} </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transferLog as $data)
                                        @if (Auth::id() == $data->form_user_id)
                                        <tr class="table-margin">
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>{{($data->form_user->name)}}</td>
                                            <td>{{($data->form_user_wallet->address)}}</td>
                                            <td>{{$data->coin_amount}} {{$general->cp_currency}}</td>
                                            <td>{{$data->charge}} {{$general->cp_currency}}</td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="badge bg-primary">{{__('Panding')}}</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge bg-success">{{__('Complete')}}</span>
                                                @elseif($data->status == 3)
                                                    <span class="badge bg-danger">{{__('Reject')}}</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if($data->status == 0)
                                                <button class="btn btn-success btn-sm" data-id="{{$data->id}}" data-bs-toggle="modal" data-bs-target="#acceptModal{{$data->id}}" data-bs-toggle="tooltip" title="{{_('Accept')}}"> <i class="fa fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm" data-id="{{$data->id}}" id="edit" data-bs-toggle="modal" data-bs-target="#cancelModal{{$data->id}}" data-bs-toggle="tooltip" title="{{_('Cancel')}}"> <i class="fa fa-times"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <div id="acceptModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fixTitle">{{__('Accept')}} {{$general->cp_currency}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('confirm-coin-wallet.store', $data->id)}}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <h3 class="text-center text-danger">{{__('Received amount')}} {{$data->coin_amount}} {{__('Charge')}} {{$data->charge}} {{$general->cp_currency}}</h3>
                                                            <p class="text-center text-success">{{__('Total amount')}} {{number_format(floatval($data->coin_amount) + floatval($data->charge), 8)}} {{$general->cp_currency}}</p>
                                                         </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                                            <button type="submit" class="btn btn-success">{{__('Confirm')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="cancelModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fixTitle">{{__('Reject')}} {{$general->cp_currency}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('reject-coin-wallet.store', $data->id)}}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <h3 class="text-center text-danger">{{__('Received amount')}} {{$data->coin_amount}} {{__('Charge')}} {{$data->charge}} {{$general->cp_currency}}</h3>
                                                            <p class="text-center text-success">{{__('Total amount')}} {{number_format(floatval($data->coin_amount) + floatval($data->charge), 8)}} {{$general->cp_currency}}</p>
                                                         </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                                            <button type="submit" class="btn btn-success">{{__('Confirm')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$transferLog->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
