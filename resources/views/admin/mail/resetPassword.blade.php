<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/login.css')) }}"/>
    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>


    <title>Recuperar senha</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="dash_login">
    <div class="dash_login_left">
        <article class="dash_login_left_box">
            <header class="dash_login_box_headline">
                <div class="dash_login_box_headline_logo icon-lock icon-notext"></div>
                <h1>{{ __('Reset Password') }}</h1>
            </header>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <label>
                    <span class="field icon-envelope">{{ __('E-Mail Address') }}</span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </label>

                <label>
                    <span class="field icon-unlock-alt">{{ __('Password') }}</span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </label>

                <label>
                    <span class="field icon-unlock-alt">{{ __('Confirm Password') }}</span>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </label>

                <button class="gradient gradient-orange radius icon-sign-in" type="submit">{{ __('Reset Password') }}</button>

            </form>

            <footer>
                <p>Vers??o 1.0 - Desenvolvido por <a href="mailto:diegossd@policiamilitar.sp.gov.br">diegossd@policiamilitar.sp.gov.br</a></p>
                <p>&copy; <?= date("Y"); ?> - Todos os Direitos Reservados</p>

            </footer>
        </article>
    </div>

    <div class="dash_login_right"></div>

</div>


<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/login.js')) }}"></script>

</body>
</html>

