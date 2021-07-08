@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user">Visitante</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('visita.index') }}">Visitas</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Criar visitante</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$visita->id_interno]) }}"></a> {{$visita->interno->nome_guerra}} | Nº{{$visita->interno->n}} | Estágio : {{$visita->interno->estagio}}</h3>
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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos <span class="badge badge-warning right">{{$documentos->count()}}</span></a>
                    </li>
                </ul>

            <form class="app_form" action="" method="post" enctype="multipart/form-data">

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <div class="label_gc">
                            <span class="legend">Possui:</span>
                            <label class="label">
                                <input type="checkbox" name="antecedentes" {{ ($visita->antecedentes == 'on' || $visita->antecedentes == true ? 'checked' : '') }}><span>Antecedentes_Criminal</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="autorizacao_judicial" {{ ($visita->autorizacao_judicial == 'on' || $visita->autorizacao_judicial == true ? 'checked' : '') }}><span>Autorização_Judicial</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="autorizacao_menor" {{ ($visita->autorizacao_menor == 'on' || $visita->autorizacao_menor == true ? 'checked' : '') }}><span>Autorização_Menor</span>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="nome" value="{{$visita->nome}}"/>
                            </label>

                            <div class="card mx-auto">
                                <img class="dash_sidebar_user_thumb" alt="foto" src="{{url(asset($visita->url_foto))}}">
                            </div>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Genero:</span>
                                <input type="text" name="sexo" value="{{$visita->sexo}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Parentesco:</span>
                                <input type="text" name="parentesco" value="{{$visita->parentesco}}"/>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Tipo de Documento:</span>
                                <input type="text" name="tipo_doc" value="{{$visita->tipo_doc}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Documento:</span>
                                <input type="text" name="documento" value="{{$visita->documento}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Status:</span>
                                <input type="text" name="status" value="{{$visita->status}}"/>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Data de Nascimento:</span>
                                <input type="tel" name="dt_nascimento" class="mask-date"
                                       placeholder="Data de Nascimento" value="{{$visita->dt_nascimento}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Nacionalidade:</span>
                                <input type="text" name="nacionalidade" value="{{$visita->nacionalidade}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Naturalidade:</span>
                                <input type="text" name="naturalidade" value="{{$visita->naturalidade}}"/>

                            </label>

                            <label class="label">
                                <span class="legend">*Estado:</span>
                                <input type="text" name="uf" value="{{$visita->uf}}"/>
                            </label>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Filiação</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Mãe:</span>
                                        <input type="text" name="mae" value="{{$visita->mae}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Pai:</span>
                                        <input type="text" name="pai" value="{{$visita->pai}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Endereço</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Endereço:</span>
                                        <input type="text" name="endereco" value="{{$visita->endereco}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*Cidade:</span>
                                        <input type="text" name="cidade" value="{{$visita->cidade}}"/>

                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Telefone de Contato:</span>
                                        <input type="tel" name="celular" class="mask-phone" value="{{$visita->celular}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*CEP:</span>
                                        <input type="tel" name="cep" value="{{ $visita->cep}}"/>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Veículo</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Placa:</span>
                                        <input type="text" name="placa" value="{{$visita->placa }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Modelo:</span>
                                        <input type="text" name="modelo" value="{{$visita->modelo}}"/>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Observações</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g5">
                                    <label class="label">
                                        <span class="legend">Escreva:</span>
                                        <textarea name="observacoes" rows="5">{{$visita->observacoes}}</textarea>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="documentos" class="d-none">
                        @foreach($documentos as $documento)
                            <div class="mt-1">
                                <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

