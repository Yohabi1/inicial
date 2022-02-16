@extends('front.layouts.master')
@section('title',__('Home'))
@section('content')
<!-- intro-Area Start-->
    <section class="intro-area pd-bottom-67">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-intro-wrap text-center">
                        <div class="thumb">
                            <img src="{{asset('images/work/'.$workAreaFirst->icon)}}" alt="img">
                        </div>
                        <h5><a href="{{route('single.page',['class' => 'Work','id'=>$workAreaFirst->id])}}">{{__($workAreaFirst->title)}}</a></h5>
                        <p>{{__(short_text($workAreaFirst->description,25))}}</p>
                    </div>
                </div>
                @foreach($workArea as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="single-intro-wrap text-center">
                        <div class="thumb">
                            <img src="{{asset('images/work/'.$data->icon)}}" alt="img">
                        </div>
                        <h5><a href="{{route('single.page',['class' => 'Work','id'=>$data->id])}}">{{__($data->title)}}</a></h5>
                        <p>{{__(short_text($data->description,25))}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>      
    </section>
    <!-- intro-Area End-->

    <!-- about-Area Start-->
    <section class="about-area pd-bottom-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h6 class="sub-title">{{__($general->about_head)}}</h6>
                        <h2 class="title">{{__($general->about_title)}}</h2>
                        <p>{{__(short_text($general->about_body,50))}}</p>
                        <a class="btn btn-base" href="{{route('single.page',['class' => 'About'])}}" onclick="window.location.href= {{route('single.page',['class' => 'About'])}}">{{__('Find Out More')}}</a>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="about-inner text-lg-left text-center">
                        
                        <div class="about-content d-lg-block d-inline-block text-left">
                            <div class="media">
                                <div class="thumb text-center">
                                    <img src="{{asset('images/about/one.png')}}" alt="img">
                                </div>
                                <div class="media-body">
                                    <h5><a href="{{route('single.page',['class' => 'About1'])}}">{{__($general->single_about1_title)}}</a></h5>
                                    <p>{{__(short_text($general->single_about1_description, 20))}}</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="thumb text-center">
                                    <img src="{{asset('images/about/two.png')}}" alt="img">
                                </div>
                                <div class="media-body">
                                    <h5><a href="{{route('single.page',['class' => 'About2',])}}">{{__($general->single_about2_title)}}</a></h5>
                                    <p>{{__(short_text($general->single_about2_description, 20))}}</p>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>      
    </section>
    <!-- about-Area End-->

    <!-- investor-Area Start-->
    <section class="investor-area bg-grey text-center pd-top-90 pd-bottom-62">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h6 class="sub-title">{{__($general->investor_head)}}</h6>
                        <h2 class="title">{{__($general->investor_title)}}</h2>
                        <p>{{__($general->investor_description)}}</p>
                    </div>   
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($investors as $data)
                <div class="col-xl-3 col-md-6">
                    <div class="single-investor-wrap">
                        <div class="thumb">
                            <img src="{{asset('images/investor/'.$data->image)}}" alt="img">
                        </div>
                        <div class="investor-wrap-details">
                            <h6>{{__($data->name)}}</h6>
                            <p>{{__($data->designation)}}</p>
                        </div>
                        <div class="invest-details">
                            <ul class="social-area social-area-2 soc subsocil">
                                @if(!is_null($data->fb_link))
                                <li><a href="{{$data->fb_link}}"><i class="fab fa-facebook"></i></a></li>
                                @endif
                                @if(!is_null($data->twitter_link))
                                <li><a href="{{$data->twitter_link}}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if(!is_null($data->linkedin_link))
                                <li><a href="{{$data->linkedin_link}}"><i class="fab fa-linkedin"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- investor-Area End-->

    <!-- invest-plan-Area Start-->
    <section class="invest-plan-area pd-top-94 pd-bottom-100">
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
                                    <th scope="col"><span class="daily-percentage">{{__($data->percent)}}%</span></th>
                                    <th scope="col">{{__($data->name)}}</th>
                                    <th scope="col">
                                        <div class="invest-plan-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/1.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <span>{{__('Minimum Deposit')}}: {{__($data->min_amount)}} {{__($general->currency)}}</span>
                                                <span class="mb-0">{{__('Maximum Deposit')}}: {{__($data->max_amount)}}{{__($general->currency)}}</span>
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
                                    <th scope="col"><span class="btn-area"><a class="btn btn-border" href="{{route('invest.index')}}">{{__('Buy Now')}} <i class="la la-angle-right"></i></a></span></th>
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
                            <thead>
                                @foreach($fixed_plans as $key=> $data)
                                <tr class="color-{{$key+1}}">
                                    <th scope="row"><span class="daily-percentage">{{__($data->percent)}}%</span></th>
                                    <td>{{__($data->name)}}</td>
                                    <td>
                                        <div class="invest-plan-wrap media">
                                            <div class="thumb align-self-center">
                                                <img src="{{url('/')}}/public/user2/img/plan/1.png" alt="img">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <span>{{__('Minimum Deposit')}}: {{__($data->min_amount)}} {{__($general->currency)}}</span>
                                                <span class="mb-0">{{__('Maximum Deposit')}}: {{__($data->max_amount)}}{{__($general->currency)}}</span>
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
                                        <span class="btn-area"><a class="btn btn-border" href="{{route('invest.index')}}">{{__('Buy Now')}} <i class="la la-angle-right"></i></a></span>
                                    </td>
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
    <!-- invest-plan-Area End-->

    <!--  why-choose-us-area Start-->
    <section class="about-area pd-top-94">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="thumb d-none d-lg-block">
                        <img src="{{url('/')}}/public/user/img/why-choose-us/01.png" alt="png">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-inner text-lg-left text-center">
                        <div class="about-content d-lg-block d-inline-block text-left">
                            @foreach($services as $data)
                            <div class="media">
                                <div class="thumb text-center">
                                    <img src="{{asset('images/service/'.$data->icon)}}" alt="img">
                                </div>
                                <div class="media-body">
                                    <h5>{{__($data->title)}}</h5>
                                    <p>{{__($data->description)}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>        
                    </div>
                </div>
            </div>
        </div>      
    </section>
    <!--  why-choose-us-area End-->

    <!-- testimonial-Area Start-->
    <section class="testimonial-area bg-grey pd-top-96 pd-bottom-95 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">{{__('Latest Top Investments News')}}</h2>
                    </div>  
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider owl-carousel owl-theme">
                        @foreach($news as $data)
                        <div class="item">
                            <div class="testimonial-wrap">
                                <div class="thumb">
                                    <img src="{{asset('images/news/'.$data->image)}}" alt="img">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-Area End-->

    <!-- blog-area start -->
    <div class="blog-area pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="section-title text-center">
                        <h6 class="sub-title">{{__('OUR BLOGS')}}</h6>
                        <h2 class="title">{{__('Latest Blog')}}</h2>
                    </div>  
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($news as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-wrap">
                        <div class="thumb">
                            <img src="{{asset('images/news/'.$data->image)}}" alt="img">
                        </div>
                        <div class="blog-details">
                            <h5><a href="{{route('single.page',['class' => 'News', 'id' =>$data->id])}}">{{__($data->title)}}</a></h5>
                            <span><i class="far fa-user"></i>{{__('Author')}}</span>
                            <span><i class="far fa-clock-o"></i>{{__(date('F j, Y', strtotime($data->updated_at)))}}</span>
                            <p>{!! clean(short_text($data->description, 30)) !!}</p>
                            <div class="blog-btn">
                                <a class="read-more-btn" href="{{route('single.page',['class' => 'News', 'id' =>$data->id])}}">{{__('Read More')}}<i class="la la-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- blog-area end -->

    <section class="testimonial-area bg-grey pd-top-90 pd-bottom-95 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider owl-carousel owl-theme">
                        @foreach($partners as $data)
                        <div class="item">
                            <div class="testimonial-wrap single-investor-wrap">
                                <div class="thumb">
                                    <a href="#" onclick="event.preventDefault()"><img src="{{asset('images/partner/'.$data->image)}}" alt="img"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop