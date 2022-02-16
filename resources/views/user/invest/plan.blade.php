@extends('front.layouts.master')
@section('title',__('Plan'))
@section('content')
<!-- invest-plan-Area Start-->
    <section class="invest-plan-area pd-top-100 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h6 class="sub-title">{{__('Plan')}}</h6>
                        <h2 class="title">{{__('ROI Investment')}}</h2>
                    </div>   
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table invest-plan-table table-borderless mb-0">
                            <thead>
                                @foreach($roi_plans as $key=> $data)
                                <tr class="color-{{$key+1}}">
                                    <th scope="col"><span class="daily-percentage">{{$data->percent}}%</span></th>
                                    <th scope="col">{{__($data->name)}}</th>
                                    <th scope="col">
                                        <div class="invest-plan-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/1.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <span>{{__('Minimum Deposit')}}: {{$data->min_amount}} {{$general->currency}}</span>
                                                <span class="mb-0">{{__('Maximum Deposit')}}: {{$data->max_amount}}{{$general->currency}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <div class="invest-term-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/2.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                
                                                <span class="days">
                                                    @switch($data->period)
                                                        @case(1)
                                                        {{__('Hourly')}}
                                                        @break
                                                        @case(24)
                                                        {{__('Daily')}}   @break
                                                        @case(168)
                                                        {{__('Weekly')}}   @break
                                                        @case(720)
                                                        {{__('Monthly')}}   @break
                                                        @case(2880)
                                                        {{__('Quarterly')}}   @break
                                                        @case(8640)
                                                        {{__('Yearly')}}   @break
                                                    @endswitch
                                                </span>
                                                <span class="mb-0">{{$data->action}} {{__('Times')}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col">
                                        <span class="btn-area"><a class="btn btn-border investRoi" data-all="{{$data}}" data-route="{{route('purchase.plan',$data->id)}}"  href="#addModal" data-toggle="modal">{{__('Buy Now')}} <i class="la la-angle-right"></i></a></span>
                                    </th>
                                </tr>
                                <tr class="table-space">
                                    <td></td>
                                </tr>
                                @endforeach
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="invest-plan-area pd-top-94 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h6 class="sub-title">{{__('Plan')}}</h6>
                        <h2 class="title">{{__('FIXED Investment')}}</h2>
                        
                    </div>   
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table invest-plan-table table-borderless mb-0">
                            <tbody>
                                <tr class="table-space">
                                    <td></td>
                                </tr>
                                @foreach($fixed_plans as $key=> $data)
                                <tr class="color-{{$key+1}}">
                                    <th scope="row"><span class="daily-percentage">{{$data->percent}}%</span></th>
                                    <td>{{__($data->name)}}</td>
                                    <td>
                                        <div class="invest-plan-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/1.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <span>{{__('Minimum Deposit')}}: {{$data->min_amount}} {{$general->currency}}</span>
                                                <span class="mb-0">{{__('Maximum Deposit')}}: {{$data->max_amount}}{{$general->currency}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="invest-term-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/2.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <span class="days">
                                                    @switch($data->period)
                                                        @case(1)
                                                        {{__('Hourly')}}
                                                        @break
                                                        @case(24)
                                                        {{__('Daily')}}   @break
                                                        @case(168)
                                                        {{__('Weekly')}}   @break
                                                        @case(720)
                                                        {{__('Monthly')}}   @break
                                                        @case(2880)
                                                        {{__('Quarterly')}}   @break
                                                        @case(8640)
                                                        {{__('Yearly')}}   @break
                                                    @endswitch
                                                </span>
                                                <span class="mb-0">{{$data->action}} {{__('Lifetime Times')}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="btn-area"><a class="btn btn-border investFixed" href="#addModalTwo" data-toggle="modal" data-all="{{$data}}" data-route="{{route('purchase.plan',$data->id)}}">{{__('Buy Now')}} <i class="la la-angle-right"></i></a></span>
                                    </td>
                                </tr>
                                <tr class="table-space">
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- invest-plan-Area End-->

    <div id="addModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title roiTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="purPlan" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="text-success text-center totalGetAmount"></h6>
                        <p class="text-primary text-center roiMsg"></p>
                        <div class="form-row">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="investAmount" name="invest_amount" placeholder="{{__('Put Amount for invest')}}" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger text-center roiMinMax"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success submitBtn">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="addModalTwo" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fixTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="purPlanTwo" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="text-danger text-center tAmountFix"></h6>
                        <h5 class="text-success text-center totalGetAmountFix"></h5>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
        $(document).ready(function () {
            $('.submitBtn').css('display','none');
            $('.investFixed').on('click',function () {
                $('#purPlanTwo').attr('action',$(this).data('route'));
                let retuenPerFix = $(this).data('all')['percent'];
                let amtFix = $(this).data('all')['fixed_amount'];
                $('.fixTitle').text($(this).data('all')['name']);
                $('.tAmountFix').text(amtFix+' {{$general->currency}} will deduct from your balance');
                $('.totalGetAmountFix').text('You will get '+retuenPerFix+'% of your Invest for Lifetime');
            });

            $('.investRoi').on('click',function () {
                $('#purPlan').attr('action',$(this).data('route'));
                $('#investAmount').val('');
                getBlank();
                let minAmount = $(this).data('all')['min_amount'];
                let maxAmount = $(this).data('all')['max_amount'];
                let retuenPer = $(this).data('all')['percent'];
                let retuenAction = $(this).data('all')['action'];
                $('.roiTitle').text($(this).data('all')['name']);
                $('.roiMinMax').text('Minimum '+minAmount+' {{$general->currency}} - Maximum '+maxAmount+'{{$general->currency}}');
                $('#investAmount').on('keyup',function () {
                    let invAmount = this.value;
                    if ((parseFloat(invAmount) >= parseFloat(minAmount)) && (parseFloat(invAmount) <= parseFloat(maxAmount))) {
                        let returnAmt = (parseFloat(invAmount)*parseFloat(retuenPer))/100;
                        let totalGetAmount = parseFloat(returnAmt)*parseFloat(retuenAction);
                        $('.roiMsg').text('You will get '+returnAmt+' {{$general->currency}} for '+retuenAction+' times');
                        $('.totalGetAmount').text('You will get total '+totalGetAmount+' {{$general->currency}} after complete ROI');
                        $('.submitBtn').css('display','block');
                    }else {
                        $('.submitBtn').css('display','none');
                        getBlank();
                    }
                })
            });
            function getBlank() {
                $('.roiMsg').text('');
                $('.totalGetAmount').text('');
            }
        });
        })(jQuery);
    </script>
@endsection
