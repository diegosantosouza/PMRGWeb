@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user-plus">Cadastrar Advogado</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Penal</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Cadastrar Advogado</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <div class="dash_content_app_box">
        <div class="nav">

            @if($errors->all())
                @foreach($errors->all() as $error)
                    <div class="message message-orange">
                        <p class="icon-asterisk">{{ $error }}</p>
                    </div>
                @endforeach
            @endif

            @if(session()->exists('message'))
                <div class="message message-{{session()->get('color')}}">
                <p class="icon-asterisk">{{ session()->get('message') }}</p>
                </div>
            @endif


            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#data" class="nav_tabs_item_link active">Advogado</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('advogados.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="data">

                        <input type="hidden" name="id_interno" value="{{$interno}}">

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Nome:</span>
                                <input type="text" name="nome_advogado" placeholder="Nome do advogado" value="{{ old('nome_advogado') }}"/>
                            </label>
                            <label class="label">
                                <span class="legend">OAB n°:</span>
                                <input type="text" name="oab" placeholder="Número OAB" value="{{ old('oab') }}"/>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

