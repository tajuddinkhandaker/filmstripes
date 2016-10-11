 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Filmstripes | @yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles --><!-- 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="{{ url('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <script src="{{ url('/bower_components/webcomponentsjs/webcomponents-lite.min.js') }}"></script>

    <link rel="import" href="{{ url('/filmstrips-elements.html') }}">

    <!-- Material Design Lite -->
    <link rel="stylesheet" href="{{ url('/bower_components/material-design-lite/material.min.css') }}">
    <script src="{{ url('/bower_components/material-design-lite/material.min.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    @yield('header-scripts')


    <style>
        body {
            font-family: 'Lato';
            height: 100%;
        }

        .fa-btn {
            margin-right: 6px;
        }
        .filmstripes-footer {
            margin-top: 14%;
        }
        .filmstripes-container {
            min-height: 366px;
        }

        @media (min-width: 1600px) {
            .filmstripes-container {
                min-height: 66%;/*583px;*/
            }
        }
    </style>


    @yield('header-styles')

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-film fa-2x fa-fw" aria-hidden="true"></i> Flim Stripes
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}" style="top: 6px"><i class="fa fa-home fa-2x fa-fw" aria-hidden="true"></i>Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (auth()->guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="{{ route('users::avatar') }}" style="width: 32px; height: 32px; border-radius: 50%;">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('users::profile') }}"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Profile</a></li>
                                <li><a href="{{ route('movies::register-form') }}"><i class="fa fa-film fa-fw" aria-hidden="true"></i>Movies</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('includes.flash')
        <crystal-error-stripe id="error-stripe"></crystal-error-stripe>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="mdl-mini-footer filmstripes-footer">
      <div class="mdl-mini-footer__left-section">
        <div class="mdl-logo">Flim Stripes</div>
        <ul class="mdl-mini-footer__link-list">
          <li><a href="#">Help</a></li>
          <li><a href="#">Privacy & Terms</a></li>
        </ul>
      </div>
    </footer>
    <!-- Footer Ends -->

    <!-- JavaScripts -->
    <script src="{{ url('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     -->
    <script src="{{ url('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
