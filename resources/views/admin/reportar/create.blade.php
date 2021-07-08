@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-bookmark">Novo PDI</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('pjmd.index') }}">Pjmd</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Criar PDI</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold">{{$interno->nome_guerra}} | Nº{{$interno->n}} | Estágio : {{$interno->estagio}} </h3>
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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos</a>
                    </li>
                </ul>

            <form class="app_form" action="{{ route('pjmd.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <input type="hidden" name="id_interno" value="{{$interno->id}}">

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Número do PDI:</span>
                                <input type="text" name="numero" placeholder="Exemplo 123/20/2020" value="{{ old('numero') }}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*PDI Status:</span>
                                <select name="pdi_status" class="select2">
                                    <option value="Instrução" {{ (old('pdi_status') == 'Instrução' ? 'selected' : '') }}>Instrução</option>
                                    <option value="Finalizado" {{ (old('pdi_status') == 'Finalizado' ? 'selected' : '') }}>Finalizado</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">*Tipo de falta:</span>
                                <select name="tipo_falta" class="select2">
                                    <option value="Leve" {{ (old('tipo_falta') == 'Leve' ? 'selected' : '') }}>Leve</option>
                                    <option value="Média" {{ (old('tipo_falta') == 'Média' ? 'selected' : '') }}>Média</option>
                                    <option value="Grave" {{ (old('tipo_falta') == 'Grave' ? 'selected' : '') }}>Grave</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Data de Início:</span>
                                <input type="tel" name="data_inicio" class="mask-date" value="{{ old('data_inicio') }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Data de Término:</span>
                                <input type="tel" name="data_termino" class="mask-date" value="{{ old('data_termino') }}"/>
                            </label>
                        </div>

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Assunto:</span>
                                <textarea name="assunto" rows="5">{{old('observacoes')}}</textarea>
                            </label>
                        </div>

                        <hr class="mb-1">

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Punição:</span>
                                <textarea name="punicao" rows="5">{{old('punicao')}}</textarea>
                            </label>
                        </div>

                    </div>


                    <div id="documentos" class="d-none">
                        <div class="app_collapse">
                            <div class="app_collapse_content">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Arquivos:</span>
                                        <input type="file" name="arquivos[]" multiple />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

