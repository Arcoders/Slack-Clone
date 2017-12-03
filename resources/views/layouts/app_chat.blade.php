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

                    <router-link to="/myprofile"  exact-active-class="active">
                        <i class="fa fa-user"></i>
                        My Profile
                    </router-link>

                    <router-link to="/addrooms"  exact-active-class="active">
                        <i class="fa fa-plus"></i>
                        Add Room
                    </router-link>

                    <router-link to="/myrooms"  exact-active-class="active">
                        <i class="fa fa-comments-o"></i>
                        My Rooms
                    </router-link>

                    <router-link to="/allrooms"  exact-active-class="active">
                        <i class="fa fa-globe"></i>
                        All Rooms
                    </router-link>

                    <div class="pull-right">

                        <b>{{ Auth::user()->name }}</b>

                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">

                            <i class="fa fa-power-off"></i>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>

                    </div>

                </div>
                <div class="inbox-body">
                    @yield('content')
                </div>
            </aside>
        </div>
 </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
