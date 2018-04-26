
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Login</title>

    <!-- Canonical SEO -->
    <link rel="canonical" href="http://www.creative-tim.com/product/paper-dashboard-pro"/>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('assets/global/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('assets/global/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('assets/global/css/common.css') }}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="{{ asset('assets/global/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='{{ asset('assets/global/css/font.css') }}' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/global/css/themify-icons.css') }}" rel="stylesheet">
</head>

<body>

<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="" data-image="../../assets/img/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top: 80px;">
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="card" data-background="color" data-color="blue"
                                 style="padding-left: 17px;padding-bottom: 15px;box-shadow: 1px 1px 20px 3px #888890;">
                                <div class="card-header">
                                    <h3 class="card-title">Login</h3>
                                </div>
                                <div class="card-content">
                                    <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                        <label>Username</label>
                                        <input class="form-control form-control-solid placeholder-no-fix border-input form-group input-no-border" id="user_name"
                                               value="{{ old('user_name') }}" autofocus
                                               type="text" autocomplete="off" placeholder="Username" name="user_name" required/>
                                        @if ($errors->has('user_name'))
                                            <span class="help-block has-error">
                                        {{ $errors->first('user_name') }}
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label>Password</label>
                                        <input class="form-control form-control-solid placeholder-no-fix border-input form-group" id="password"
                                               type="password" autocomplete="off" placeholder="Password" name="password" required/>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block has-error">
                                        {{ $errors->first('password') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-fill btn-wd ">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-transparent">
            <div class="container">
                <div class="copyright">
                    &copy; <script>document.write(new Date().getFullYear())</script>, by <a href="javascript:;">Systems</a>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>

<!--   Core JS Files   -->
<script src="{{ asset('assets/global/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{ asset('assets/global/js/bootstrap-checkbox-radio.js') }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset('assets/global/js/bootstrap-notify.js') }}"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{ asset('assets/global/js/paper-dashboard.js') }}"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/global/js/demo.js') }}"></script>

</html>
