@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-bug">Reportar</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('reportar.index') }}" class="text-orange">Reportar</a></li>
                    </ul>
                </nav>
                <button type="button" id="myModal" class="btn btn-orange icon-bug" data-toggle="modal" data-target="#adicionarModal">Reportar</button>
{{--                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>--}}
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
                        @foreach($reportes as $reporte)
                            <article class="control radius mt-1">
                                <div class="text-left">
                                    <h5>{{date('d-m-Y', strtotime($reporte->created_at))}}</h5>
                                    <h3>{{$reporte->erro}}</h3>

                                </div>
                                <h5 class="">Por: {{$reporte->user_nome.' - '.$reporte->user_email}}</h5>
                                        <div class="info">
                                            <h3>Descrição:</h3>
                                            <div>
                                                <p>{{$reporte->descricao}}</p>
                                            </div>
                                        </div>
                                <hr class="my-1">
                                        <div class="actions text-center">
                                            @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                                                <form class="app_form" action="{{ route('reportar.update',['reportar'=>$reporte->id, 'id'=>$reporte->id]) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <h5>Atualizar:</h5>
                                                    <label class="label">
                                                        <select name="status" class="select2">
                                                            <option value="pendente" {{ (old('status') == 'pendente' ? 'selected' : ($reporte->status == 'pendente' ? 'selected' : '')) }}>Pendente</option>
                                                            <option value="solucionado" {{ (old('status') == 'solucionado' ? 'selected' : ($reporte->status == 'solucionado' ? 'selected' : '')) }}>Solucionado</option>
                                                        </select>
                                                    </label>
                                                    <div class="actions text-center">
                                                        @if($reporte->status == 'solucionado')
                                                            <button class="icon-cog btn btn-green" type="submit">Atualizar</button>
                                                            <p>Desenvolvedor: {{$reporte->user_dev.' - '.$reporte->user_dev_email}}</p>
                                                        @else
                                                            <button class="icon-cog btn btn-orange" type="submit">Pendente</button>
                                                        @endif
                                                    </div>
                                                </form>
                                            @else
                                                @if($reporte->status == 'solucionado')
                                                    <button class="icon-chevron-circle-down btn btn-green">Solucionado</button>
                                                    <p>Desenvolvedor: {{$reporte->user_dev.' - '.$reporte->user_dev_email}}</p>
                                                @else
                                                    <button class="icon-cog btn btn-orange">Pendente</button>
                                                @endif
                                            @endif
                                        </div>
                            </article>
                        @endforeach
                    </section>
                </div>
        </div>
    </section>
    <!-- Adicionar Modal -->
    <div class="modal fade" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="adicionarModalLabel">Reportar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <form class="app_form" action="{{ route('reportar.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <span>Qual o tipo de erro encontrado?</span>
                        <input class="mb-1" type="text" name="erro" placeholder="Erro encontrado" value="{{ old('erro') }}"/>
                        <span>Descreva</span>
                        <textarea class="mb-1" name="descricao" rows="10" placeholder="Descreva o que encontrou">{{ old('descricao') }}</textarea>
                        <button type="submit" class="btn btn-green icon-plus">Salvar</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

