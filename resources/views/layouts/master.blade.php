<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') | Prinstantly</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="p:domain_verify" content="f87811c9c0ee88e279118c62b931c944"/>

    <meta name="keywords"
          content="@yield('metaKeywords', 'pay-and-print, prints for sale, home printing, printable photos, printable art, 8 by 10 inch prints, print at home, pay-and-print method')">
    <meta name="description"
          content="@yield('metaDescription', 'Introducing a pay-and-print system for digital art and photos. Buyers print instantly, while artists retain control of their image files.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Begin Favicon mess -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('img/apple-touch-icon-57x57.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/apple-touch-icon-114x114.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/apple-touch-icon-72x72.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('img/apple-touch-icon-60x60.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/apple-touch-icon-120x120.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('img/apple-touch-icon-76x76.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('img/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-196x196.png" sizes="196x196') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96x96.png" sizes="96x96') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-32x32.png" sizes="32x32') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-16x16.png" sizes="16x16') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-128.png" sizes="128x128') }}"/>
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ asset('mstile-144x144.png') }}"/>
    <meta name="msapplication-square70x70logo" content="{{ asset('mstile-70x70.png') }}"/>
    <meta name="msapplication-square150x150logo" content="{{ asset('mstile-150x150.png') }}"/>
    <meta name="msapplication-wide310x150logo" content="{{ asset('mstile-310x150.png') }}"/>
    <meta name="msapplication-square310x310logo" content="{{ asset('mstile-310x310.png') }}"/>

    <!-- End Favicon mess -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">-->
    <link href="{{ asset('js/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-61143224-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body id="@yield('id')">
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Navigation -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/newlogo500.png') }}"
                                                               alt="Prinstantly Logo"/></a>
        </div><!-- end .navbar-header -->

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Photography <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('photo.index.imageType', 1) }}">All</a></li>
                        @foreach($photoCategories as $category)
                            <li>
                                <a href="{{ route('photo.index.category', array(1, $category->slug)) }}">{{ $category->name }}</a>
                            @if($category->children->count())
                                @foreach($category->children as $subcategory)
                                    <li style="padding-left: 25px;">
                                        <a href="{{ route('photo.index.category', array(1, $subcategory->slug)) }}">{{ $subcategory->name }}</a>
                                    </li>
                                    @endforeach
                                    @endif
                                    </li>
                                @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Digital Art <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('photo.index.imageType', 2) }}">All</a></li>
                        @foreach($digitalCategories as $category)
                            <li>
                                <a href="{{ route('photo.index.category', array(2, $category->slug)) }}">{{ $category->name }}</a>
                            @if($category->children->count())
                                @foreach($category->children as $subcategory)
                                    <li style="padding-left: 25px">
                                        <a href="{{ route('photo.index.category', array(2, $subcategory->slug)) }}">{{ $subcategory->name }}
                                            }</a>
                                    </li>
                                    @endforeach
                                    @endif
                                    </li>
                                @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Artists <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if ( $artists->count() )
                            @foreach ($artists as $artist)
                                <li>
                                    <a href="{{ route('artist.show', $artist->slug) }}">{{$artist->display_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </li>

            </ul><!-- end .navbar-nav -->

<!--             {{ Form::open(['route' => 'photo.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) }} -->
						<form method="GET" action="" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
            <ul class="social-menu">
                <li>
                    <a href="https://www.facebook.com/prinstantly" target="_blank"><img
                                src="{{ asset('img/social-fb-new.png') }}" alt="Facebook"/></a>
                </li>
                <li><a href="https://twitter.com/intent/user?screen_name=prinstantly" target="_blank"><img
                                src="{{ asset('img/social-twitter-new.png') }}" alt="Twitter"/></a></li>
                <li>
                    <a href="https://www.pinterest.com/prinstantly/" target="_blank"><img
                                src="{{ asset('img/social-pinterest.png') }}" alt="Pinterest"/></a>
                </li>
                <li>&nbsp;</li>
            </ul>
            <div class="input-group">
                {{ Form::text('q', '', ['class' => 'form-control']) }}
                <span class="input-group-btn">
								<button class="btn btn-default">
										<span class="glyphicon glyphicon-search"></span> Search
								</button>
							</span>
            </div>
<!--             {{ Form::close() }} -->
	</form>
        </div><!-- end .nav-collapse -->
    </div><!-- end .container -->
</div><!-- end .navbar -->

<div id="content" class="container">
    @if ($errors->has())
        @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
        @endforeach
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif

    @yield('content')
</div><!-- end .container -->

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-2 text-muted">&copy; {{ date('Y') }} Prinstantly<br/> All Rights Reserved.</div>
            <div class="col-sm-10 text-right">
                <ul class="list-inline">
                    <li><a href="{{ url('/information') }}">Information</a></li>
                    <li><a href="{{ url('/request-membership') }}">Artist Membership</a></li>
                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/rate-printer') }}">Rate Your Printer</a></li>
                    <li><a href="{{ url('/terms') }}">Terms <span>and</span> Privacy</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                    @if ( \Illuminate\Support\Facades\Auth::check() )
                        @if(!empty(\App\Models\User::find(Auth::user()->id)->artist->id) )
                            <li class="dropdown dropup">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('artist.edit', \App\Models\User::find(Auth::user()->id)->artist->id) }}?tab=photos">Photos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('artist.edit', \App\Models\User::find(Auth::user()->id)->artist->id) }}">Profile</a>
                                    </li>
                                    <li><a href="{{ route('user.edit', Auth::id()) }}">Settings</a></li>
                                    <li><a href="{{ route('logout') }}">Log Out</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('logout') }}">Log Out</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Log In</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div><!-- end .footer -->

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{ asset('js/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('js/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery-validate/additional-methods.min.js') }}"></script>
<script src="{{ asset('bower_components/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.dotdotdot.min.js') }}"></script>
<script src="{{ asset('js/jquery.rotate.js') }}"></script>
<script src="{{ asset('js/jquery.sitewide.js?v=1.7') }}"></script>

<!-- Clicky Integration -->
<a title="Web Statistics" href="http://clicky.com/100989947"><img alt="Web Statistics" src="//static.getclicky.com/media/links/badge.gif" border="0" /></a>
<script type="text/javascript">
    var clicky_site_ids = clicky_site_ids || [];
    clicky_site_ids.push(100989947);
    (function() {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//static.getclicky.com/js';
        ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
    })();
</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100989947ns.gif" /></p></noscript>
<!-- end Clicky Integration -->

@yield('footer')
</body>
</html>
