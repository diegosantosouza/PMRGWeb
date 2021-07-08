@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-gg">Criar Trabalho</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Jurídica</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Trabalho</a></li>
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
                    <a href="#data" class="nav_tabs_item_link active">Trabalho</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('empregador.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="data">

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Empregador:</span>
                                <input type="text" name="empregador" placeholder="Nome da empresa" value="{{ old('empregador')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Horário seg. a sex.:</span>
                                <input type="text" name="horario_semana" placeholder="Ex: 08:30/17:00" value="{{ old('horario_semana')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Horário fim de semana:</span>
                                <input type="text" name="horario_fim_semana" placeholder="Ex: 08:30/13:00" value="{{ old('horario_fim_semana')}}"/>
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

