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

                @if(session()->exists('message'))
                    <div class="message message-{{session()->get('color')}}">
                        <p class="icon-asterisk">{{ session()->get('message') }}</p>
                    </div>
                @endif

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#dados" class="nav_tabs_item_link active">Dados</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('telematica.update', ['telematica'=>$suporte->id]) }}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="nav_tabs_content">
                        <div id="dados">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Solicitante:</span>
                                    <input type="text" name="solicitante_nome"
                                           value="{{ old('solicitante_nome') ?? $suporte->solicitante_nome }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">*RE:</span>
                                    <input type="text" name="solicitante_re"
                                           value="{{ old('solicitante_re') ?? $suporte->solicitante_re}}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*IP:</span>
                                    <input type="text" name="ip" value="{{ old('ip') ?? $suporte->ip}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Seção:</span>
                                    <input type="text" name="solicitante_secao"
                                           value="{{ old('solicitante_secao') ?? $suporte->solicitante_secao}}"/>
                                </label>
                            </div>

                            <div class="label_g5">
                                <label class="label">
                                    <span class="legend">*Descrição:</span>
                                    <textarea name="descricao"
                                              rows="5">{{ old('descricao') ?? $suporte->descricao}}</textarea>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Criado:</span>
                                    <input type="tel" name="created_at"
                                           value="{{ old('created_at') ?? $suporte->created_at}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Finalizado:</span>
                                    <input type="tel" name="finalizado"
                                           value="{{ old('finalizado') ?? $suporte->finalizado}}"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <ul class="nav_tabs mt-1">
                        <li class="nav_tabs_item">
                            <a href="#suporte" class="nav_tabs_item_link active">Suporte</a>
                        </li>
                    </ul>
                    <div class="nav_tabs_content">
                        <div id="suporte">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Suporte:</span>
                                    <input type="text" name="suporte_nome" placeholder="Nome"
                                           value="{{ old('suporte_nome') ?? $user->name}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*RE:</span>
                                    <input type="text" name="suporte_re"
                                           value="{{ old('suporte_re') ?? $user->re}}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Classificação:</span>
                                    <select name="classificacao" class="select2">
                                        <option value="">Selecione</option>
                                        @foreach($modalidade as $classificacao)
                                            <option
                                                value="{{$classificacao->id}}" {{ (old('classificacao') == $classificacao->id ? 'selected' : ($suporte->classificacao == $classificacao->id ? 'selected' :'' )) }}>
                                                {{$classificacao->classificacao}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>

                                <label class="label mt-2">
                                    <input type="checkbox" name="finalizado" {{ (old('finalizado') == 'on' || old('finalizado') == true ? 'checked' : ($suporte->finalizado == true ? 'checked' : '' )) }}><span>Finalizar</span>
                                </label>
                            </div>

                            <div class="label_g5">
                                <label class="label">
                                    <span class="legend">*Solução:</span>
                                    <textarea name="solucao"
                                              rows="5">{{ old('solucao') ?? $suporte->solucao}}</textarea>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                        <button type="button" id="myModal" class="btn btn-large btn-red icon-trash" data-toggle="modal"
                                data-target="#deleteModal">Deletar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="deleteModalLabel">Deletar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{ $user->name }}</h4>
                    <p class="text-center">Tem certeza que deseja excluir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('telematica.destroy', ['telematica'=>$suporte->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

