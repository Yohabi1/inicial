@extends('front.layouts.master')
@section('title',__('News'))
@section('content')
    <!-- blog-area start -->
    <div class="blog-area pd-top-100 pd-bottom-100">
        <div class="container">
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
                <div class="col-12 text-center">
                    {{$news->links()}}
                </div>      
            </div>
        </div>
    </div>
    <!-- blog-area end -->
@stop