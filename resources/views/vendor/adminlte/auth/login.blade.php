<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    @section('adminlte_css_pre')
        <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @stop

    @php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
    @php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
    @php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

    @if (config('adminlte.use_route_url', false))
        @php($login_url = $login_url ? route($login_url) : '')
        @php($register_url = $register_url ? route($register_url) : '')
        @php($password_reset_url = $password_reset_url ? route($password_reset_url) : '')
    @else
        @php($login_url = $login_url ? url($login_url) : '')
        @php($register_url = $register_url ? url($register_url) : '')
        @php($password_reset_url = $password_reset_url ? url($password_reset_url) : '')
    @endif
    <div class="main2">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="/register" class="signup-image-link">Quiero registrame</a>
                    </div>
                    <div class="signup-form">
                        <h2 class="form-title">Iniciar sesión</h2>
                        <form class="register-form" id="register-form" action="{{ $login_url }}"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Correo electronico" />
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{ __('adminlte::adminlte.password') }}" />
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group form-button">
                                <button type="submit" name="signin" id="signin" class="btn-block-custom">
                                    {{ __('adminlte::adminlte.sign_in') }}
                                </button>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">O inicia sesión con: </span>
                            <ul class="socials">
                                <li><a href="{{ url('/login-facebook') }}"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="{{ url('/auth/redirect') }}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
