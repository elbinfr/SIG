<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>SIG</title>
    
        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap-responsive.min.css') }}" />

        <!-- breadcrumbs-->
        <link rel="stylesheet" href="{{ asset('template/lib/jBreadcrumbs/css/BreadCrumb.css') }}" />

        <!-- tooltips-->
        <link rel="stylesheet" href="{{ asset('template/lib/qtip2/jquery.qtip.min.css') }}" />
        
        <!-- gebo color theme-->
        <link rel="stylesheet" href="{{ asset('template/css/blue.css') }}"  id="link_theme"/>
        <!-- main styles -->
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" />
            
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
    
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        
    </head>
    <body class="sidebar_hidden">
        <div id="maincontainer" class="clearfix">
            <!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="#"><img src="{{ asset('images/LOGUIYO.png')}}" alt="" style="height: 30px;"/></a>
                            <ul class="nav user_menu pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{ setUsername() }} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Perfil</a></li>
                                        <li><a href="#">Another Action</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Salir</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav" id="mobile-nav">
                                @include('layouts.menu')
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">

                    <nav>
                        @include('layouts.title')
                    </nav>
                    
                    @yield('main')
                
                </div>
            </div>
            
            <script src="{{ asset('template/js/jquery.min.js') }}"></script>
            <script src="{{ asset('template/js/jquery-migrate.min.js') }}"></script>
            <!-- smart resize event -->
            <script src="{{ asset('template/js/jquery.debouncedresize.min.js') }}"></script>
            <!-- hidden elements width/height -->
            <script src="{{ asset('template/js/jquery.actual.min.js') }}"></script>
            <!-- js cookie plugin -->
            <script src="{{ asset('template/js/jquery_cookie.min.js') }}"></script>
            <!-- main bootstrap js -->
            <script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
             <!-- bootstrap plugins -->
            <script src="{{ asset('template/js/bootstrap.plugins.min.js') }}"></script>
            <!-- tooltips -->
            <script src="{{ asset('template/lib/qtip2/jquery.qtip.min.js') }}"></script>

            <!-- jBreadcrumbs -->
            <script src="{{ asset('template/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js') }}"></script>

            <!-- fix for ios orientation change -->
            <script src="{{ asset('template/js/ios-orientationchange-fix.js') }}"></script>
            <!-- scrollbar -->
            <script src="{{ asset('template/lib/antiscroll/antiscroll.js') }}"></script>
            <script src="{{ asset('template/lib/antiscroll/jquery-mousewheel.js') }}"></script>
            <!-- mobile nav -->
            <script src="{{ asset('template/js/selectNav.js') }}"></script>
            <!-- common functions -->
            <script src="{{ asset('template/js/gebo_common.js') }}"></script>

            <script src="{{asset('plugins/Highchart/code/highcharts.js')}}"></script>
            <script src="{{asset('plugins/Highchart/code/modules/exporting.js')}}"></script>

            <script src="{{asset('js/events.js')}}"></script>
            @yield('script')
        
        </div>
    </body>
</html>