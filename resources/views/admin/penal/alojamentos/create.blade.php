@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-flag">Criar Alojamento</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Alojamentos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Criar</a></li>
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
                    <a href="#data" class="nav_tabs_item_link active">Alojamento</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('alojamentos.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="data">

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Estágio:</span>
                                <select name="estagio" class="select2">
                                    <option value="1" {{ (old('estagio') == '1' ? 'selected' : '') }}>1</option>
                                    <option value="2" {{ (old('estagio') == '2' ? 'selected' : '') }}>2</option>
                                    <option value="3" {{ (old('estagio') == '3' ? 'selected' : '') }}>3</option>
                                    <option value="4" {{ (old('estagio') == '4' ? 'selected' : '') }}>4</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">Cela:</span>
                                <input type="text" name="cela" placeholder="Nome da cela" value="{{ old('cela')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Capacidade:</span>
                                <input type="text" name="capacidade" placeholder="capacidade de internos" value="{{ old('capacidade')}}"/>
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

