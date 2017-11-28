<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

 <div id="app" class="container_nada">
        <div class="mail-box">
            <aside class="lg-side">
                <div class="inbox-head">

                    <h3>Real Time Web Chat</h3>

                    <router-link to="/addrooms">
                        <i class="fa fa-plus"></i>
                        Add Room
                    </router-link>

                    <router-link to="/myrooms">
                        <i class="fa fa-comments-o"></i>
                        My Rooms
                    </router-link>

                    <router-link to="/allrooms">
                        <i class="fa fa-globe"></i>
                        All Rooms
                    </router-link>


                </div>
                <div class="inbox-body">
                    @yield('content')
                </div>
            </aside>
            <aside class="sm-side">
                <div class="user-head">
                    <a class="inbox-avatar" href="javascript:;">
                        <img  width="64" hieght="60" src="http://bootsnipp.com/img/avatars/ebeb306fd7ec11ab68cbcaa34282158bd80361a7.jpg">
                    </a>
                    <div class="user-name">
                        <h5><a href="#">{{ Auth::user()->name }}</a></h5>
                        <span><a href="#">{{ Auth::user()->email }}</a></span>
                    </div>
                    <a class="mail-dropdown pull-right"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">

                        <i class="fa fa-power-off"></i>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
                <div class="inbox-body">
                    <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
                        Compose
                    </a>
                </div>
            </aside>
        </div>
 </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
