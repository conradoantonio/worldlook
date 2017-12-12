<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon24x24.png')}}" />
        <link rel="stylesheet" href="{{ asset('plugins/pace/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
        <link rel="stylesheet" href="{{ asset('plugins/boostrapv3/css/bootstrap.min.css')}}"  type="text/css"/>
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>
        <style type="text/css">
        /* Change the white to any color ;) */
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px #6A6A6A inset !important;
            -webkit-text-fill-color: white!important;
        }
        @font-face {
            font-family: "Gill Sans Light";
            src: url({{asset('fonts/gill-sans/GillSansStd-Light.otf')}}) format("opentype");
        }
        @font-face {
            font-family: "Gill Sans Bold";
            src: url({{asset('fonts/gill-sans/GillSansStd-Bold.otf')}}) format("opentype");
        }
        .body-login {
            background: url('{{url('')}}/img/bg_login.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        input::placeholder {
            font-family: "Gill Sans Light"!important;
            color: white!important;
            font-size: 20px;
        }
        input:focus{
            border: 0;
            outline: 0;
            background-color: #6A6A6A!important;
        }
        input[type="text"], input[type="password"] {
            font-size:20px;
            font-family: "Gill Sans Light"!important;
            color: white!important;
            height: 50px !important;
        }
        input.form-control {
            background-color: #6A6A6A!important;
            border: none;
            /*outline: 0;
            border-bottom: 2px solid #F29100;*/
        }
        button{
            height: 50px !important;
            font-family: "Gill Sans Light";
            width: 100%;
            border: none;
            background: #EA2F6C;
            color: #f2f2f2;
            padding: 10px;
            font-size: 18px;
            position: relative;
            box-sizing: border-box;
            transition: all 500ms ease;
        }
        button:hover {
            cursor: pointer;
            background: rgba(0,0,0,0);
            color: #EA2F6C;
            box-shadow: inset 0 0 0 3px #EA2F6C;
        }
        div.controls, div.form-group{
            margin: 0px!important;
        }
        .show-error{
            font-size: 12px;
            color: maroon;
            display: block;
            margin-top: 2%;
            margin-bottom: 3%;
        }
        .icon-top{
            width: 250px;
            padding-top: 150px;
            padding-bottom: 50px;
        }
        </style>
    </head>
    <body class="body-login">
        <div class="">
            <div class="col-lg-7 text-center">
            </div>
            <div class="col-lg-5 text-center">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-8 col-md-push-2 col-md-pull-2">
                    <div class="p-t-20 p-l-15 p-r-15 p-b-30">
                        <img class="icon-top" src="{{asset('img/login_logo.png')}}" alt="">
                        <form class="m-t-30 m-l-15 m-r-15" method="POST" action="login" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('user') || $errors->has('status') ? ' error' : '' }}" style="padding-bottom: 1px;">
                                <div class="controls">
                                    <input type="text" class="form-control" id="user" name="user" value="{{ @session('account') ? session('account') : '' }}" placeholder="Usuario">
                                    @if ($errors->has('user'))
                                        <span class="show-error">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                    @if ($errors->has('status'))
                                        <span class="show-error">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="controls">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="show-error">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="" type="submit">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    </body>
</html>
