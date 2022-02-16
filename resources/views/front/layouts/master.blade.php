<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{__($general->web_name)}} | @yield(__('title')) </title>
    <link rel=icon href="{{asset('images/logo/favicon.png')}}" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('user2/css/vendor.css')}}">
    <link rel="stylesheet" href="{{ asset('user2/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('user2/css/responsive.css')}}">
    <link href="{{asset('admin/plugins/bootoast/src/bootoast.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user2/css/custom.css')}}">
    <link href="{{asset('user2/css/color.php?color='.$general->color_code)}}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @yield('style')
</head>
<body>

<!-- topbar area start -->
    <div class="topbar-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 align-self-laft">
                    <div class="lang-select">
                        <img src="{{ asset('user2/img/icon/globe.png')}}" alt="img">
                        <select id="langSel">
                            <option value="en">En</option>
                            @foreach($lang as $data)
                                <option class="text-capitalize" value="{{$data->code}}" @if(Session::get('lang') === $data->code) selected  @endif>{{ ucfirst(trans($data->code)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5 align-self-center">
                    <div class="topbar-content text-center">
                        <span><i class="fa fa-envelope" aria-hidden="true"></i>{{$general->contact_email}} </span>
                        <span class="mr-0"><i class="fa fa-phone-alt" aria-hidden="true"></i>{{$general->contact_phone}}</span>
                    </div>
                </div>
                @auth
                <div class="col-sm-3 align-self-center">
                    <div class="topbar-content text-center">
                            @if ($general->ico == 1)
                                <span>1 {{$general->currency}} = {{round($general->cp_currency_rt,16)}} {{$general->cp_currency}} </span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col-sm-2 align-self-center d-none d-md-block">
                    <ul class="social-area text-center">
                        @foreach($social as $data)
                        <li><a href="{{$data->link}}" target="_blank"><i class="fab fa-{{$data->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- topbar area end -->

<!-- navbar start -->
    <div class="navbar-area">
        <nav class="navbar navbar-expand-lg">
            <div class="container nav-container">
                <div class="navbar-inner">
                    <div class="responsive-mobile-menu">
                        <button class="menu toggle-btn d-block d-lg-none" data-target="#themefie_main_menu" 
                        aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-left"></span>
                            <span class="icon-right"></span>
                        </button>
                    </div>
                    <div class="logo">
                        <a class="main-logo" href="{{url('/')}}"><img src="{{asset('images/logo/logo.png')}}" alt="img"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="themefie_main_menu">
                        <ul class="navbar-nav menu-open">
                            @auth
                            <li>
                                <a href="{{route('home')}}">{{__('Dashboard')}}</a>
                            </li>
                            @if ($general->ico == 1)
                                <li class="menu-item-has-children current-menu-item">
                                    <a href="#">{{$general->cp_currency}} <i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('wallet.index')}}">{{__('Wallets')}}</a></li>
                                        <li><a href="{{route('my.wallet.transaction.log')}}">{{__('My Transaction Log')}}</a></li>
                                        <li><a href="{{route('other.wallet.transaction.log')}}">{{__('Other Transaction Log')}}</a></li>
                                    </ul>
                                </li>                                
                            @endif

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{__('Deposit')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('users.showDepositMethods')}}">{{__('Add Deposit')}}</a></li>
                                    <li><a href="{{route('user.deposit.log')}}">{{__('Deposit Log')}}</a></li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{__('Investment')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('invest.index')}}">{{__('Investment Plan')}}</a></li>
                                    <li><a href="{{route('invest.log')}}">{{__('Invest Log')}}</a></li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{__('Transaction')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('user.ref.index')}}">{{__('My Referral Tree')}}</a></li>
                                    <li><a href="{{route('fund.transfer')}}">{{__('Fund Transfer')}}</a></li>
                                    <li><a href="{{route('transaction.log')}}">{{__('Transaction Log')}}</a></li>
                                    @if ($general->ico == 1)
                                <li><a href="{{route('purchase.coin')}}">{{__('MIN CRYPTO')}}</a></li>
                                @endif
                                </ul>
                            </li>

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{__('Withdraw')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('user.withdraw.method')}}">{{__('Withdraw')}}</a></li>
                                    <li><a href="{{route('user.withdraw.log')}}">{{__('Withdraw Log')}}</a></li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{split_name(auth()->user()->name)[0]}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('profile.index')}}">{{__('Profile')}}</a></li>
                                    <li><a href="{{route('two.factor.index')}}">{{__('Security')}}</a></li>
                                    <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('logout')}}">{{__('Logout')}}</a></li>
                                </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                            @csrf
                            </form>
                            @else
                            <li>
                                <a href="{{url('/')}}">{{__('Home')}}</a>
                            </li>
                            @foreach($frontMenu as $data)
                                <li>
                                    <a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}">{{__($data->title)}}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{route('news.index')}}">{{__('News')}}</a>
                            </li>
                            <li>
                                <a href="{{route('contacts.index')}}">{{__('Contact')}}</a>
                            </li>

                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">{{__('Account')}} <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('register')}}">{{__('Sign Up')}}</a></li>
                                    <li><a href="{{route('login')}}">{{__('Sign In')}}</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end -->

@if(request()->route()->uri() == '/')
<!-- Banner Area Start-->
    <section class="banner-area-2 banner-bg-image">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="banner-inner">
                        <h6>{{__($general->banner_header)}}</h6>
                        <h2 class="text-white">{{__($general->banner_body)}} </h2>
                        <p class="text-white">{{__($general->banner_footer)}} </p>
                        <div class="banner-subscribe-area">
                            <div class="single-input-wrap">
                                <input placeholder="{{__('Open an account - Enter you email')}}" type="text" class="single-input">
                                <a class="btn btn-base" href="{{route('register')}}">{{__('GO ON')}}</a>
                            </div>
                            <a class="video-play-btn" href="{{$general->about_video_url}}" data-effect="mfp-zoom-in"><i class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 align-self-center d-none d-lg-block">
                    <div class="thumb">
                        <img src="{{ asset('images/banner/front.png')}}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Banner Area End -->
    @else

<!-- Banner Area Start-->
    <div class="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="title">@yield(__('title')) </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{__('Home')}}</a></li>
                        @isset($page_title)
                        <li class="breadcrumb-item active" aria-current="page">{{__($page_title)}}</li>
                        @endisset
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!-- Banner Area End -->
    @endif


@yield('content')

    <div class="bg-subroo-img">
        <!-- payment-Area Start-->
        <section class="payment-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="payment-wrap text-center pd-top-96">
                            <div class="section-title text-center">
                                <h6 class="sub-title">{{__('PaymentMethod')}}</h6>
                                <h2 class="title">{{__('Choose your Payment Gateway')}}</h2>
                            </div>
                            <ul>
                                @foreach($gateways as $gate)
                                <li><a href="#"><img style="max-width: 97px;" src="{{asset('images/gateway/'.$gate->image)}}" alt="img">{{__($gate->name)}}</a></li>
                                @endforeach
                            </ul> 
                        </div> 
                    </div>
                    
                </div>
            </div>
        </section>

<!-- footer area start -->
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_category">
                            <a href="{{url('/')}}" class="footer-logo">
                                <img src="{{asset('images/logo/logo.png')}}" alt="footer logo">
                            </a>
                            <p>{!! clean(__($general->footer_text)) !!}</p>
                            <ul class="social-area social-area-2 soc">
                                @foreach($social as $data)
                                <li><a href="{{$data->link}}" target="_blank"><i class="fab fa-{{$data->icon}}" aria-hidden="true"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">{{__('Links')}}</h4>
                            <ul>
                                <li><a href="{{route('news.index')}}">{{__('Blog')}}</a></li>
                                <li><a href="{{route('contacts.index')}}">{{__('Contact')}}</a></li>
                                @guest
                                <li><a href="{{route('register')}}">{{__('Sign Up')}}</a></li>
                                <li><a href="{{route('login')}}">{{__('Sign In')}}</a></li>
                                    @else
                                    <li><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">{{__('Others Links')}}</h4>
                            <ul>
                                @foreach($frontMenu as $data)
                                <li><a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}">{{__($data->title)}}</a></li>
                                @endforeach
                                </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_info">
                            <h4 class="widget-title">{{__('Contact Us')}}</h4>
                            <p><i class="fa fa-map-marker-alt"></i>{{__($general->contact_address) }}</p>
                            <p class="phone"><i class="fa fa-phone-alt"></i>{{__($general->contact_phone) }}</p>
                            <p class="email"><i class="fa fa-envelope"></i>{{__($general->contact_email)}}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-widget widget widget_link">
                            <h4 class="widget-title">{{__('Investment')}}</h4>
                            <ul>
                            @auth
                                <li><a href="{{route('users.showDepositMethods')}}">{{__('Add Deposit')}}</a></li>
                                <li><a href="{{route('invest.index')}}">{{__('Investment Plan')}}</a></li>
                                <li><a href="{{route('fund.transfer')}}">{{__('Fund Transfer')}}</a></li>
                                @else
                                <li> <a href="{{url('/')}}">{{__('Home')}}</a></li>
                                @foreach($frontMenu as $data)
                                <li>
                                    <a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}">{{__($data->title)}}</a>
                                </li>
                                @endforeach
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer area end -->
    </div>

    <!--Footer bottom-->
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright-area text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <p>{{__($general->copyright_text)}}</p>
                    </div>
                </div>
            </div>                
        </div>
    </div>
    <!--Footer bottom-->        
    {!! ($general->livechat_script) !!}
    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
<!-- back to top area end -->




<!-- all plugins here -->
<script src="{{ asset('user2/js/vendor.js')}}"></script>
<!-- main js  -->
<script src="{{ asset('user2/js/main.js')}}"></script>

<script src="{{asset('admin/plugins/bootoast/dist/bootoast.min.js')}}"></script>

<script src="{{asset('user/js/custom.js')}}"></script>

<script>
    $(document).on('change', '#langSel', function () {
    var code = $(this).val();
    window.location.href = "{{url('/')}}/change-lang/"+code ;
    });
</script>

@yield('script')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            bootoast.toast({
                message: '{{ $error }}',
                type: 'warning',
                icon:'exclamation-sign',
                position:'top',
            });
        </script>
    @endforeach
@endif

@if(session()->has('success'))
    <script>
        bootoast.toast({
            message: '{{ session()->get('success') }}',
            type: 'success',
            position:'top',
        });
    </script>
@endif

@if(session()->has('alert'))
    <script>
        bootoast.toast({
            message: '{{ session()->get('alert') }}',
            type: 'danger',
            position:'top',
        });
    </script>
@endif
</body>

</html>
