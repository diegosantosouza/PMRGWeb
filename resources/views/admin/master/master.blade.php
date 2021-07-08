<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>


    @hasSection('css')
        @yield('css')
    @endif

    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PMRG - Web</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

@php
    if(\Illuminate\Support\Facades\File::exists(public_path(). '/storage/'. \Illuminate\Support\Facades\Auth::user()->foto)){
        $foto=\Illuminate\Support\Facades\Auth::user()->url_foto;
} else {
        $foto= url(asset('backend/assets/images/avatar.jpg'));
}
@endphp

<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ $foto }}" alt="" title=""/>

            <h1 class="dash_sidebar_user_name">
                <a href="{{ route('users.edit', ['user' => \Illuminate\Support\Facades\Auth::user()['id']]) }}">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</a>
            </h1>
        </article>

        <ul class="dash_sidebar_nav">
        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
            <li class="dash_sidebar_nav_item {{ isActive('admin') }}">
                <a class="icon-cog" href="{{ route('admin') }}">Administrador</a>
            </li>
        @endif

            <li class="dash_sidebar_nav_item {{ isActive('admin.inicio') }}">
                <a class="icon-cog" href="{{ route('admin.inicio') }}">Ínicio</a>
            </li>

        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
            <li class="dash_sidebar_nav_item {{ isActive('users') }}"><a
                        class="icon-user" href="{{ route('users.index') }}">Usuários</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class=""><a href="{{ route('users.index') }}">Ver Todos</a></li>

                    <li class=""><a href="{{ route('users.create') }}">Criar Novo</a></li>

                </ul>
            </li>
        @endif

            <li class="dash_sidebar_nav_item {{ isActive('internos') }} || {{isActive('entradavisitantes')}}"><a
                    class="icon-users" href="{{ route('internos.index') }}">Internos</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class=""><a href="{{ route('internos.index') }}">Lista</a></li>

                    <li class=""><a href="{{ route('entradavisitantes.index') }}">Entrada Visitantes</a></li>

                    <li class=""><a href="{{ route('processos.index') }}">Processos</a></li>

                </ul>
            </li>


            <li class="dash_sidebar_nav_item {{ isActive('penal')}} || {{ isActive('processos')}} || {{ isActive('alojamentos')}} || {{ isActive('visita')}} || {{ isActive('advogados')}}"><a
                    class="icon-book" href="{{ route('penal.index') }}">Penal</a>
                <ul class="dash_sidebar_nav_submenu">

                    <li class=""><a href="{{ route('penal.index') }}">Gerenciar Cadastro</a></li>

                    <li class=""><a href="{{ route('processos.index') }}">Processos</a></li>

                    <li class=""><a href="{{ route('alojamentos.index') }}">Alojamentos</a></li>

                    <li class=""><a href="{{ route('visita.index') }}">Visitas</a></li>

                    <li class=""><a href="{{ route('advogados.index') }}">Advogados</a></li>

                    <li class=""><a href="{{ route('penal.relatorios') }}">Relatórios</a></li>

                    <li class=""><a href="{{ route('interno.excluidos') }}">Arquivo</a></li>

                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('empregador')}} || {{ isActive('estudos')}}"><a class="icon-bullseye" href="{{ route('empregador.index') }}">Jurídica</a>
                <ul class="dash_sidebar_nav_submenu">

                    <li class=""><a href="{{ route('empregador.index') }}">Trabalho</a></li>

                    <li class=""><a href="{{ route('estudos.index') }}">Estudo</a></li>

                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('pjmd')}}"><a class="icon-files-o" href="{{ route('pjmd.index') }}">Pjmd</a>
                <ul class="dash_sidebar_nav_submenu">

                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('telematica')}}"><a class="icon-desktop" href="{{ route('telematica.index') }}">Telemática</a>
                <ul class="dash_sidebar_nav_submenu">

                    <li class=""><a href="{{ route('telematica.index') }}">Suporte</a></li>

                    <li class=""><a href="{{ route('telematica.historico') }}">Histórico</a></li>

                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('reportar')}}"><a class="icon-bug" href="{{ route('reportar.index') }}">Reportar</a>
                <ul class="dash_sidebar_nav_submenu">

                </ul>
            </li>

            <li class="dash_sidebar_nav_item"><a class="icon-reply" href="{{ route('admin.logout') }}">Sair</a></li>


        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <h1 class="transition">
                        <i class="icon-desktop text-orange"></i><a href="{{ route('admin.inicio') }}">PMRG/<b>Web</b></a>
                    </h1>
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash_content_box">
            @yield('content')
        </div>
    </section>
</div>


<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>
<script src="{{ url(asset('backend/assets/js/tinymce/tinymce.min.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/scripts.js')) }}"></script>
<script src="{{ url('backend/assets/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{ url('backend/assets/bootstrap/js/bootstrap.js')}}"></script>

@hasSection('js')
    @yield('js')
@endif

</body>
</html>
