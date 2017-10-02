<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>MOWA SIG</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />


<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="images/LOGOSIG.png" alt="" /></div>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Usuario y/o contraseña inválidas</div>
            </div>
            <div class="inputwrapper animate1 bounceIn" style="margin-left: 40px">
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Usuario"required autofocus>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="inputwrapper animate2 bounceIn" style="margin-left: 40px">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="inputwrapper animate3 bounceIn" style="padding: 0 35px; margin-right: 5px; margin-left: 5px" >
                <button type="submit" name="submit">Ingresar</button>
            </div>
            <div class="inputwrapper animate4 bounceIn" style="margin-left: 40px;">
                <label><input type="checkbox" class="remember" name="remember" {{ old('remember') ? 'checked' : '' }} /> Recuérdame</label>
            </div>
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
   
</div>

</body>
</html>
