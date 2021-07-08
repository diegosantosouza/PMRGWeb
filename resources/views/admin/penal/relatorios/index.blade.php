@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Relatórios</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('penal.relatorios') }}" class="text-orange">Relatórios</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <div class="dash_content_app_box">
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
            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="">Interno</h4>
                        <form class="app_form" action="{{ route('gerar.internoPDF') }}" method="post" target="_blank"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="info">
                                <h2>Ordenar por:</h2>

                                <label class="label">
                                    <select name="ordenacao" class="select2">
                                        <option value="n" {{ (old('ordenacao') == 'n' ? 'selected' : '') }}>Número
                                        </option>
                                        <option
                                            value="nome_completo" {{ (old('ordenacao') == 'nome_completo' ? 'selected' : '') }}>
                                            Nome
                                        </option>
                                        <option value="estagio" {{ (old('ordenacao') == 'estagio' ? 'selected' : '') }}>
                                            Estágio
                                        </option>
                                        <option
                                            value="created_at" {{ (old('ordenacao') == 'created_at' ? 'selected' : '') }}>
                                            Inclusão
                                        </option>
                                        <option value="re" {{ (old('ordenacao') == 're' ? 'selected' : '') }}>RE
                                        </option>
                                        <option value="patente" {{ (old('ordenacao') == 'patente' ? 'selected' : '') }}>
                                            Patente
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>

                    <article class="blog radius">
                        <h4 class="">Revista Guarda do Quartel</h4>
                        <form class="app_form" action="{{ route('gerar.guardaPDF') }}" method="post" target="_blank"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="info">
                                <h2>Ordenar por:</h2>

                                <label class="label">
                                    <select name="ordenacao" class="select2">
                                        <option value="" {{ (old('ordenacao') == '' ? 'selected' : '') }}>Todos</option>
                                        <option value="1" {{ (old('ordenacao') == '1' ? 'selected' : '') }}>1º Estágio
                                        </option>
                                        <option value="2" {{ (old('ordenacao') == '2' ? 'selected' : '') }}>2º Estágio
                                        </option>
                                        <option value="3" {{ (old('ordenacao') == '3' ? 'selected' : '') }}>3º Estágio
                                        </option>
                                        <option value="4" {{ (old('ordenacao') == '4' ? 'selected' : '') }}>4º Estágio
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>

                    <article class="users radius">
                        <h4 class="">Recolhidos por Período</h4>
                        <form class="app_form" action="{{ route('gerar.recolhidosPDF') }}" method="post" target="_blank"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Início:</span>
                                    <input type="tel" name="data_inicio" class="mask-date" placeholder="00/00/00"
                                           value="{{ old('data_inicio') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Término:</span>
                                    <input type="tel" name="data_termino" class="mask-date" placeholder="00/00/00"
                                           value="{{ old('data_termino') }}"/>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>
                </section>
            </div>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="">Internos Local de Trabalho</h4>
                        <form class="app_form" action="{{ route('gerar.trabalhoPDF') }}" method="post" target="_blank"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="info">
                                <h2>Local:</h2>

                                <label class="label">
                                    <select name="local" class="select2">
                                        <option value="todos" {{ (old('local') == 'todos' ? 'selected' : '') }}>Todos
                                        </option>
                                        @foreach($locais as $local)
                                            <option
                                                value="{{$local->id}}" {{ (old('local') == $local->id ? 'selected' : '') }}>{{$local->empregador}}
                                                ,{{' horário semana '. $local->horario_semana }}
                                                ,{{' final de semana '. $local->horario_fim_semana }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>

                    <article class="blog radius">
                        <h4 class="">Entrada de Visitantes</h4>
                        <form class="app_form" action="{{ route('gerar.entradavisitantesPDF') }}" method="post"
                              target="_blank" enctype="multipart/form-data">
                            @csrf
                            <div class="info">
                                <h2>Data:</h2>

                                <div class="label_g2">
                                    <label class="label">
                                        <input type="tel" name="data" class="mask-date" placeholder="00/00/00"
                                               value="{{ old('data') }}"/>
                                    </label>
                                </div>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>
                </section>
            </div>
        </div>
    </section>


@endsection

