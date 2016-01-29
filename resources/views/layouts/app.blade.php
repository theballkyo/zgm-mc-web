<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ empty($title) ? 'ZoneGamer Minecraft' : $title }}</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    @yield('style')
    <link href="{{url('/style/zgm.css')}}" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
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
                    ZoneGamer Minecraft
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">หน้าแรก</a></li>
                    <li><a href="{{ url('/topic') }}">เว็บบอร์ด</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
                        <li><a href="{{ url('/register') }}">สมัครสมาชิกเว็บ</a></li>
                        <li><a href="{{ url('/topic/4') }}">สมัครไอดีเกม</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 header_image">
            </div>
        </div>
    </div>

    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">This is menu</div>

                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                        <li class="list-group-item"><a href="{{ url('/topic') }}">เว็บบอร์ด</a></li>
                        <li class="list-group-item"><a href="{{ url('/topic/4') }}">วิธีการเล่น</a></li>
                        <li class="list-group-item"><a href="{{ url('/topic/4') }}">สมัครไอดีเกม</a></li>
                        <li class="list-group-item"><a href="{{ url('/register') }}">สมัครสมาชิกเว็บ</a></li>
                        <li class="list-group-item"><a href="{{ url('/viewmaps') }}">แผนที่</a></li>
                    </ul>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Game status</div>

                    @if (!empty($mc_status) && !empty($mc_status->GetInfo()))
                        <b>Server IP :</b> mc-sv1.enjoyprice.in.th<br>
                        <b>Version :</b> {{$mc_status->GetInfo()['Version']}}<br>
                        <b>Player online :</b> {{$mc_status->GetInfo()['Players']}} / {{$mc_status->GetInfo()['MaxPlayers']}}.<br>
                        <b>Player list : </b>{{implode((array)$mc_status->GetPlayers(), ' ,')}} <br>
                        <b>{{$mc_status->GetInfo()['HostName']}}'</b><br>
                    @else
                        Offline !
                    @endif
                </div>

                <div class="row">
                    <div class="fb-page" data-href="https://www.facebook.com/zonegamer" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/zonegamer"><a href="https://www.facebook.com/zonegamer">ZoneGamer Community</a></blockquote></div></div>
                </div>
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">ZoneGamer @ Deverloped by Theballkyo ^_^ || {{PHP_Timer::resourceUsage()}}</p>
      </div>
    </footer>
    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    @yield('script')
</body>
</html>
