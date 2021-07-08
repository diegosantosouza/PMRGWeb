@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-users">{{$estudo->instituicao_ensino}}</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('empregador.index') }}">Jurídica</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('estudos.index') }}" class="text-orange">Estudo</a></li>

                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <section class="app_users_home">
                @foreach($internos as $interno)
                    <article class="user radius">
                        <div class="cover"
                             style="background-size: cover; background-image: url({{ $interno->url_foto }});"></div>
                        <h4>{{$interno->nome_guerra}}</h4>

                        <div class="info">
                            <h3>Nº{{$interno->n}}</h3>
                            <p>{{ date('d/m/Y', strtotime($interno->created_at)) }}</p>
                        </div>

                        <div class="actions">
                            <a class="icon-cog btn btn-orange" href="{{ route('internos.edit', ['interno' => $interno->id]) }}">Gerenciar</a>
                        </div>
                    </article>
                @endforeach
            </section>
        </div>
    </section>
@endsection
