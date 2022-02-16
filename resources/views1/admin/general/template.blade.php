@extends('admin.layouts.master')
@section('title',__('Template'))
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Template')</h2>
                </div>
                <div class="card-body">
                    <section class="sub-section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="{{route('general.store')}}">
                                        @csrf
                                    <input type="hidden" value="0" name="template_sel">
                                    <div class="sub-content">
                                        <div class="sub-thumb">
                                            <div class="sub-thumb1">
                                                <div class="sub-overlay">
                                                    <a href="#">
                                                    <img class="figure figure1 subrato-fig1 timg1" src="{{ asset('images/banner/temp1.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-text">
                                            <h6>Template One</h6>
                                            <button class="btn btn-primary" value="0" {{$general->template_sel == 0?'disabled':''}} type="submit">Active</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form method="post" action="{{route('general.store')}}">
                                        @csrf
                                        <input type="hidden" value="1" name="template_sel">
                                    <div class="sub-content">
                                        <div class="sub-thumb">
                                            <div class="sub-thumb1">
                                                <div class="sub-overlay">
                                                    <a href="#">
                                                    	<img class="figure figure1 subrato-fig1 timg2" src="{{ asset('images/banner/temp2.png') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-text">
                                            <h6>Template Two</h6>
                                            <button class="btn btn-primary" value="1" {{$general->template_sel == 1?'disabled':''}} type="submit">Active</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection

