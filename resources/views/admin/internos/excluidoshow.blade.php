@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user">Visualizar</h2>

        <div class="">
            <h3 class="text-center text-bold">{{$interno->nome_guerra}} | Nº{{$interno->n}} | Estágio : {{$interno->estagio}} </h3>
        </div>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('internos.index') }}">Internos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('internos.create') }}" class="text-orange">Visualizar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dash_content_app_box">
        <div class="nav">

            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados Cadastrais</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#dados_funcionais" class="nav_tabs_item_link">Dados Funcionais</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#interno" class="nav_tabs_item_link">Interno</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#processual" class="nav_tabs_item_link">Processual <span class="badge badge-info right">{{$interno->processos_count}}</span></a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#documentos" class="nav_tabs_item_link">Documentos <span class="badge badge-warning right">{{$interno->arquivos_count}}</span></a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#visitas" class="nav_tabs_item_link">Visitas <span class="badge badge-success right">{{$interno->visitas_count}}</span></a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#advogados" class="nav_tabs_item_link">Advogados <span class="badge badge-danger right">{{$interno->advogados_count}}</span></a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->p2 == 1)
                    <li class="nav_tabs_item">
                        <a href="#observacoes" class="nav_tabs_item_link">Obs.</a>
                    </li>
                @endif

                <li class="nav_tabs_item">
                    <a href="#estudo" class="nav_tabs_item_link">Estudo
                            @if(!empty($interno->estudo))
                            <span class="badge badge-info right">1</span>
                            @endif
                        </a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#empregador" class="nav_tabs_item_link">Trabalho
                        @if(!empty($interno->empregador))
                            <span class="badge badge-warning right">1</span>
                        @endif
                    </a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#comportamento" class="nav_tabs_item_link">Comportamento <span class="badge badge-success right">{{$interno->comportamento_count}}</span></a>
                </li>
            </ul>

            <form class="app_form" action="" method="post" enctype="multipart/form-data">

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">
                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="nome_completo" value="{{$interno->nome_completo}}"/>
                            </label>

                            <div class="card mx-auto">
                                <img class="dash_sidebar_user_thumb" alt="foto" src="
                                @if($interno->url_foto == null)
                                {{ url(asset('backend/assets/images/avatarDefault.png')) }}">
                                @else
                                    {{url(asset($interno->url_foto))}}">
                                @endif
                            </div>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Genero:</span>
                                <input type="text" name="sexo" value="{{$interno->sexo}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*CPF:</span>
                                <input type="tel" class="mask-doc" name="cpf" value="{{$interno->cpf}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*RG:</span>
                                <input type="text" name="rg" value="{{$interno->rg}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Órgão Expedidor:</span>
                                <input type="text" name="org_expedidor" value="{{$interno->org_expedidor}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                            <span class="legend">Orientação Sexual:</span>
                                <input type="text" name="orientacao_sexual" value="{{$interno->orientacao_sexual}}"/>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Data de Nascimento:</span>
                                <input type="tel" name="nascimento" class="" value="{{$interno->nascimento}} {{' '.$idade->y .' anos'}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Estado:</span>
                                <input type="tel" name="estado" value="{{$interno->estado }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Naturalidade:</span>
                                <input type="tel" name="natural" value="{{$interno->natural }}"/>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Título de Eleitor:</span>
                                <input type="text" name="titulo_eleitor" value="{{$interno->titulo_eleitor}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Zona:</span>
                                <input type="text" name="zona" value="{{$interno->zona}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Seção:</span>
                                <input type="text" name="secao" value="{{$interno->secao}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Escolaridade:</span>
                                <input type="text" name="escolaridade" value="{{$interno->escolaridade}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Religião:</span>
                                <input type="text" name="religiao" value="{{$interno->religiao}}"/>
                            </label>

                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Estado Civil:</span>
                                <input type="text" name="estado_civil" value="{{$interno->estado_civil}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Conjuge</span>
                                <input type="text" name="conjugue" value="{{$interno->conjugue}}"/>
                            </label>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Características Físicas</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Etnia:</span>
                                        <input type="text" name="etnia" value="{{$interno->etnia}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Cabelos:</span>
                                        <input type="text" name="cabelos" value="{{$interno->cabelos}}"/>
                                    </label>
                                </div>
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Olhos:</span>
                                        <input type="text" name="olhos" value="{{$interno->olhos}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Altura:</span>
                                        <input type="text" name="altura" value="{{$interno->altura}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Peso:</span>
                                        <input type="text" name="peso" value="{{$interno->peso }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Defeitos Físicos:</span>
                                        <input type="text" name="defeitos_fisicos" value="{{$interno->defeitos_fisicos }}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Sinais de Nascença:</span>
                                        <input type="text" name="sinais_nascenca" value="{{$interno->sinais_nascenca}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Cicatrizes:</span>
                                        <input type="text" name="cicatrizes" value="{{$interno->cicatrizes}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Tatuagens:</span>
                                        <input type="text" name="tatuagens" value="{{$interno->tatuagens}}"/>
                                    </label>

                                </div>

                            </div>
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
                                        <input type="text" name="mae" value="{{$interno->mae}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Pai:</span>
                                        <input type="text" name="pai" value="{{$interno->pai}}"/>
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
                                        <span class="legend">Endereço:</span>
                                        <input type="text" name="endereco" class="mask-phone" value="{{$interno->endereco}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Cidade:</span>
                                        <input type="text" name="cidade" value="{{$interno->cidade}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Telefone de Contato:</span>
                                        <input type="tel" name="telefone" class="mask-phone" value="{{$interno->telefone}}"/>
                                    </label>
                                    <label class="label">
                                        <span class="legend">Acidente Morte Doença:</span>
                                        <input type="text" name="acidente_doenca_morte" placeholder="Acidente Morte Doença" value="{{$interno->acidente_doenca_morte}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="dados_funcionais" class="d-none">
                        <div class="app_collapse">
                            <div class="app_collapse_header collapse">
                                <h3>Militar</h3>
                                <span class="icon-minus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content">

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Nome de Guerra:</span>
                                        <input type="text" name="nome_guerra" value="{{$interno->nome_guerra}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*RE:</span>
                                        <input type="text" name="re" value="{{$interno->re}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Funcional:</span>
                                        <input type="text" name="funcional" value="{{$interno->funcional}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*Patente:</span>
                                        <input type="text" name="patente" value="{{$interno->patente}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Situacao:</span>
                                        <input type="text" name="situacao" value="{{$interno->situacao}}"/>
                                    </label>

                                </div>

                                <div class="label_g2">

                                    <label class="label">
                                        <span class="legend">*Batalhao:</span>
                                        <input type="text" name="batalhao" value="{{$interno->batalhao}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*Cidade do Batalhão:</span>
                                        <input type="text" name="batalhao_cidade" value="{{$interno->batalhao_cidade}}"/>
                                    </label>

                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Admissao:</span>
                                        <input type="text" name="admissao" class="mask-date" value="{{$interno->admissao}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Demissao:</span>
                                        <input type="tel" name="demissao" class="mask-date" value="{{$interno->demissao}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="interno" class="d-none">
                        <div class="app_collapse">
                            <div class="app_collapse_header collapse">
                                <h3>Interno</h3>
                                <span class="icon-minus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Número:</span>
                                        <input type="text" name="n" value="{{$interno->n}}"/>
                                    </label>
                                    <label class="label">
                                        <span class="legend">*Data de inclusão:</span>
                                        <input type="tel" name="created_at" class="mask-date" placeholder="Data de inclusão" value="{{$interno->created_at}}"/>
                                    </label>
                                </div>

                                <div class="label_g4">
                                    <label class="label">
                                        <span class="legend">Alojamento:</span>
                                        <input type="text" name="alojamento" value="{{$interno->alojamento}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Estagio:</span>
                                        <input type="text" name="estagio" value="{{$interno->estagio}}"/>

                                    </label>

                                    <label class="label">
                                        <span class="legend">Status:</span>
                                        <input type="text" name="status" value="{{$interno->status}}"/>
                                    </label>
                                </div>
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Assistência Jurídica:</span>
                                        <input type="text" name="assistencia_juridica" value="{{$interno->assistencia_juridica}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Procedência:</span>
                                        <input type="text" name="procedencia" placeholder="Procedência" value="{{$interno->procedencia}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Captura de Procurado:</span>
                                        <input type="text" name="captura_procurado" value="{{$interno->captura_procurado}}"/>
                                    </label>


                                    <label class="label">
                                        <span class="legend">Captura Estado:</span>
                                        <input type="text" name="captura_estado" value="{{$interno->captura_estado}}"/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Tipo de Prisão:</span>
                                        <input type="text" name="tipo_prisao" value="{{$interno->tipo_prisao}}"/>
                                    </label>
                                    <label class="label">
                                        <span class="legend">*Situação Anterior Prisão:</span>
                                        <input type="text" name="sit_anterior_prisao" value="{{$interno->sit_anterior_prisao}}"/>
                                    </label>
                                </div>

                                <hr>

                                <div class="label_g2 mt-1">
                                    <label class="label">
                                        <span class="legend">Data de Liberdade/Remoção:</span>
                                        <input type="tel" name="data_liberdade_remocao" class="mask-date" placeholder="Data de Liberdade/Remoção" value="{{$interno->data_liberdade_remocao}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Local:</span>
                                        <input type="text" name="local" placeholder="Local" value="{{$interno->local}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="processual" class="d-none">
                        @if(!empty($interno->processos))
                            @foreach($interno->processos as $processo)
                                <div class="app_collapse mt-2">
                                    <div class="app_collapse_header collapse">
                                        <h3>Nº{{$processo->processo_de_execucao}}</h3>
                                        <span class="icon-plus-circle icon-notext"></span>
                                    </div>
                                    <div class="app_collapse_content d-none">
                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Crime em durante o serviço:</span>
                                                <input type="text" name="em_servico" value="{{ $processo->em_servico}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Processo de Execução:</span>
                                                <input type="text" name="processo_de_execucao" value="{{ $processo->processo_de_execucao }}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Regime:</span>
                                                <input type="text" name="regime" value="{{ $processo->regime}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Numero do Inquérito:</span>
                                                <input type="text" name="n_inquerito" value="{{ $processo->n_inquerito}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Multa:</span>
                                                <input type="text" name="multa" value="{{ $processo->multa}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Situação Processual:</span>
                                                <input type="text" name="sit_processual" value="{{ $processo->sit_processual}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">*Reincidencia:</span>
                                                <input type="text" name="reincidencia" value="{{ $processo->reincidencia}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g4">
                                            <label class="label">
                                                <span class="legend">Pena (Anos):</span>
                                                <input type="text" name="pena_ano" value="{{ $processo->pena_ano}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Pena (Meses):</span>
                                                <input type="text" name="pena_meses"  value="{{ $processo->pena_meses}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Pena (Dias):</span>
                                                <input type="text" name="pena_dias" value="{{ $processo->pena_dias}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Origem Processo:</span>
                                                <input type="text" name="origem_processo" value="{{ $processo->origem_processo}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*CPB CPM:</span>
                                                <input type="text" name="cpb_cpm" value="{{ $processo->cpb_cpm}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Artigo:</span>
                                                <input type="text" name="artigo" value="{{ $processo->artigo}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Medida de Tratamento:</span>
                                                <input type="text" name="medida_tratamento" value="{{ $processo->medida_tratamento}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Comutação:</span>
                                                <input type="text" name="comutacao" value="{{ $processo->comutacao}}"/>
                                            </label>
                                        </div>


                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">Vara Comarca:</span>
                                                <input type="text" name="vara_comarca" value="{{ $processo->vara_comarca }}"/>
                                            </label>
                                            <label class="label">
                                                <span class="legend">Extinção de Punibilidade:</span>
                                                <input type="text" name="exticao_punibilidade" value="{{ $processo->exticao_punibilidade}}"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="no-content">Não foram encontrados registros!</div>
                            @endif
                    </div>

                    <div id="documentos" class="d-none">
                        @if(!empty($interno->arquivos))
                        @foreach($interno->arquivos as $documento)
                            <div class="mt-1">
                                <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                            <hr>
                            </div>
                        @endforeach
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>

                    <div id="visitas" class="d-none">
                        @if(!empty($interno->visitas))
                            @foreach($interno->visitas as $visita)
                                <div class="realty_list">
                                    <div class="realty_list_item mb-1">

                                        <div class="realty_list_item_actions_stats">
                                            <img src="
                                            @if($visita->url_foto == null)
                                            {{ url(asset('backend/assets/images/avatarDefault.png')) }}">
                                            @else
                                                {{url(asset($visita->url_foto))}}">
                                            @endif
                                        </div>

                                        <div class="realty_list_item_content">

                                            @if($visita->status == 'Inativo' || $visita->status =='Suspenso')
                                                <h4>#{{$visita->nome}} - <span class="btn-orange icon-eye">{{$visita->status}}</span></h4>
                                            @else
                                                <h4>#{{$visita->nome}} - <span class="btn-green icon-eye">{{$visita->status}}</span></h4>
                                            @endif

                                            <div class="realty_list_item_card">
                                                <div class="realty_list_item_card_image">
                                                    <span class="icon-users"></span>
                                                </div>
                                                <div class="realty_list_item_card_content">
                                                    <span class="realty_list_item_description_title">Parentesco:</span>
                                                    <span class="realty_list_item_description_content">{{$visita->parentesco}}</span>
                                                </div>
                                            </div>

                                            <div class="realty_list_item_card">
                                                <div class="realty_list_item_card_image">
                                                    <span class="icon-file"></span>
                                                </div>
                                                <div class="realty_list_item_card_content">
                                                    <span class="realty_list_item_description_title">{{$visita->tipo_doc}} :</span>
                                                    <span class="realty_list_item_description_content">{{$visita->documento}} </span>
                                                </div>
                                            </div>

                                            <div class="realty_list_item_card">
                                                <div class="realty_list_item_card_image">
                                                    <span class="icon-phone"></span>
                                                </div>
                                                <div class="realty_list_item_card_content">
                                                    <span class="realty_list_item_description_title">Contato:</span>
                                                    <span class="realty_list_item_description_content">{{$visita->celular}}</span>
                                                </div>
                                            </div>

                                            <div class="realty_list_item_card">
                                                <div class="realty_list_item_card_image">
                                                    <span class="icon-calendar"></span>
                                                </div>
                                                <div class="realty_list_item_card_content">
                                                    <span class="realty_list_item_description_title">Data de nascimento:</span>
                                                    <span class="realty_list_item_description_content">{{$visita->dt_nascimento}}</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="realty_list_item_actions">
                                            <ul>
                                                <li class="icon-eye">{{$visita->status}}</li>
                                            </ul>
                                            <div>
                                                <a href="{{route('visita.show', ['visitum'=>$visita->id])}}" class="btn btn-blue icon-eye">Visualizar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else

                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>

                    <div id="advogados" class="d-none">
                        @if(!empty($interno->advogados))
                            @foreach($interno->advogados as $advogado)
                                <div class="label_g2 mt-1">
                                    <label class="label">
                                        <span class="legend">Nome:</span>
                                        <input type="text" name="nome_advogado" value="{{ $advogado->nome_advogado }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">OAB:</span>
                                        <input type="text" name="oab" value="{{ $advogado->oab}}"/>
                                    </label>
                                </div>

                                <hr>
                            @endforeach
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::user()->p2 == 1)
                        <div id="observacoes" class="d-none">
                            <div class="label_g1 mt-1 mb-1">
                                <label class="label">
                                    <textarea name="observacoes" rows="10">{{$interno->observacoes}}</textarea>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div id="estudo" class="d-none">
                        @if(!empty($interno->ensino))
                        <div class="label_g2 mt-1">
                            <label class="label">
                                <span class="legend">Instituição de ensino:</span>
                                <input type="text" name="instituicao_ensino" value="{{$interno->ensino->instituicao_ensino}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Horáro:</span>
                                <input type="text" name="horario_semana" value="{{ 'seg-sex: '.$interno->ensino->horario_semana. ', '. 'sáb-dom: ' . $interno->ensino->horario_fim_semana}}"/>
                            </label>
                        </div>
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>

                    <div id="empregador" class="d-none">
                        @if(!empty($interno->empregador))
                            <div class="label_g2 mt-1">
                                <label class="label">
                                    <span class="legend">Empregador:</span>
                                    <input type="text" name="empregador" value="{{$interno->trabalho->empregador}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Horáro:</span>
                                    <input type="text" name="horario_semana" value="{{ 'seg-sex: '.$interno->trabalho->horario_semana. ', '. 'sáb-dom: ' . $interno->trabalho->horario_fim_semana}}"/>
                                </label>
                            </div>
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>

                    <div id="comportamento" class="d-none">
                        <div class="label_g2 mt-1">
                            <label class="label">
                                <span class="legend">Comportamento:</span>
                                <input type="text" name="comportamento_status" value="{{$interno->comportamento_status}}"/>
                            </label>
                            <label class="label">
                                <span class="legend">Até Data:</span>
                                <input type="text" name="comportamento_data" value="{{$interno->comportamento_data}}"/>
                            </label>
                        </div>

                    @if(!empty($interno->comportamento))
                            @foreach($interno->comportamento as $comportamento)
                                <div class="app_collapse mt-2">
                                    <div class="app_collapse_header collapse">
                                        <h3>{{$comportamento->numero}}</h3>
                                        <span class="icon-plus-circle icon-notext"></span>
                                    </div>

                                    <div class="app_collapse_content d-none">
                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Número do PDI:</span>
                                                <input type="text" name="numero" placeholder="Exemplo 123/20/2020" value="{{ $comportamento->numero }}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*PDI Status:</span>
                                                <input type="text" name="pdi_status" value="{{ $comportamento->pdi_status}}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">*Tipo de falta:</span>
                                                <input type="text" name="tipo_falta" value="{{ $comportamento->tipo_falta}}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Data de Início:</span>
                                                <input type="tel" name="data_inicio" class="mask-date" value="{{ $comportamento->data_inicio }}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">*Data de Término:</span>
                                                <input type="tel" name="data_termino" class="mask-date" value="{{ $comportamento->data_termino }}"/>
                                            </label>
                                        </div>

                                        <div class="label_g5">
                                            <label class="label">
                                                <span class="legend">Assunto:</span>
                                                <textarea name="assunto" rows="5">{{$comportamento->assunto}}</textarea>
                                            </label>
                                        </div>

                                        <hr class="mb-1">

                                        <div class="label_g5">
                                            <label class="label">
                                                <span class="legend">Punição:</span>
                                                <textarea name="punicao" rows="5">{{$comportamento->punicao}}</textarea>
                                            </label>
                                        </div>

                                        <label class="label">
                                            <span class="legend">Arquivos:</span>
                                                @if(!empty($comportamento->arquivos))
                                                    @foreach($comportamento->arquivos as $documento)
                                                        <div class="mt-1">
                                                            <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                                                            <hr>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="no-content">Não foram encontrados registros!</div>
                                                @endif
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif

                    </div>

                </div>


            </form>
        </div>
    </div>
        <div class="text-right mt-2">
            <a href="{{ route('interno.excluidos.edit', ['interno'=>$interno->id]) }}" class="btn btn-large btn-green icon-check-square-o" type="button">Editar e Restaurar</a>
        </div>

</section>

@endsection

