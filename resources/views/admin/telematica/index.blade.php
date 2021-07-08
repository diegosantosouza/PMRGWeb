@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-desktop">Telemática</h2>
                <div class="dash_content_app_header_actions">
                    <nav class="dash_content_app_breadcrumb">
                        <ul>
                            <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                            <li class="separator icon-angle-right icon-notext"></li>
                            <li><a href="{{ route('telematica.index') }}" class="text-orange">Telematica</a></li>
                        </ul>
                    </nav>
                    <button type="button" id="myModal" class="btn btn-orange icon-plus-circle" data-toggle="modal"
                            data-target="#suporteModal">Suporte
                    </button>
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
            </div>
            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4>Este Ano</h4>
                        <h1 class="text-center mt-2 mb-2">{{$suporteAno}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4>Hoje</h4>
                        <h1 class="text-center mt-2 mb-2">{{$suportesHoje}}</h1>
                    </article>

                    <article class="users radius">
                        <h4>Aguardando</h4>
                        <h1 class="text-center mt-2 mb-2">{{$suportes->count()}}</h1>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-users">Suporte</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Solicitante</th>
                            <th>IP</th>
                            <th>Seção</th>
                            <th>Data</th>
                            <th>Suporte</th>
                            <th>Classificação</th>
                            <th>Finalizado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($suportes as $suporte)
                            <tr>
                                <td><a href=""></a>{{ $suporte->id }}</td>
                                <td>{{ $suporte->solicitante_nome}}</td>
                                <td>{{ $suporte->ip}}</td>
                                <td>{{ $suporte->solicitante_secao}}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($suporte->created_at))}}</td>
                                <td>{{ $suporte->suporte_nome}}</td>
                                <td>{{ $suporte->modalidade->classificacao}}</td>
                                <td>@if($suporte->finalizado){{ $suporte->updated_at}}@endif</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye"
                                       href="{{route('telematica.show',['telematica'=>$suporte->id])}}"></a>
                                    <a class="btn btn-green icon-pencil"
                                       href="{{route('telematica.edit',['telematica'=>$suporte->id])}}"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- Adicionar Modal -->
    <div class="modal fade" id="suporteModal" tabindex="-1" aria-labelledby="suporteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="suporteModalLabel">Suporte</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <form class="app_form" action="{{ route('telematica.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" class="mb-1" type="text" name="ip" placeholder=""
                               value="{{$ip ?? old('ip') }}"/>

                        <span>Nome do solicitante:</span>
                        <input class="mb-1" type="text" name="solicitante_nome" placeholder=""
                               value="{{$user->name ?? old('solicitante_nome') }}"/>
                        <span>RE do solicitante:</span>
                        <input class="mb-1" type="text" name="solicitante_re" placeholder=""
                               value="{{$user->re ?? old('solicitante_re') }}"/>
                        <span>Seção</span>
                        <select name="solicitante_secao" class="select2 mb-1">
                            <option value="Penal" {{ (old('solicitante_secao') == 'Penal' ? 'selected' : '') }}>Penal
                            </option>
                            <option
                                value="Laborterapia" {{ (old('solicitante_secao') == 'Laborterapia' ? 'selected' : '') }}>
                                Laborterapia
                            </option>
                            <option value="Juridica" {{ (old('solicitante_secao') == 'Juridica' ? 'selected' : '') }}>
                                Juridica
                            </option>
                            <option value="PJMD" {{ (old('solicitante_secao') == 'PJMD' ? 'selected' : '') }}>PJMD
                            </option>
                            <option value="Escolta" {{ (old('solicitante_secao') == 'Escolta' ? 'selected' : '') }}>
                                Escolta
                            </option>
                            <option value="Guarda" {{ (old('solicitante_secao') == 'Guarda' ? 'selected' : '') }}>
                                Guarda
                            </option>
                            <option value="NAPS" {{ (old('solicitante_secao') == 'NAPS' ? 'selected' : '') }}>NAPS
                            </option>
                            <option value="UIS" {{ (old('solicitante_secao') == 'UIS' ? 'selected' : '') }}>UIS</option>
                            <option value="UGE" {{ (old('solicitante_secao') == 'UGE' ? 'selected' : '') }}>UGE</option>
                            <option value="P1" {{ (old('solicitante_secao') == 'P1' ? 'selected' : '') }}>P1</option>
                            <option value="P2" {{ (old('solicitante_secao') == 'P2' ? 'selected' : '') }}>P2</option>
                            <option value="P4" {{ (old('solicitante_secao') == 'P4' ? 'selected' : '') }}>P4</option>
                            <option value="P5" {{ (old('solicitante_secao') == 'P5' ? 'selected' : '') }}>P5</option>
                        </select>
                        <textarea class="mt-2 mb-1" name="descricao" rows="10"
                                  placeholder="Descreva o que problema (máx:255 caracteres)">{{ old('descricao') }}</textarea>
                        <button type="submit" class="btn btn-green icon-plus">Salvar</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="relatorioModal" tabindex="-1" aria-labelledby="relatorioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="relatorioModalLabel">Relatório</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <h4 class="">Busca por Período</h4>
                    <form class="app_form" action="{{ route('gerar.telematicaPDF') }}" method="post"
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
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="historicoModal" tabindex="-1" aria-labelledby="historicoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="historicoModalLabel">Histórico</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <h4 class="">Busca por Período</h4>
                    <form class="app_form" action="{{ route('gerar.telematicaPDF') }}" method="post"
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
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


@endsection
