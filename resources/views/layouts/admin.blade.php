<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('layout.dots_caps')</title>

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ action('HomeController@index') }}" class="site_title"><i
                                class="fa fa-paw"></i> <span>@lang('layout.dots_root')</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section active">
                        <h3>General</h3>
                        <ul class="nav side-menu" style="">
                            <li class="active"><a><i class="fa fa-home"></i> @lang('menu.home') <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: block;">
                                    <li class="{{ !Request::is(action('HomeController@index')) ?: 'current-page' }}">
                                        <a href="{{ action('HomeController@index') }}">@lang('menu.dashboard')</a></li>
                                    <li class="{{ !Request::is(action('TestingServerController@index')) ?: 'current-page' }}">
                                        <a href="{{ action('TestingServerController@index') }}">@lang('menu.testing_servers')</a></li>
                                    <li class="{{ !Request::is(action('ProblemController@index')) ?: 'current-page' }}">
                                        <a href="{{ action('ProblemController@index') }}">@lang('menu.problems')</a></li>
                                    <li class="{{ !Request::is(action('ProgrammingLanguageController@index')) ?: 'current-page' }}">
                                        <a href="{{ action('ProgrammingLanguageController@index') }}">@lang('menu.programming_languages')</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <div class="dropdown-menu pull-right">
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                            class="fa fa-sign-out pull-right"></i> @lang('menu.logout')</a>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
    </div>
    <!-- /page content -->
    <div class="right_col" role="main">
        @include('helpers.flash')
        @yield('content')
    </div>
    <footer>
        <div class="pull-right"></div>
        <div class="clearfix"></div>
    </footer>
</div>


</body>

{{--@yield('content')--}}

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>
