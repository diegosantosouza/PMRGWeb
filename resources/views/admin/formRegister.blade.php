<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/login.css')) }}"/>
    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>


    <title>Registrar</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="ajax_response"></div>

<div class="dash_login">
    <div class="dash_login_left">
        <article class="dash_login_left_box">
            <header class="dash_login_box_headline">
                <div class="dash_login_box_headline_logo icon-lock icon-notext"></div>
                <h1>Registrar</h1>
            </header>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row my-0">
                    <label for="name" class="col-md-4 col-form-label text-md-right my-0">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row my-0">
                    <label for="re" class="col-md-4 col-form-label text-md-right my-0">{{ __('RE') }}</label>

                    <div class="col-md-6">
                        <input id="re" type="text" class="form-control @error('re') is-invalid @enderror" name="re" value="{{ old('re') }}" required autocomplete="re">
                        @error('re')
                        <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row my-0">
                    <label for="email" class="col-md-4 col-form-label text-md-right my-0">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row my-0">
                    <label for="password" class="col-md-4 col-form-label text-md-right my-0">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback text-orange" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row my-0">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right my-0">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mt-0">
                    <label for="secao" class=" col-md-4 col-form-label text-md-right my-0">{{ __('Seção') }}</label>

                    <div class="col-md-6 mt-1">
                        <select name="secao" class="mt-1">
                            <option value="penal" {{ (old('secao') == 'penal' ? 'selected' : '') }}>Penal</option>
                            <option value="laborterapia" {{ (old('secao') == 'laborterapia' ? 'selected' : '') }}>Laborterapia</option>
                            <option value="juridica" {{ (old('secao') == 'juridica' ? 'selected' : '') }}>Juridica</option>
                            <option value="pjmd" {{ (old('secao') == 'pjmd' ? 'selected' : '') }}>Pjmd</option>
                            <option value="escolta" {{ (old('secao') == 'escolta' ? 'selected' : '') }}>Escolta</option>
                            <option value="guarda" {{ (old('secao') == 'guarda' ? 'selected' : '') }}>Guarda</option>
                            <option value="naps" {{ (old('secao') == 'naps' ? 'selected' : '') }}>Naps</option>
                            <option value="uis" {{ (old('secao') == 'uis' ? 'selected' : '') }}>Uis</option>
                            <option value="uge" {{ (old('secao') == 'uge' ? 'selected' : '') }}>Uge</option>
                            <option value="p1" {{ (old('secao') == 'p1' ? 'selected' : '') }}>P1</option>
                            <option value="p2" {{ (old('secao') == 'p2' ? 'selected' : '') }}>P2</option>
                            <option value="p4" {{ (old('secao') == 'p4' ? 'selected' : '') }}>P4</option>
                            <option value="p5" {{ (old('secao') == 'p5' ? 'selected' : '') }}>P5</option>
                        </select>
                        <hr class="mt-1">

                        @error('secao')
                        <span class="invalid-feedback" role="alert">
                            <div class="message text-orange">
                                <p class="icon-asterisk">{{ $message }}</p>
                            </div>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-md-6 offset-md-4">
                        <button class="gradient gradient-orange radius icon-sign-in" type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
            <footer>
                <p>Versão {{$versao}} - Desenvolvido por <a href="mailto:{{$desenvolvedor}}">{{$desenvolvedor}}</a></p>
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
