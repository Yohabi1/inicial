@extends('front.layouts.master')
@section('title',__(isset($title) ? $title: 'Single Page'))
@section('content')
    <!-- blog-area start -->
    <div class="blog-single-area pd-top-100 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="single-blog-wrap">
                        @isset($image)
                        <div class="thumb">
                            <img class="img-bsp" src="{{$image}}" alt="img">
                        </div>
                        @endif
                        <div class="blog-details">
                            @isset($updated_at)
                            <span><a href="#"><i class="far fa-user"></i>{{__('Author')}}</a></span>
                            <span><i class="far fa-clock-o"></i>{{__(date('d M Y',strtotime($updated_at)))}}</span>
                            @endif
                            @isset($description)
                            <p>{!! clean(nl2br($description)) !!} </p>
                            @endif

                        </div>
                    </div>
                    <div class="blog-details-bottom d-md-flex justify-content-between">
                        <div class="social-share align-self-center">
                            <span class="details-bottom-titel">{{__('Share')}}:</span>
                            <ul class="social-area social-area-2 singblg">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://plus.google.com/share?url={{urlencode(url()->current()) }}" target="_blank"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>                        
                    </div>
                    <div class="entry-comment">
                        <ul class="comment-list">
                            <li>
                                <div class="single-comment-item media">
                                    <!-- single comment item -->
                                    <div class="content media-body">
                                        <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s); js.id = id;
                                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1421567158073949";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));
                                        </script>
                                        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
                                    </div>
                                </div>
                                <!-- //. single comment item -->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="widget widget-popular-post">
                            <h5 class="widgettitle">
                                <span>{{__('Recent Posts')}}</span>
                            </h5>
                            @foreach($recentPost as $data)
                            <div class="single-post media">
                                <div class="part-img">
                                    <img class="img-rcpost" src="{{asset('images/news/'.$data->image)}}" alt="img">
                                </div>
                                <div class="part-text media-body">
                                    <span>{{__(date('M d, Y',strtotime($data->updated_at)))}} </span>
                                    <h6><a href="{{route('single.page',['class' => 'News','id'=>$data->id])}}">{{__(short_text($data->title,5))}} </a></h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- blog-area end -->

@stop