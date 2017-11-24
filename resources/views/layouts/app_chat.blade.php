<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

 <div class="container_nada">
        <div class="mail-box">
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
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Compose</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">To</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" id="inputEmail1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Cc / Bcc</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" id="cc" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Subject</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder="" id="inputPassword1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Message</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="files[]" multiple="">
                                                      </span>
                                                <button class="btn btn-send" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <ul class="inbox-nav inbox-divider">
                    <li class="active">
                        <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bookmark-o"></i> Important</a>
                    </li>
                    <li>
                        <a href="#"><i class=" fa fa-external-link"></i> Drafts <span class="label label-info pull-right">30</span></a>
                    </li>
                    <li>
                        <a href="#"><i class=" fa fa-trash-o"></i> Trash</a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
                    <li> <h4>Labels</h4> </li>
                    <li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a> </li>
                    <li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a> </li>
                    <li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
                    </li><li> <a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
                    </li><li> <a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a>
                    </li>
                </ul>
                <ul class="nav nav-pills nav-stacked labels-info ">
                    <li> <h4>Buddy online</h4> </li>
                    <li> <a href="#"> <i class=" fa fa-circle text-success"></i>Alireza Zare <p>I do not think</p></a>  </li>
                    <li> <a href="#"> <i class=" fa fa-circle text-danger"></i>Dark Coders<p>Busy with coding</p></a> </li>
                    <li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Mentaalist <p>I out of control</p></a>
                    </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>H3s4m<p>I am not here</p></a>
                    </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Dead man<p>I do not think</p></a>
                    </li>
                </ul>

                <div class="inbox-body text-center">
                    <div class="btn-group">
                        <a class="btn mini btn-primary" href="javascript:;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn mini btn-success" href="javascript:;">
                            <i class="fa fa-phone"></i>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn mini btn-info" href="javascript:;">
                            <i class="fa fa-cog"></i>
                        </a>
                    </div>
                </div>

            </aside>
            <aside class="lg-side">
                <div class="inbox-head">
                    <h3>Inbox</h3>
                    <form action="#" class="pull-right position">
                        <div class="input-append">
                            <input type="text" class="sr-input" placeholder="Search Mail">
                            <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
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
