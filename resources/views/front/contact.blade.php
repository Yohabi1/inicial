@extends('front.layouts.master')
@section('title',__('Contact'))
@section('content')

<section class="featured-area pd-bottom-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title style-white text-center">
                        <h6 class="sub-title">{{__('Feel Free To Contact Us')}}</h6>
                        <h2 class="title">{{__('Contact Us')}}</h2>
                    </div>  
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <div class="row justify-content-center">

                                <div class="col-lg-3 col-sm-6">
                                    <div class="single-analysis-wrap text-center">
                                        <div class="thumb">
                                            <img src="{{asset('images/contact/home.png')}}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h5>{{__('Our Head Office')}}</h5>
                                            <p>{!! clean($general->contact_address) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="single-analysis-wrap text-center">
                                        <div class="thumb">
                                            <img src="{{asset('images/contact/envelope.png')}}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h5>{{__('E-mail')}}</h5>
                                            <p>{!! clean($general->contact_email) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="single-analysis-wrap text-center">
                                        <div class="thumb">
                                            <img src="{{asset('images/contact/phone.png')}}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h5>{{__('Phone')}}</h5>
                                            <p>{!! clean($general->contact_phone) !!}</p>
                                        </div>
                                    </div>
                                </div>
                        
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop