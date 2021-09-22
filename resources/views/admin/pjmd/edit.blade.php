@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-bookmark">Editar PDI</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('pjmd.index') }}">Pjmd</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Editar PDI</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$comportamento->interno->id]) }}"></a> {{$comportamento->interno->nome_guerra}} | Nº{{$comportamento->interno->n}} | Estágio : {{$comportamento->interno->estagio}}</h3>
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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos <span class="badge badge-warning right">{{$documentos->count()}}</span></a>
                    </li>
                </ul>

            <form class="app_form" action="{{ route('pjmd.update', ['pjmd'=>$comportamento->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <input type="hidden" name="id_interno" value="{{$comportamento->interno->id}}">

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Número do PDI:</span>
                                <input type="text" name="numero" placeholder="Exemplo 123/20/2020" value="{{ old('numero') ?? $comportamento->numero }}"/>
                            </label>
                            <label class="label">
                                <span class="legend">*Tipo de falta:</span>
                                <select name="tipo_falta" class="select2">
                                    <option value="Leve" {{ (old('tipo_falta') == 'Leve' ? 'selected' : ($comportamento->tipo_falta == 'Leve' ? 'selected' : '')) }}>Leve</option>
                                    <option value="Média" {{ (old('tipo_falta') == 'Média' ? 'selected' : ($comportamento->tipo_falta == 'Média' ? 'selected' : '')) }}>Média</option>
                                    <option value="Grave" {{ (old('tipo_falta') == 'Grave' ? 'selected' : ($comportamento->tipo_falta == 'Grave' ? 'selected' : '')) }}>Grave</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*PDI Status:</span>
                                <select name="pdi_status" class="select2">
                                    <option value="Instrução" {{ (old('pdi_status') == 'Instrução' ? 'selected' : ($comportamento->pdi_status == 'Instrução' ? 'selected' : '')) }}>Instrução</option>
                                    <option value="Perda de objeto" {{ (old('pdi_status') == 'Perda de objeto' ? 'selected' : ($comportamento->pdi_status == 'Perda de objeto' ? 'selected' : '')) }}>Perda de objeto</option>
                                    <option value="Finalizado" {{ (old('pdi_status') == 'Finalizado' ? 'selected' : ($comportamento->pdi_status == 'Finalizado' ? 'selected' : '')) }}>Finalizado</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">Outra falta:</span>
                                <select name="outra_falta" class="select2">
                                    <option value="vazio" {{ (old('outra_falta') == 'vazio' ? 'selected' : ($comportamento->outra_falta == 'vazio' ? 'selected' : '')) }}>vazio</option>
                                    <option value="Leve" {{ (old('outra_falta') == 'Leve' ? 'selected' : ($comportamento->outra_falta == 'Leve' ? 'selected' : '')) }}>Leve</option>
                                    <option value="Média" {{ (old('outra_falta') == 'Média' ? 'selected' : ($comportamento->outra_falta == 'Média' ? 'selected' : '')) }}>Média</option>
                                    <option value="Grave" {{ (old('outra_falta') == 'Grave' ? 'selected' : ($comportamento->outra_falta == 'Grave' ? 'selected' : '')) }}>Grave</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Data de Início:</span>
                                <input type="date" name="data_inicio" class="" value="{{ old('data_inicio') ?? date('Y-m-d', strtotime($comportamento->data_inicio)) }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Data de Término:</span>
                                <input type="date" name="data_termino" class=""  @if(!empty($comportamento->data_termino)) value="{{date('Y-m-d', strtotime($comportamento->data_termino))}}"/>@endif
                            </label>
                        </div>

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Assunto:</span>
                                <textarea name="assunto" rows="5">{{old('observacoes') ?? $comportamento->assunto}}</textarea>
                            </label>
                        </div>

                        <hr class="mb-1">

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Punição:</span>
                                <textarea name="punicao" rows="5">{{old('punicao') ?? $comportamento->punicao}}</textarea>
                            </label>
                        </div>

                    </div>

                    <div id="documentos" class="d-none">
                        @foreach($documentos as $documento)
                            <div class="mt-1">
                                <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                                <div class="text-right">
                                    <button type="button" id="myModal" class="btn btn-small btn-red icon-trash" data-toggle="modal" data-target="#deleteArquivo{{$documento->id}}">Deletar</button>
                                </div>
                                <hr>
                            </div>
                        @endforeach

                        <div class="label_g2 mt-1">
                            <label class="label">
                                <span class="legend">Arquivos:</span>
                                <input type="file" name="arquivos[]" multiple />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>
                    <button type="button" id="myModal" class="btn btn-large btn-red icon-trash" data-toggle="modal" data-target="#deleteModal">Deletar</button>
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
                <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                <p class="text-center">Tem certeza que deseja excluir?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                <form action="{{route('pjmd.destroy', ['pjmd'=>$comportamento->id])}}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach($documentos as $documento)
    <!-- Modal Arquivos -->
    <div class="modal fade" id="deleteArquivo{{$documento->id}}" tabindex="-1" aria-labelledby="deleteArquivoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="deleteArquivoLabel">Deletar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                    <p class="text-center">Tem certeza que deseja excluir <strong class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('pjmd.arquivoDelete', ['pjmd'=>$documento->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

