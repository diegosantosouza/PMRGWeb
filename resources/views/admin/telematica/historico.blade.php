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
                    <button type="button" id="myModal" class="btn btn-blue icon-file" data-toggle="modal"
                            data-target="#relatorioModal">Relatório
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
                    <article class="users radius">
                        <h4 class="">Buscar por Período</h4>
                        <form class="app_form" action="{{ route('telematica.busca') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Início:</span>
                                    <input type="tel" name="data_inicio" class="mask-date" placeholder="00/00/0000"
                                           value="{{ old('data_inicio') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Término:</span>
                                    <input type="tel" name="data_termino" class="mask-date" placeholder="00/00/0000"
                                           value="{{ old('data_termino') }}"/>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Buscar</button>
                            </div>
                        </form>
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
                    <form class="app_form" action="{{ route('gerar.telematicaPDF') }}" method="post" target="_blank"
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
