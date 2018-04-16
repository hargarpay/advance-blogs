<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title) ? $title.': ' : '' }} Advance Blog</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body >

<div class="wrapper">
@if(auth()->check())
    <div id="sidebar" class="active">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <h3>COMPANY'S LOGO</h3>
            <strong>LOGO</strong>
        </div>

        <!-- Sidebar Links -->
        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{route('view.users')}}">
                    <i class="glyphicon glyphicon-user"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="{{route('view.posts')}}">
                    <i class="glyphicon glyphicon-tasks"></i>
                    Posts
                </a>
            </li>
    
            <!-- Link with dropdown items -->
            <!-- <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-duplicate"></i>
                    Pages
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-link"></i>
                    Portfolio
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-send"></i>
                    Contact
                </a>
            </li> -->
        </ul>
    </div>
@endif
    <div id="content" class="screen-view-height" @if(!auth()->check()) style="width: 100%;" @endif>
        <div  class="main-content-height">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                     @if(auth()->check())
                        <!-- Branding Image -->
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            Toggle Sidebar
                        </button>
                    @endif
                        <!-- <a class="navbar-brand" href="{{ url('/') }}">
                            {{-- config('app.name', 'Laravel') --}}
                        </a> -->
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
           @if (Session::has('flash_notification'))
                <div style="position:absolute; margin-top: 10px; left: 20%; right: 20%; z-index:9999999;" class="notification-wrapper">
                    @include('flash::message')
                </div>
            @endif
            @yield('content')
        </div>
        <footer class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center ">&copy; {{date('Y')}} Designed and Developed By AppDev (hargarpay)</h3>
                    </div>
                </div>
            </div>
        </footer>
        
    </div>
</div>


    <!-- Scripts -->
    <script src="{{ mix('js/all.js') }}"></script>
    @yield('script-content')
</body>
</html>
