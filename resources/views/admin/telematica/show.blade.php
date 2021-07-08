@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-desktop">Telemática</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('telematica.index') }}">Telemática</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="">
            <h3 class="text-center text-bold"> Suporte | ID: {{$suporte->id}} | Classificação
                : {{$suporte->modalidade->classificacao}}</h3>
        </div>

        <div class="dash_content_app_box">
            <div class="nav">

                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <div class="message message-orange">
                            <p class="icon-asterisk">{{ $error }}</p>
                        </div>
                    @endforeach
                @endif

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#dados" class="nav_tabs_item_link active">Dados</a>
                    </li>
                </ul>

                <form class="app_form" action="" method="post" enctype="multipart/form-data">
                    <div class="nav_tabs_content">
                        <div id="dados">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Solicitante:</span>
                                    <input type="text" name="solicitante_nome"
                                           value="{{ $suporte->solicitante_nome }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">*RE:</span>
                                    <input type="text" name="solicitante_re" value="{{ $suporte->solicitante_re}}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*IP:</span>
                                    <input type="text" name="ip" value="{{ $suporte->ip}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Seção:</span>
                                    <input type="text" name="solicitante_secao"
                                           value="{{ $suporte->solicitante_secao}}"/>
                                </label>
                            </div>

                            <div class="label_g5">
                                <label class="label">
                                    <span class="legend">*Descrição:</span>
                                    <textarea name="descricao" rows="5">{{$suporte->descricao}}</textarea>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Criado:</span>
                                    <input type="tel" name="created_at"
                                           value="{{$suporte->created_at}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Finalizado:</span>
                                    <input type="tel" name="finalizado"
                                           value="@if($suporte->finalizado == true){{$suporte->updated_at}}@endif"/>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>

                <ul class="nav_tabs mt-1">
                    <li class="nav_tabs_item">
                        <a href="#suporte" class="nav_tabs_item_link active">Suporte</a>
                    </li>
                </ul>
                <form class="app_form" action="" method="post" enctype="multipart/form-data">
                    <div class="nav_tabs_content">
                        <div id="suporte">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Suporte:</span>
                                    <input type="text" name="suporte_nome" value="{{$suporte->suporte_nome}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*RE:</span>
                                    <input type="text" name="suporte_re"
                                           value="{{$suporte->suporte_re}}"/>
                                </label>
                            </div>

                            <div class="label_g5">
                                <label class="label">
                                    <span class="legend">*Solução:</span>
                                    <textarea name="solucao" rows="5">{{$suporte->solucao}}</textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

