@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Novo Cadastro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('internos.index') }}">Internos</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('internos.create') }}" class="text-orange">Criar novo</a></li>
                    </ul>
                </nav>
            </div>
        </header>

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
                        <a href="#dados_funcionais" class="nav_tabs_item_link">Dados Funcionais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#interno" class="nav_tabs_item_link">Interno</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('internos.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="nav_tabs_content">
                        <div id="dados_cadastrais">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Nome:</span>
                                    <input type="text" name="nome_completo" placeholder="Nome Completo"
                                           value="{{ old('nome_completo') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Foto</span>
                                    <input type="file" name="foto" value="{{ old('foto') }}">
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Genero:</span>
                                    <select name="sexo" class="select2">
                                        <option value="Masculino" {{ (old('sexo') == 'Masculino' ? 'selected' : '') }}>
                                            Masculino
                                        </option>
                                        <option value="Feminino" {{ (old('sexo') == 'Feminino' ? 'selected' : '') }}>
                                            Feminino
                                        </option>
                                        <option value="Outros" {{ (old('sexo') == 'Outros' ? 'selected' : '') }}>
                                            Outros
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="cpf" placeholder="CPF"
                                           value="{{ old('cpf') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*RG:</span>
                                    <input type="text" name="rg" placeholder="RG" value="{{ old('rg') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Órgão Expedidor:</span>
                                    <input type="text" name="org_expedidor" placeholder="Expedição"
                                           value="{{ old('org_expedidor') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Orientação Sexual:</span>
                                    <select name="orientacao_sexual" class="select2">
                                        <option
                                            value="Heterosexual" {{ (old('orientacao_sexual') == 'Heterosexual' ? 'selected' : '') }}>
                                            Heterosexual
                                        </option>
                                        <option
                                            value="Bissexual" {{ (old('orientacao_sexual') == 'Bissexual' ? 'selected' : '') }}>
                                            Bissexual
                                        </option>
                                        <option
                                            value="Homosexual" {{ (old('orientacao_sexual') == 'Homosexual' ? 'selected' : '') }}>
                                            Homosexual
                                        </option>
                                        <option
                                            value="Assexual" {{ (old('orientacao_sexual') == 'Assexual' ? 'selected' : '') }}>
                                            Assexual
                                        </option>
                                        <option
                                            value="Transexual" {{ (old('orientacao_sexual') == 'Transexual' ? 'selected' : '') }}>
                                            Transexual
                                        </option>
                                        <option
                                            value="Pansexual" {{ (old('orientacao_sexual') == 'Pansexual' ? 'selected' : '') }}>
                                            Pansexual
                                        </option>
                                        <option
                                            value="Intergenero" {{ (old('orientacao_sexual') == 'Intergenero' ? 'selected' : '') }}>
                                            Intergenero
                                        </option>
                                        <option
                                            value="Outros" {{ (old('orientacao_sexual') == 'Outros' ? 'selected' : '') }}>
                                            Outros
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g4">
                                <label class="label">
                                    <span class="legend">*Data de Nascimento:</span>
                                    <input type="tel" name="nascimento" class="mask-date"
                                           placeholder="Data de Nascimento" value="{{ old('nascimento') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Estado:</span>
                                    <select name="estado" id="estado" class="select2 dynamic"
                                            data-dependent="municipio" value="{{ old('estado') }}">
                                        <option value="">Selecione o estado</option>
                                        @foreach($estados as $estado)
                                            <option
                                                value="{{$estado->Nome}}" {{ (old('estado') == $estado->Nome ? 'selected' : '') }}>{{$estado->Nome}}</option>
                                        @endforeach
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">*Naturalidade:</span>
                                    <input type="text" name="natural" class="cidadeBusca"
                                           value="{{ old('natural') }}"
                                           placeholder="Buscar cidade">
                                    </select>
                                </label>
                            </div>

                            <div class="label_g4">
                                <label class="label">
                                    <span class="legend">Título de Eleitor:</span>
                                    <input type="text" name="titulo_eleitor"
                                           placeholder="Título de Eleitor" value="{{ old('titulo_eleitor') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Zona:</span>
                                    <input type="text" name="zona" placeholder="Zona"
                                           value="{{ old('zona') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Seção:</span>
                                    <input type="text" name="secao" placeholder="Seção"
                                           value="{{ old('secao') }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Escolaridade:</span>
                                    <select name="escolaridade" class="select2">
                                        <option
                                            value="Analfabeto" {{ (old('escolaridade') == 'Analfabeto' ? 'selected' : '') }}>
                                            Analfabeto
                                        </option>
                                        <option
                                            value="Ensino Fundamental" {{ (old('escolaridade') == 'Ensino Fundamental' ? 'selected' : '') }}>
                                            Ensino Fundamental
                                        </option>
                                        <option
                                            value="Ensino Fundamental(incompleto)" {{ (old('escolaridade') == 'Ensino Fundamental(incompleto)' ? 'selected' : '') }}>
                                            Ensino Fundamental(incompleto)
                                        </option>
                                        <option
                                            value="Ensino Médio" {{ (old('escolaridade') == 'Ensino Médio' ? 'selected' : '') }}>
                                            Ensino Médio
                                        </option>
                                        <option
                                            value="Ensino Médio(incompleto)" {{ (old('escolaridade') == 'Ensino Médio(incompleto)' ? 'selected' : '') }}>
                                            Ensino Médio(incompleto)
                                        </option>
                                        <option
                                            value="Ensino Superior" {{ (old('escolaridade') == 'Ensino Superior' ? 'selected' : '') }}>
                                            Ensino Superior
                                        </option>
                                        <option
                                            value="Ensino Superior(incompleto)" {{ (old('escolaridade') == 'Ensino Superior(incompleto)' ? 'selected' : '') }}>
                                            Ensino Superior(incompleto)
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">Religião:</span>
                                    <select name="religiao" class="select2">
                                        <option
                                            value="Adventista" {{ (old('religiao') == 'Adventista' ? 'selected' : '') }}>
                                            Adventista
                                        </option>
                                        <option value="Ateu" {{ (old('religiao') == 'Ateu' ? 'selected' : '') }}>Ateu
                                        </option>
                                        <option value="Budista" {{ (old('religiao') == 'Budista' ? 'selected' : '') }}>
                                            Budista
                                        </option>
                                        <option
                                            value="Candomblé" {{ (old('religiao') == 'Candomblé' ? 'selected' : '') }}>
                                            Candomblé
                                        </option>
                                        <option
                                            value="Católica" {{ (old('religiao') == 'Católica' ? 'selected' : '') }}>
                                            Católica
                                        </option>
                                        <option value="Cristã" {{ (old('religiao') == 'Cristã' ? 'selected' : '') }}>
                                            Cristã
                                        </option>
                                        <option
                                            value="Espírita" {{ (old('religiao') == 'Espírita' ? 'selected' : '') }}>
                                            Espírita
                                        </option>
                                        <option
                                            value="Evangélica" {{ (old('religiao') == 'Evangélica' ? 'selected' : '') }}>
                                            Evangélica
                                        </option>
                                        <option value="Mormom" {{ (old('religiao') == 'Mormom' ? 'selected' : '') }}>
                                            Mormom
                                        </option>
                                        <option
                                            value="Muçulmana" {{ (old('religiao') == 'Muçulmana' ? 'selected' : '') }}>
                                            Muçulmana
                                        </option>
                                        <option value="Outras" {{ (old('religiao') == 'Outras' ? 'selected' : '') }}>
                                            Outras
                                        </option>
                                        <option
                                            value="Sem Crédulo" {{ (old('religiao') == 'Sem Crédulo' ? 'selected' : '') }}>
                                            Sem Crédulo
                                        </option>
                                        <option
                                            value="Test. Jeová" {{ (old('religiao') == 'Test. Jeová' ? 'selected' : '') }}>
                                            Test. Jeová
                                        </option>
                                        <option value="Umbanda" {{ (old('religiao') == 'Umbanda' ? 'selected' : '') }}>
                                            Umbanda
                                        </option>
                                    </select>
                                </label>

                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Estado Civil:</span>
                                    <select name="estado_civil" class="select2">
                                        <optgroup label="Cônjuge Obrigatório">
                                            <option
                                                value="Casado" {{ (old('estado_civil') == 'Casado' ? 'selected' : '') }}>
                                                Casado
                                            </option>
                                            <option
                                                value="Separado" {{ (old('estado_civil') == 'Separado' ? 'selected' : '') }}>
                                                Separado
                                            </option>
                                            <option
                                                value="Uniao Estavel" {{ (old('Uniao Estavel') == 'Separado' ? 'selected' : '') }}>
                                                União Estável
                                            </option>
                                        </optgroup>
                                        <optgroup label="Cônjuge não Obrigatório">
                                            <option
                                                value="Solteiro" {{ (old('estado_civil') == 'Solteiro' ? 'selected' : '') }}>
                                                Solteiro
                                            </option>
                                            <option
                                                value="Divorciado" {{ (old('estado_civil') == 'Divorciado' ? 'selected' : '') }}>
                                                Divorciado
                                            </option>
                                            <option
                                                value="Viúvo" {{ (old('estado_civil') == 'Viúvo' ? 'selected' : '') }}>
                                                Viúvo
                                            </option>
                                        </optgroup>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">Conjuge</span>
                                    <input type="text" name="conjugue" placeholder="Nome Completo"
                                           value="{{ old('conjugue') }}"/>
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
                                            <select name="etnia" class="select2">
                                                <option
                                                    value="Amarela" {{ (old('etnia') == 'Amarela' ? 'selected' : '') }}>
                                                    Amarela
                                                </option>
                                                <option
                                                    value="Asiática" {{ (old('etnia') == 'Asiática' ? 'selected' : '') }}>
                                                    Asiática
                                                </option>
                                                <option
                                                    value="Branca" {{ (old('etnia') == 'Branca' ? 'selected' : '') }}>
                                                    Branca
                                                </option>
                                                <option
                                                    value="Indígena" {{ (old('etnia') == 'Indígena' ? 'selected' : '') }}>
                                                    Indígena
                                                </option>
                                                <option value="Parda" {{ (old('etnia') == 'Parda' ? 'selected' : '') }}>
                                                    Parda
                                                </option>
                                                <option value="Preta" {{ (old('etnia') == 'Preta' ? 'selected' : '') }}>
                                                    Preta
                                                </option>
                                                <option
                                                    value="Vermelha" {{ (old('etnia') == 'Vermelha' ? 'selected' : '') }}>
                                                    Vermelha
                                                </option>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Cabelos:</span>
                                            <select name="cabelos" class="select2">
                                                <option
                                                    value="Branco" {{ (old('cabelos') == 'Branco' ? 'selected' : '') }}>
                                                    Branco
                                                </option>
                                                <option
                                                    value="Castanho" {{ (old('cabelos') == 'Castanho' ? 'selected' : '') }}>
                                                    Castanho
                                                </option>
                                                <option
                                                    value="Castanho Escuro" {{ (old('cabelos') == 'Castanho Escuro' ? 'selected' : '') }}>
                                                    Castanho Escuro
                                                </option>
                                                <option
                                                    value="Grisalho" {{ (old('cabelos') == 'Grisalho' ? 'selected' : '') }}>
                                                    Grisalho
                                                </option>
                                                <option
                                                    value="Loiro" {{ (old('cabelos') == 'Loiro' ? 'selected' : '') }}>
                                                    Loiro
                                                </option>
                                                <option
                                                    value="Outros" {{ (old('cabelos') == 'Outros' ? 'selected' : '') }}>
                                                    Outros
                                                </option>
                                                <option
                                                    value="Preto" {{ (old('cabelos') == 'Preto' ? 'selected' : '') }}>
                                                    Preto
                                                </option>
                                                <option
                                                    value="Ruivo" {{ (old('cabelos') == 'Ruivo' ? 'selected' : '') }}>
                                                    Ruivo
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Olhos:</span>
                                            <select name="olhos" class="select2">
                                                <option value="Azuis" {{ (old('olhos') == 'Azuis' ? 'selected' : '') }}>
                                                    Azuis
                                                </option>
                                                <option
                                                    value="Castanhos" {{ (old('olhos') == 'Castanhos' ? 'selected' : '') }}>
                                                    Castanhos
                                                </option>
                                                <option
                                                    value="Castanho Escuro" {{ (old('olhos') == 'Castanho Escuro' ? 'selected' : '') }}>
                                                    Castanho Escuro
                                                </option>
                                                <option
                                                    value="Cinzas" {{ (old('olhos') == 'Cinzas' ? 'selected' : '') }}>
                                                    Cinzas
                                                </option>
                                                <option
                                                    value="Pretos" {{ (old('olhos') == 'Pretos' ? 'selected' : '') }}>
                                                    Pretos
                                                </option>
                                                <option
                                                    value="Verdes" {{ (old('olhos') == 'Verdes' ? 'selected' : '') }}>
                                                    Verdes
                                                </option>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Altura:</span>
                                            <input type="text" name="altura" placeholder="Altura em centímetros"
                                                   value="{{ old('altura') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Peso:</span>
                                            <input type="text" name="peso" placeholder="Peso em Kg"
                                                   value="{{ old('peso') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Defeitos Físicos:</span>
                                            <input type="text" name="defeitos_fisicos" placeholder="Defeitos Físicos"
                                                   value="{{ old('defeitos_fisicos') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Sinais de Nascença:</span>
                                            <input type="text" name="sinais_nascenca" placeholder="Sinais de Nascença"
                                                   value="{{ old('sinais_nascenca') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Cicatrizes:</span>
                                            <input type="text" name="cicatrizes" placeholder="Cicatrizes"
                                                   value="{{ old('cicatrizes') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Tatuagens:</span>
                                            <input type="text" name="tatuagens" placeholder="Tatuagens"
                                                   value="{{ old('tatuagens') }}"/>
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
                                            <input type="text" name="mae"
                                                   placeholder="Nome Completo" value="{{ old('mae') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Pai:</span>
                                            <input type="text" name="pai"
                                                   placeholder="Nome Completo" value="{{ old('pai') }}"/>
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
                                            <input type="text" name="endereco"
                                                   placeholder="Rua, nº, complemento" value="{{ old('endereco') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Cidade:</span>
                                            <input type="text" name="cidade" class="cidadeBusca"
                                                   value="{{ old('cidade') }}"
                                                   placeholder="Buscar cidade">
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Telefone de Contato:</span>
                                            <input type="tel" name="telefone" class="mask-phone"
                                                   placeholder="Número do Telefonce com DDD"
                                                   value="{{ old('telefone') }}"/>
                                        </label>
                                        <label class="label">
                                            <span class="legend">Acidente Morte Doença:</span>
                                            <input type="text" name="acidente_doenca_morte"
                                                   placeholder="Acidente Morte Doença"
                                                   value="{{ old('acidente_doenca_morte') }}"/>
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
                                            <input type="text" name="nome_guerra" placeholder="Nome QRA"
                                                   value="{{ old('nome_guerra') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">*RE:</span>
                                            <input type="text" name="re"
                                                   placeholder="Com digito" value="{{ old('re') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*Funcional:</span>
                                            <input type="text" name="funcional"
                                                   placeholder="Nº do espelho" value="{{ old('funcional') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">*Patente:</span>
                                            <select name="patente" class="select2">
                                                <option
                                                    value="Sd PM" {{ (old('patente') == 'Sd PM' ? 'selected' : '') }}>Sd
                                                    PM
                                                </option>
                                                <option
                                                    value="Ex Sd PM" {{ (old('patente') == 'Ex Sd PM' ? 'selected' : '') }}>
                                                    Ex Sd PM
                                                </option>
                                                <option
                                                    value="Sd PM Ref" {{ (old('patente') == 'Sd PM Ref' ? 'selected' : '') }}>
                                                    Sd PM Ref
                                                </option>
                                                <option
                                                    value="Cb PM" {{ (old('patente') == 'Cb PM' ? 'selected' : '') }}>Cb
                                                    PM
                                                </option>
                                                <option
                                                    value="Ex Cb PM" {{ (old('patente') == 'Ex Cb PM' ? 'selected' : '') }}>
                                                    Ex Cb PM
                                                </option>
                                                <option
                                                    value="Cb PM Ref" {{ (old('patente') == 'Cb PM Ref' ? 'selected' : '') }}>
                                                    Cb PM Ref
                                                </option>
                                                <option
                                                    value="3º Sgt pm" {{ (old('patente') == '3º Sgt pm' ? 'selected' : '') }}>
                                                    3º Sgt pm
                                                </option>
                                                <option
                                                    value="Ex 3º Sgt PM" {{ (old('patente') == 'Ex 3º Sgt PM' ? 'selected' : '') }}>
                                                    Ex 3º Sgt PM
                                                </option>
                                                <option
                                                    value="3º Sgt PM Ref" {{ (old('patente') == '3º Sgt PM Ref' ? 'selected' : '') }}>
                                                    3º Sgt PM Ref
                                                </option>
                                                <option
                                                    value="2º Sgt PM" {{ (old('patente') == '2º Sgt PM' ? 'selected' : '') }}>
                                                    2º Sgt PM
                                                </option>
                                                <option
                                                    value="Ex 2º Sgt PM" {{ (old('patente') == 'Ex 2º Sgt PM' ? 'selected' : '') }}>
                                                    Ex 2º Sgt PM
                                                </option>
                                                <option
                                                    value="2º Sgt PM Ref" {{ (old('patente') == '2º Sgt PM Ref' ? 'selected' : '') }}>
                                                    2º Sgt PM Ref
                                                </option>
                                                <option
                                                    value="1º Sgt PM" {{ (old('patente') == '1º Sgt PM' ? 'selected' : '') }}>
                                                    1º Sgt PM
                                                </option>
                                                <option
                                                    value="Ex 1º Sgt PM" {{ (old('patente') == 'Ex 1º Sgt PM' ? 'selected' : '') }}>
                                                    Ex 1º Sgt PM
                                                </option>
                                                <option
                                                    value="1º Sgt PM Ref" {{ (old('patente') == '1º Sgt PM Ref' ? 'selected' : '') }}>
                                                    1º Sgt PM Ref
                                                </option>
                                                <option
                                                    value="Subten PM" {{ (old('patente') == 'Subten PM' ? 'selected' : '') }}>
                                                    Subten PM
                                                </option>
                                                <option
                                                    value="Ex Subten PM" {{ (old('patente') == 'Ex Subten PM' ? 'selected' : '') }}>
                                                    Ex Subten PM
                                                </option>
                                                <option
                                                    value="Subten PM Ref" {{ (old('patente') == 'Subten PM Ref' ? 'selected' : '') }}>
                                                    Subten PM Ref
                                                </option>
                                                <option
                                                    value="Aluno Oficial" {{ (old('patente') == 'Aluno Oficial' ? 'selected' : '') }}>
                                                    Aluno Oficial
                                                </option>
                                                <option
                                                    value="Aspirante" {{ (old('patente') == 'Aspirante' ? 'selected' : '') }}>
                                                    Aspirante
                                                </option>
                                                <option
                                                    value="2º Ten PM" {{ (old('patente') == '2º Ten PM' ? 'selected' : '') }}>
                                                    2º Ten PM
                                                </option>
                                                <option
                                                    value="Ex 2º Ten PM" {{ (old('patente') == 'Ex 2º Ten PM' ? 'selected' : '') }}>
                                                    Ex 2º Ten PM
                                                </option>
                                                <option
                                                    value="2º Ten PM Res" {{ (old('patente') == '2º Ten PM Res' ? 'selected' : '') }}>
                                                    2º Ten PM Res
                                                </option>
                                                <option
                                                    value="1º Ten PM" {{ (old('patente') == '1º Ten PM' ? 'selected' : '') }}>
                                                    1º Ten PM
                                                </option>
                                                <option
                                                    value="Ex 1º Ten PM" {{ (old('patente') == 'Ex 1º Ten PM' ? 'selected' : '') }}>
                                                    Ex 1º Ten PM
                                                </option>
                                                <option
                                                    value="1º Ten PM Res" {{ (old('patente') == '1º Ten PM Res' ? 'selected' : '') }}>
                                                    1º Ten PM Res
                                                </option>
                                                <option
                                                    value="Capitao PM" {{ (old('patente') == 'Capitao PM' ? 'selected' : '') }}>
                                                    Capitao PM
                                                </option>
                                                <option
                                                    value="Ex Capitao PM" {{ (old('patente') == 'Ex Capitao PM' ? 'selected' : '') }}>
                                                    Ex Capitao PM
                                                </option>
                                                <option
                                                    value="Capitao PM Res" {{ (old('patente') == 'Capitao PM Res' ? 'selected' : '') }}>
                                                    Capitao PM Res
                                                </option>
                                                <option
                                                    value="Major PM" {{ (old('patente') == 'Major PM' ? 'selected' : '') }}>
                                                    Major PM
                                                </option>
                                                <option
                                                    value="Ex Major PM" {{ (old('patente') == 'Ex Major PM' ? 'selected' : '') }}>
                                                    Ex Major PM
                                                </option>
                                                <option
                                                    value="Major PM Res" {{ (old('patente') == 'Major PM Res' ? 'selected' : '') }}>
                                                    Major PM Res
                                                </option>
                                                <option
                                                    value="Ten Coronel PM" {{ (old('patente') == 'Ten Coronel PM' ? 'selected' : '') }}>
                                                    Ten Coronel PM
                                                </option>
                                                <option
                                                    value="Ex Ten Coronel PM" {{ (old('patente') == 'Ex Ten Coronel PM' ? 'selected' : '') }}>
                                                    Ex Ten Coronel PM
                                                </option>
                                                <option
                                                    value="Ten Coronel PM Res" {{ (old('patente') == 'Ten Coronel PM Res' ? 'selected' : '') }}>
                                                    Ten Coronel PM Res
                                                </option>
                                                <option
                                                    value="Coronel PM" {{ (old('patente') == 'Coronel PM' ? 'selected' : '') }}>
                                                    Coronel PM
                                                </option>
                                                <option
                                                    value="Ex Coronel PM" {{ (old('patente') == 'Ex Coronel PM' ? 'selected' : '') }}>
                                                    Ex Coronel PM
                                                </option>
                                                <option
                                                    value="Coronel PM Res" {{ (old('patente') == 'Coronel PM Res' ? 'selected' : '') }}>
                                                    Coronel PM Res
                                                </option>
                                                <option
                                                    value="Civil" {{ (old('patente') == 'Civil' ? 'selected' : '') }}>
                                                    Civil
                                                </option>
                                            </select>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*Situacao:</span>
                                            <select name="situacao" class="select2">
                                                <option
                                                    value="Ativa" {{ (old('situacao') == 'Ativa' ? 'selected' : '') }}>
                                                    Ativa
                                                </option>
                                                <option
                                                    value="Civil" {{ (old('situacao') == 'Civil' ? 'selected' : '') }}>
                                                    Civil
                                                </option>
                                                <option
                                                    value="Demitido" {{ (old('situacao') == 'Demitido' ? 'selected' : '') }}>
                                                    Demitido
                                                </option>
                                                <option
                                                    value="Exonerado" {{ (old('situacao') == 'Exonerado' ? 'selected' : '') }}>
                                                    Exonerado
                                                </option>
                                                <option
                                                    value="Expulso" {{ (old('situacao') == 'Expulso' ? 'selected' : '') }}>
                                                    Expulso
                                                </option>
                                                <option
                                                    value="Reformado" {{ (old('situacao') == 'Reformado' ? 'selected' : '') }}>
                                                    Reformado
                                                </option>
                                            </select>
                                        </label>

                                    </div>

                                    <div class="label_g2">

                                        <label class="label">
                                            <span class="legend">*Batalhao:</span>
                                            <select name="batalhao" class="select2">
                                                <optgroup label="Outros">
                                                    <option
                                                        value="Vazio" {{ (old('batalhao') == 'Vazio' ? 'selected' : '') }}>
                                                        Vazio
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Comando Geral">
                                                    <option
                                                        value="Comando Geral" {{ (old('batalhao') == 'Comando Geral' ? 'selected' : '') }}>
                                                        Comando Geral
                                                    </option>
                                                    <option
                                                        value="Corregedoria" {{ (old('batalhao') == 'Corregedoria' ? 'selected' : '') }}>
                                                        Corregedoria
                                                    </option>
                                                    <option
                                                        value="DSA/CG" {{ (old('batalhao') == 'DSA/CG' ? 'selected' : '') }}>
                                                        DSA/CG
                                                    </option>
                                                    <option
                                                        value="EM/PM" {{ (old('batalhao') == 'EM/PM' ? 'selected' : '') }}>
                                                        EM/PM
                                                    </option>
                                                    <option
                                                        value="CoordOp" {{ (old('batalhao') == 'CoordOp' ? 'selected' : '') }}>
                                                        CoordOp
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Assesoria">
                                                    <option
                                                        value="APMAL" {{ (old('batalhao') == 'APMAL' ? 'selected' : '') }}>
                                                        APMAL
                                                    </option>
                                                    <option
                                                        value="APMCMSP" {{ (old('batalhao') == 'APMCMSP' ? 'selected' : '') }}>
                                                        APMCMSP
                                                    </option>
                                                    <option
                                                        value="APMPGJ" {{ (old('batalhao') == 'APMPGJ' ? 'selected' : '') }}>
                                                        APMPGJ
                                                    </option>
                                                    <option
                                                        value="APMPMSP" {{ (old('batalhao') == 'APMPMSP' ? 'selected' : '') }}>
                                                        APMPMSP
                                                    </option>
                                                    <option
                                                        value="APMSAP" {{ (old('batalhao') == 'APMSAP' ? 'selected' : '') }}>
                                                        APMSAP
                                                    </option>
                                                    <option
                                                        value="APMSJDC" {{ (old('batalhao') == 'APMSJDC' ? 'selected' : '') }}>
                                                        APMSJDC
                                                    </option>
                                                    <option
                                                        value="APMSSP" {{ (old('batalhao') == 'APMSSP' ? 'selected' : '') }}>
                                                        APMSSP
                                                    </option>
                                                    <option
                                                        value="APMTJ" {{ (old('batalhao') == 'APMTJ' ? 'selected' : '') }}>
                                                        APMTJ
                                                    </option>
                                                    <option
                                                        value="Casa Militar" {{ (old('batalhao') == 'Casa Militar' ? 'selected' : '') }}>
                                                        Casa Militar
                                                    </option>
                                                    <option
                                                        value="CAJ" {{ (old('batalhao') == 'CAJ' ? 'selected' : '') }}>
                                                        CAJ
                                                    </option>
                                                    <option
                                                        value="PMRG" {{ (old('batalhao') == 'PMRG' ? 'selected' : '') }}>
                                                        PMRG
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Centros">
                                                    <option
                                                        value="CAPS" {{ (old('batalhao') == 'CAPS' ? 'selected' : '') }}>
                                                        CAPS
                                                    </option>
                                                    <option
                                                        value="CIAF" {{ (old('batalhao') == 'CIAF' ? 'selected' : '') }}>
                                                        CIAF
                                                    </option>
                                                    <option
                                                        value="CIAP" {{ (old('batalhao') == 'CIAP' ? 'selected' : '') }}>
                                                        CIAP
                                                    </option>
                                                    <option
                                                        value="CMed" {{ (old('batalhao') == 'CMed' ? 'selected' : '') }}>
                                                        CMed
                                                    </option>
                                                    <option
                                                        value="COdont" {{ (old('batalhao') == 'COdont' ? 'selected' : '') }}>
                                                        COdont
                                                    </option>
                                                    <option
                                                        value="CPD" {{ (old('batalhao') == 'CPD' ? 'selected' : '') }}>
                                                        CPD
                                                    </option>
                                                    <option
                                                        value="COPOM" {{ (old('batalhao') == 'COPOM' ? 'selected' : '') }}>
                                                        COPOM
                                                    </option>
                                                    <option
                                                        value="CMB" {{ (old('batalhao') == 'CMB' ? 'selected' : '') }}>
                                                        CMB
                                                    </option>
                                                    <option
                                                        value="CSMMInt" {{ (old('batalhao') == 'CSMMInt' ? 'selected' : '') }}>
                                                        CSMMInt
                                                    </option>
                                                    <option
                                                        value="CMM" {{ (old('batalhao') == 'CMM' ? 'selected' : '') }}>
                                                        CMM
                                                    </option>
                                                    <option
                                                        value="CMMSubs" {{ (old('batalhao') == 'CMMSubs' ? 'selected' : '') }}>
                                                        CMMSubs
                                                    </option>
                                                    <option
                                                        value="CTel" {{ (old('batalhao') == 'CTel' ? 'selected' : '') }}>
                                                        CTel
                                                    </option>
                                                    <option
                                                        value="CRPM" {{ (old('batalhao') == 'CRPM' ? 'selected' : '') }}>
                                                        CRPM
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Diretoria">
                                                    <option
                                                        value="DP" {{ (old('batalhao') == 'DP' ? 'selected' : '') }}>DP
                                                    </option>
                                                    <option
                                                        value="DF" {{ (old('batalhao') == 'DF' ? 'selected' : '') }}>DF
                                                    </option>
                                                    <option
                                                        value="DL" {{ (old('batalhao') == 'DL' ? 'selected' : '') }}>DL
                                                    </option>
                                                    <option
                                                        value="DS" {{ (old('batalhao') == 'DS' ? 'selected' : '') }}>DS
                                                    </option>
                                                    <option
                                                        value="DTic" {{ (old('batalhao') == 'DTic' ? 'selected' : '') }}>
                                                        DTic
                                                    </option>
                                                    <option
                                                        value="DPCDH" {{ (old('batalhao') == 'DPCDH' ? 'selected' : '') }}>
                                                        DPCDH
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Especializada">
                                                    <option
                                                        value="CMUS" {{ (old('batalhao') == 'CMUS' ? 'selected' : '') }}>
                                                        CMUS
                                                    </option>
                                                    <option
                                                        value="CPChq" {{ (old('batalhao') == 'CPChq' ? 'selected' : '') }}>
                                                        CPChq
                                                    </option>
                                                    <option
                                                        value="1º BPChq" {{ (old('batalhao') == '1º BPChq' ? 'selected' : '') }}>
                                                        1º BPChq
                                                    </option>
                                                    <option
                                                        value="2º BPChq" {{ (old('batalhao') == '2º BPChq' ? 'selected' : '') }}>
                                                        2º BPChq
                                                    </option>
                                                    <option
                                                        value="3º BPChq" {{ (old('batalhao') == '3º BPChq' ? 'selected' : '') }}>
                                                        3º BPChq
                                                    </option>
                                                    <option
                                                        value="4º BPChq" {{ (old('batalhao') == '4º BPChq' ? 'selected' : '') }}>
                                                        4º BPChq
                                                    </option>
                                                    <option
                                                        value="5º BPChq" {{ (old('batalhao') == '5º BPChq' ? 'selected' : '') }}>
                                                        5º BPChq
                                                    </option>
                                                    <option
                                                        value="GRPAe" {{ (old('batalhao') == 'GRPAe' ? 'selected' : '') }}>
                                                        GRPAe
                                                    </option>
                                                    <option
                                                        value="CCB" {{ (old('batalhao') == 'CCB' ? 'selected' : '') }}>
                                                        CCB
                                                    </option>
                                                    <option
                                                        value="CPTran" {{ (old('batalhao') == 'CPTran' ? 'selected' : '') }}>
                                                        CPTran
                                                    </option>
                                                    <option
                                                        value="1º BPTran" {{ (old('batalhao') == '1º BPTran' ? 'selected' : '') }}>
                                                        1º BPTran
                                                    </option>
                                                    <option
                                                        value="2º BPTran" {{ (old('batalhao') == '2º BPTran' ? 'selected' : '') }}>
                                                        2º BPTran
                                                    </option>
                                                    <option
                                                        value="CPAmb" {{ (old('batalhao') == 'CPAmb' ? 'selected' : '') }}>
                                                        CPAmb
                                                    </option>
                                                    <option
                                                        value="1º BPAmb" {{ (old('batalhao') == '1º BPAmb' ? 'selected' : '') }}>
                                                        1º BPAmb
                                                    </option>
                                                    <option
                                                        value="2º BPAmb" {{ (old('batalhao') == '2º BPAmb' ? 'selected' : '') }}>
                                                        2º BPAmb
                                                    </option>
                                                    <option
                                                        value="3º BPAmb" {{ (old('batalhao') == '3º BPAmb' ? 'selected' : '') }}>
                                                        3º BPAmb
                                                    </option>
                                                    <option
                                                        value="4º BPAmb" {{ (old('batalhao') == '4º BPAmb' ? 'selected' : '') }}>
                                                        4º BPAmb
                                                    </option>
                                                    <option
                                                        value="RPMon" {{ (old('batalhao') == 'RPMon' ? 'selected' : '') }}>
                                                        RPMon
                                                    </option>
                                                    <option
                                                        value="RODOVIÁRIA" {{ (old('batalhao') == 'RODOVIÁRIA' ? 'selected' : '') }}>
                                                        RODOVIÁRIA
                                                    </option>
                                                    <option
                                                        value="Asa Ambiental" {{ (old('batalhao') == 'Asa Ambiental' ? 'selected' : '') }}>
                                                        Asa Ambiental
                                                    </option>
                                                    <option
                                                        value="Asa Rodoviária" {{ (old('batalhao') == 'Asa Rodoviária' ? 'selected' : '') }}>
                                                        Asa Rodoviária
                                                    </option>
                                                    <option
                                                        value="1º BAEP" {{ (old('batalhao') == '1º BAEP' ? 'selected' : '') }}>
                                                        1º BAEP
                                                    </option>
                                                    <option
                                                        value="2º BAEP" {{ (old('batalhao') == '2º BAEP' ? 'selected' : '') }}>
                                                        2º BAEP
                                                    </option>
                                                    <option
                                                        value="3º BAEP" {{ (old('batalhao') == '3º BAEP' ? 'selected' : '') }}>
                                                        3º BAEP
                                                    </option>
                                                    <option
                                                        value="4º BAEP" {{ (old('batalhao') == '4º BAEP' ? 'selected' : '') }}>
                                                        4º BAEP
                                                    </option>
                                                    <option
                                                        value="5º BAEP" {{ (old('batalhao') == '5º BAEP' ? 'selected' : '') }}>
                                                        5º BAEP
                                                    </option>
                                                    <option
                                                        value="6º BAEP" {{ (old('batalhao') == '6º BAEP' ? 'selected' : '') }}>
                                                        6º BAEP
                                                    </option>
                                                    <option
                                                        value="7º BAEP" {{ (old('batalhao') == '7º BAEP' ? 'selected' : '') }}>
                                                        7º BAEP
                                                    </option>
                                                    <option
                                                        value="8º BAEP" {{ (old('batalhao') == '8º BAEP' ? 'selected' : '') }}>
                                                        8º BAEP
                                                    </option>
                                                    <option
                                                        value="9º BAEP" {{ (old('batalhao') == '9º BAEP' ? 'selected' : '') }}>
                                                        9º BAEP
                                                    </option>
                                                    <option
                                                        value="10º BAEP" {{ (old('batalhao') == '10º BAEP' ? 'selected' : '') }}>
                                                        10º BAEP
                                                    </option>
                                                    <option
                                                        value="11º BAEP" {{ (old('batalhao') == '11º BAEP' ? 'selected' : '') }}>
                                                        11º BAEP
                                                    </option>
                                                    <option
                                                        value="12º BAEP" {{ (old('batalhao') == '12º BAEP' ? 'selected' : '') }}>
                                                        12º BAEP
                                                    </option>
                                                    <option
                                                        value="13º BAEP" {{ (old('batalhao') == '13º BAEP' ? 'selected' : '') }}>
                                                        13º BAEP
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Unidade Escola">
                                                    <option
                                                        value="APMBB" {{ (old('batalhao') == 'APMBB' ? 'selected' : '') }}>
                                                        APMBB
                                                    </option>
                                                    <option
                                                        value="ESSgt" {{ (old('batalhao') == 'ESSgt' ? 'selected' : '') }}>
                                                        ESSgt
                                                    </option>
                                                    <option
                                                        value="ESSd" {{ (old('batalhao') == 'ESSd' ? 'selected' : '') }}>
                                                        ESSd
                                                    </option>
                                                    <option
                                                        value="EEF" {{ (old('batalhao') == 'EEF' ? 'selected' : '') }}>
                                                        EEF
                                                    </option>
                                                    <option
                                                        value="CAES" {{ (old('batalhao') == 'CAES' ? 'selected' : '') }}>
                                                        CAES
                                                    </option>
                                                    <option
                                                        value="CAS" {{ (old('batalhao') == 'CAS' ? 'selected' : '') }}>
                                                        CAS
                                                    </option>
                                                    <option
                                                        value="QAOPM" {{ (old('batalhao') == 'QAOPM' ? 'selected' : '') }}>
                                                        QAOPM
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Grandes Comandos">
                                                    <option
                                                        value="CPC" {{ (old('batalhao') == 'CPC' ? 'selected' : '') }}>
                                                        CPC
                                                    </option>
                                                    <option
                                                        value="CPM" {{ (old('batalhao') == 'CPM' ? 'selected' : '') }}>
                                                        CPM
                                                    </option>
                                                    <option
                                                        value="CPAM-1" {{ (old('batalhao') == 'CPAM-1' ? 'selected' : '') }}>
                                                        CPAM-1
                                                    </option>
                                                    <option
                                                        value="CPAM-2" {{ (old('batalhao') == 'CPAM-2' ? 'selected' : '') }}>
                                                        CPAM-2
                                                    </option>
                                                    <option
                                                        value="CPAM-3" {{ (old('batalhao') == 'CPAM-3' ? 'selected' : '') }}>
                                                        CPAM-3
                                                    </option>
                                                    <option
                                                        value="CPAM-4" {{ (old('batalhao') == 'CPAM-4' ? 'selected' : '') }}>
                                                        CPAM-4
                                                    </option>
                                                    <option
                                                        value="CPAM-5" {{ (old('batalhao') == 'CPAM-5' ? 'selected' : '') }}>
                                                        CPAM-5
                                                    </option>
                                                    <option
                                                        value="CPAM-6" {{ (old('batalhao') == 'CPAM-6' ? 'selected' : '') }}>
                                                        CPAM-6
                                                    </option>
                                                    <option
                                                        value="CPAM-7" {{ (old('batalhao') == 'CPAM-7' ? 'selected' : '') }}>
                                                        CPAM-7
                                                    </option>
                                                    <option
                                                        value="CPAM-8" {{ (old('batalhao') == 'CPAM-8' ? 'selected' : '') }}>
                                                        CPAM-8
                                                    </option>
                                                    <option
                                                        value="CPAM-9" {{ (old('batalhao') == 'CPAM-9' ? 'selected' : '') }}>
                                                        CPAM-9
                                                    </option>
                                                    <option
                                                        value="CPAM-10" {{ (old('batalhao') == 'CPAM-10' ? 'selected' : '') }}>
                                                        CPAM-10
                                                    </option>
                                                    <option
                                                        value="CPAM-11" {{ (old('batalhao') == 'CPAM-11' ? 'selected' : '') }}>
                                                        CPAM-11
                                                    </option>
                                                    <option
                                                        value="CPAM-12" {{ (old('batalhao') == 'CPAM-12' ? 'selected' : '') }}>
                                                        CPAM-12
                                                    </option>
                                                </optgroup>
                                                <optgroup label="CPI">
                                                    <option
                                                        value="CPI-1" {{ (old('batalhao') == 'CPI-1' ? 'selected' : '') }}>
                                                        CPI-1
                                                    </option>
                                                    <option
                                                        value="CPI-2" {{ (old('batalhao') == 'CPI-2' ? 'selected' : '') }}>
                                                        CPI-2
                                                    </option>
                                                    <option
                                                        value="CPI-3" {{ (old('batalhao') == 'CPI-3' ? 'selected' : '') }}>
                                                        CPI-3
                                                    </option>
                                                    <option
                                                        value="CPI-4" {{ (old('batalhao') == 'CPI-4' ? 'selected' : '') }}>
                                                        CPI-4
                                                    </option>
                                                    <option
                                                        value="CPI-5" {{ (old('batalhao') == 'CPI-5' ? 'selected' : '') }}>
                                                        CPI-5
                                                    </option>
                                                    <option
                                                        value="CPI-6" {{ (old('batalhao') == 'CPI-6' ? 'selected' : '') }}>
                                                        CPI-6
                                                    </option>
                                                    <option
                                                        value="CPI-7" {{ (old('batalhao') == 'CPI-7' ? 'selected' : '') }}>
                                                        CPI-7
                                                    </option>
                                                    <option
                                                        value="CPI-8" {{ (old('batalhao') == 'CPI-8' ? 'selected' : '') }}>
                                                        CPI-8
                                                    </option>
                                                    <option
                                                        value="CPI-9" {{ (old('batalhao') == 'CPI-9' ? 'selected' : '') }}>
                                                        CPI-9
                                                    </option>
                                                    <option
                                                        value="CPI-10" {{ (old('batalhao') == 'CPI-10' ? 'selected' : '') }}>
                                                        CPI-10
                                                    </option>
                                                </optgroup>
                                                <optgroup label="BPM/M">
                                                    <option
                                                        value="1º BPM/M" {{ (old('batalhao') == '1º BPM/M' ? 'selected' : '') }}>
                                                        1º BPM/M
                                                    </option>
                                                    <option
                                                        value="2º BPM/M" {{ (old('batalhao') == '2º BPM/M' ? 'selected' : '') }}>
                                                        2º BPM/M
                                                    </option>
                                                    <option
                                                        value="3º BPM/M" {{ (old('batalhao') == '3º BPM/M' ? 'selected' : '') }}>
                                                        3º BPM/M
                                                    </option>
                                                    <option
                                                        value="4º BPM/M" {{ (old('batalhao') == '4º BPM/M' ? 'selected' : '') }}>
                                                        4º BPM/M
                                                    </option>
                                                    <option
                                                        value="5º BPM/M" {{ (old('batalhao') == '5º BPM/M' ? 'selected' : '') }}>
                                                        5º BPM/M
                                                    </option>
                                                    <option
                                                        value="6º BPM/M" {{ (old('batalhao') == '6º BPM/M' ? 'selected' : '') }}>
                                                        6º BPM/M
                                                    </option>
                                                    <option
                                                        value="7º BPM/M" {{ (old('batalhao') == '7º BPM/M' ? 'selected' : '') }}>
                                                        7º BPM/M
                                                    </option>
                                                    <option
                                                        value="8º BPM/M" {{ (old('batalhao') == '8º BPM/M' ? 'selected' : '') }}>
                                                        8º BPM/M
                                                    </option>
                                                    <option
                                                        value="9º BPM/M" {{ (old('batalhao') == '9º BPM/M' ? 'selected' : '') }}>
                                                        9º BPM/M
                                                    </option>
                                                    <option
                                                        value="10º BPM/M" {{ (old('batalhao') == '10º BPM/M' ? 'selected' : '') }}>
                                                        10º BPM/M
                                                    </option>
                                                    <option
                                                        value="11º BPM/M" {{ (old('batalhao') == '11º BPM/M' ? 'selected' : '') }}>
                                                        11º BPM/M
                                                    </option>
                                                    <option
                                                        value="12º BPM/M" {{ (old('batalhao') == '12º BPM/M' ? 'selected' : '') }}>
                                                        12º BPM/M
                                                    </option>
                                                    <option
                                                        value="13º BPM/M" {{ (old('batalhao') == '13º BPM/M' ? 'selected' : '') }}>
                                                        13º BPM/M
                                                    </option>
                                                    <option
                                                        value="14º BPM/M" {{ (old('batalhao') == '14º BPM/M' ? 'selected' : '') }}>
                                                        14º BPM/M
                                                    </option>
                                                    <option
                                                        value="15º BPM/M" {{ (old('batalhao') == '15º BPM/M' ? 'selected' : '') }}>
                                                        15º BPM/M
                                                    </option>
                                                    <option
                                                        value="16º BPM/M" {{ (old('batalhao') == '16º BPM/M' ? 'selected' : '') }}>
                                                        16º BPM/M
                                                    </option>
                                                    <option
                                                        value="17º BPM/M" {{ (old('batalhao') == '17º BPM/M' ? 'selected' : '') }}>
                                                        17º BPM/M
                                                    </option>
                                                    <option
                                                        value="18º BPM/M" {{ (old('batalhao') == '18º BPM/M' ? 'selected' : '') }}>
                                                        18º BPM/M
                                                    </option>
                                                    <option
                                                        value="19º BPM/M" {{ (old('batalhao') == '19º BPM/M' ? 'selected' : '') }}>
                                                        19º BPM/M
                                                    </option>
                                                    <option
                                                        value="20º BPM/M" {{ (old('batalhao') == '20º BPM/M' ? 'selected' : '') }}>
                                                        20º BPM/M
                                                    </option>
                                                    <option
                                                        value="21º BPM/M" {{ (old('batalhao') == '21º BPM/M' ? 'selected' : '') }}>
                                                        21º BPM/M
                                                    </option>
                                                    <option
                                                        value="22º BPM/M" {{ (old('batalhao') == '22º BPM/M' ? 'selected' : '') }}>
                                                        22º BPM/M
                                                    </option>
                                                    <option
                                                        value="23º BPM/M" {{ (old('batalhao') == '23º BPM/M' ? 'selected' : '') }}>
                                                        23º BPM/M
                                                    </option>
                                                    <option
                                                        value="24º BPM/M" {{ (old('batalhao') == '24º BPM/M' ? 'selected' : '') }}>
                                                        24º BPM/M
                                                    </option>
                                                    <option
                                                        value="25º BPM/M" {{ (old('batalhao') == '25º BPM/M' ? 'selected' : '') }}>
                                                        25º BPM/M
                                                    </option>
                                                    <option
                                                        value="26º BPM/M" {{ (old('batalhao') == '26º BPM/M' ? 'selected' : '') }}>
                                                        26º BPM/M
                                                    </option>
                                                    <option
                                                        value="27º BPM/M" {{ (old('batalhao') == '27º BPM/M' ? 'selected' : '') }}>
                                                        27º BPM/M
                                                    </option>
                                                    <option
                                                        value="28º BPM/M" {{ (old('batalhao') == '28º BPM/M' ? 'selected' : '') }}>
                                                        28º BPM/M
                                                    </option>
                                                    <option
                                                        value="29º BPM/M" {{ (old('batalhao') == '29º BPM/M' ? 'selected' : '') }}>
                                                        29º BPM/M
                                                    </option>
                                                    <option
                                                        value="30º BPM/M" {{ (old('batalhao') == '30º BPM/M' ? 'selected' : '') }}>
                                                        30º BPM/M
                                                    </option>
                                                    <option
                                                        value="31º BPM/M" {{ (old('batalhao') == '31º BPM/M' ? 'selected' : '') }}>
                                                        31º BPM/M
                                                    </option>
                                                    <option
                                                        value="32º BPM/M" {{ (old('batalhao') == '32º BPM/M' ? 'selected' : '') }}>
                                                        32º BPM/M
                                                    </option>
                                                    <option
                                                        value="33º BPM/M" {{ (old('batalhao') == '33º BPM/M' ? 'selected' : '') }}>
                                                        33º BPM/M
                                                    </option>
                                                    <option
                                                        value="34º BPM/M" {{ (old('batalhao') == '34º BPM/M' ? 'selected' : '') }}>
                                                        34º BPM/M
                                                    </option>
                                                    <option
                                                        value="35º BPM/M" {{ (old('batalhao') == '35º BPM/M' ? 'selected' : '') }}>
                                                        35º BPM/M
                                                    </option>
                                                    <option
                                                        value="36º BPM/M" {{ (old('batalhao') == '36º BPM/M' ? 'selected' : '') }}>
                                                        36º BPM/M
                                                    </option>
                                                    <option
                                                        value="37º BPM/M" {{ (old('batalhao') == '37º BPM/M' ? 'selected' : '') }}>
                                                        37º BPM/M
                                                    </option>
                                                    <option
                                                        value="38º BPM/M" {{ (old('batalhao') == '38º BPM/M' ? 'selected' : '') }}>
                                                        38º BPM/M
                                                    </option>
                                                    <option
                                                        value="39º BPM/M" {{ (old('batalhao') == '39º BPM/M' ? 'selected' : '') }}>
                                                        39º BPM/M
                                                    </option>
                                                    <option
                                                        value="40º BPM/M" {{ (old('batalhao') == '40º BPM/M' ? 'selected' : '') }}>
                                                        40º BPM/M
                                                    </option>
                                                    <option
                                                        value="41º BPM/M" {{ (old('batalhao') == '41º BPM/M' ? 'selected' : '') }}>
                                                        41º BPM/M
                                                    </option>
                                                    <option
                                                        value="42º BPM/M" {{ (old('batalhao') == '42º BPM/M' ? 'selected' : '') }}>
                                                        42º BPM/M
                                                    </option>
                                                    <option
                                                        value="43º BPM/M" {{ (old('batalhao') == '43º BPM/M' ? 'selected' : '') }}>
                                                        43º BPM/M
                                                    </option>
                                                    <option
                                                        value="44º BPM/M" {{ (old('batalhao') == '44º BPM/M' ? 'selected' : '') }}>
                                                        44º BPM/M
                                                    </option>
                                                    <option
                                                        value="45º BPM/M" {{ (old('batalhao') == '45º BPM/M' ? 'selected' : '') }}>
                                                        45º BPM/M
                                                    </option>
                                                    <option
                                                        value="46º BPM/M" {{ (old('batalhao') == '46º BPM/M' ? 'selected' : '') }}>
                                                        46º BPM/M
                                                    </option>
                                                    <option
                                                        value="47º BPM/M" {{ (old('batalhao') == '47º BPM/M' ? 'selected' : '') }}>
                                                        47º BPM/M
                                                    </option>
                                                    <option
                                                        value="48º BPM/M" {{ (old('batalhao') == '48º BPM/M' ? 'selected' : '') }}>
                                                        48º BPM/M
                                                    </option>
                                                    <option
                                                        value="49º BPM/M" {{ (old('batalhao') == '49º BPM/M' ? 'selected' : '') }}>
                                                        49º BPM/M
                                                    </option>
                                                    <option
                                                        value="50º BPM/M" {{ (old('batalhao') == '50º BPM/M' ? 'selected' : '') }}>
                                                        50º BPM/M
                                                    </option>
                                                    <option
                                                        value="51º BPM/M" {{ (old('batalhao') == '51º BPM/M' ? 'selected' : '') }}>
                                                        51º BPM/M
                                                    </option>
                                                </optgroup>
                                                <optgroup label="BPM/I">
                                                    <option
                                                        value="1º BPM/I" {{ (old('batalhao') == '1º BPM/I' ? 'selected' : '') }}>
                                                        1º BPM/I
                                                    </option>
                                                    <option
                                                        value="2º BPM/I" {{ (old('batalhao') == '2º BPM/I' ? 'selected' : '') }}>
                                                        2º BPM/I
                                                    </option>
                                                    <option
                                                        value="3º BPM/I" {{ (old('batalhao') == '3º BPM/I' ? 'selected' : '') }}>
                                                        3º BPM/I
                                                    </option>
                                                    <option
                                                        value="4º BPM/I" {{ (old('batalhao') == '4º BPM/I' ? 'selected' : '') }}>
                                                        4º BPM/I
                                                    </option>
                                                    <option
                                                        value="5º BPM/I" {{ (old('batalhao') == '5º BPM/I' ? 'selected' : '') }}>
                                                        5º BPM/I
                                                    </option>
                                                    <option
                                                        value="6º BPM/I" {{ (old('batalhao') == '6º BPM/I' ? 'selected' : '') }}>
                                                        6º BPM/I
                                                    </option>
                                                    <option
                                                        value="7º BPM/I" {{ (old('batalhao') == '7º BPM/I' ? 'selected' : '') }}>
                                                        7º BPM/I
                                                    </option>
                                                    <option
                                                        value="8º BPM/I" {{ (old('batalhao') == '8º BPM/I' ? 'selected' : '') }}>
                                                        8º BPM/I
                                                    </option>
                                                    <option
                                                        value="9º BPM/I" {{ (old('batalhao') == '9º BPM/I' ? 'selected' : '') }}>
                                                        9º BPM/I
                                                    </option>
                                                    <option
                                                        value="10º BPM/I" {{ (old('batalhao') == '10º BPM/I' ? 'selected' : '') }}>
                                                        10º BPM/I
                                                    </option>
                                                    <option
                                                        value="11º BPM/I" {{ (old('batalhao') == '11º BPM/I' ? 'selected' : '') }}>
                                                        11º BPM/I
                                                    </option>
                                                    <option
                                                        value="12º BPM/I" {{ (old('batalhao') == '12º BPM/I' ? 'selected' : '') }}>
                                                        12º BPM/I
                                                    </option>
                                                    <option
                                                        value="13º BPM/I" {{ (old('batalhao') == '13º BPM/I' ? 'selected' : '') }}>
                                                        13º BPM/I
                                                    </option>
                                                    <option
                                                        value="14º BPM/I" {{ (old('batalhao') == '14º BPM/I' ? 'selected' : '') }}>
                                                        14º BPM/I
                                                    </option>
                                                    <option
                                                        value="15º BPM/I" {{ (old('batalhao') == '15º BPM/I' ? 'selected' : '') }}>
                                                        15º BPM/I
                                                    </option>
                                                    <option
                                                        value="16º BPM/I" {{ (old('batalhao') == '16º BPM/I' ? 'selected' : '') }}>
                                                        16º BPM/I
                                                    </option>
                                                    <option
                                                        value="17º BPM/I" {{ (old('batalhao') == '17º BPM/I' ? 'selected' : '') }}>
                                                        17º BPM/I
                                                    </option>
                                                    <option
                                                        value="18º BPM/I" {{ (old('batalhao') == '18º BPM/I' ? 'selected' : '') }}>
                                                        18º BPM/I
                                                    </option>
                                                    <option
                                                        value="19º BPM/I" {{ (old('batalhao') == '19º BPM/I' ? 'selected' : '') }}>
                                                        19º BPM/I
                                                    </option>
                                                    <option
                                                        value="20º BPM/I" {{ (old('batalhao') == '20º BPM/I' ? 'selected' : '') }}>
                                                        20º BPM/I
                                                    </option>
                                                    <option
                                                        value="21º BPM/I" {{ (old('batalhao') == '21º BPM/I' ? 'selected' : '') }}>
                                                        21º BPM/I
                                                    </option>
                                                    <option
                                                        value="22º BPM/I" {{ (old('batalhao') == '22º BPM/I' ? 'selected' : '') }}>
                                                        22º BPM/I
                                                    </option>
                                                    <option
                                                        value="23º BPM/I" {{ (old('batalhao') == '23º BPM/I' ? 'selected' : '') }}>
                                                        23º BPM/I
                                                    </option>
                                                    <option
                                                        value="24º BPM/I" {{ (old('batalhao') == '24º BPM/I' ? 'selected' : '') }}>
                                                        24º BPM/I
                                                    </option>
                                                    <option
                                                        value="25º BPM/I" {{ (old('batalhao') == '25º BPM/I' ? 'selected' : '') }}>
                                                        25º BPM/I
                                                    </option>
                                                    <option
                                                        value="26º BPM/I" {{ (old('batalhao') == '26º BPM/I' ? 'selected' : '') }}>
                                                        26º BPM/I
                                                    </option>
                                                    <option
                                                        value="27º BPM/I" {{ (old('batalhao') == '27º BPM/I' ? 'selected' : '') }}>
                                                        27º BPM/I
                                                    </option>
                                                    <option
                                                        value="28º BPM/I" {{ (old('batalhao') == '28º BPM/I' ? 'selected' : '') }}>
                                                        28º BPM/I
                                                    </option>
                                                    <option
                                                        value="29º BPM/I" {{ (old('batalhao') == '29º BPM/I' ? 'selected' : '') }}>
                                                        29º BPM/I
                                                    </option>
                                                    <option
                                                        value="30º BPM/I" {{ (old('batalhao') == '30º BPM/I' ? 'selected' : '') }}>
                                                        30º BPM/I
                                                    </option>
                                                    <option
                                                        value="31º BPM/I" {{ (old('batalhao') == '31º BPM/I' ? 'selected' : '') }}>
                                                        31º BPM/I
                                                    </option>
                                                    <option
                                                        value="32º BPM/I" {{ (old('batalhao') == '32º BPM/I' ? 'selected' : '') }}>
                                                        32º BPM/I
                                                    </option>
                                                    <option
                                                        value="33º BPM/I" {{ (old('batalhao') == '33º BPM/I' ? 'selected' : '') }}>
                                                        33º BPM/I
                                                    </option>
                                                    <option
                                                        value="34º BPM/I" {{ (old('batalhao') == '34º BPM/I' ? 'selected' : '') }}>
                                                        34º BPM/I
                                                    </option>
                                                    <option
                                                        value="35º BPM/I" {{ (old('batalhao') == '35º BPM/I' ? 'selected' : '') }}>
                                                        35º BPM/I
                                                    </option>
                                                    <option
                                                        value="36º BPM/I" {{ (old('batalhao') == '36º BPM/I' ? 'selected' : '') }}>
                                                        36º BPM/I
                                                    </option>
                                                    <option
                                                        value="37º BPM/I" {{ (old('batalhao') == '37º BPM/I' ? 'selected' : '') }}>
                                                        37º BPM/I
                                                    </option>
                                                    <option
                                                        value="38º BPM/I" {{ (old('batalhao') == '38º BPM/I' ? 'selected' : '') }}>
                                                        38º BPM/I
                                                    </option>
                                                    <option
                                                        value="39º BPM/I" {{ (old('batalhao') == '39º BPM/I' ? 'selected' : '') }}>
                                                        39º BPM/I
                                                    </option>
                                                    <option
                                                        value="40º BPM/I" {{ (old('batalhao') == '40º BPM/I' ? 'selected' : '') }}>
                                                        40º BPM/I
                                                    </option>
                                                    <option
                                                        value="41º BPM/I" {{ (old('batalhao') == '41º BPM/I' ? 'selected' : '') }}>
                                                        41º BPM/I
                                                    </option>
                                                    <option
                                                        value="42º BPM/I" {{ (old('batalhao') == '42º BPM/I' ? 'selected' : '') }}>
                                                        42º BPM/I
                                                    </option>
                                                    <option
                                                        value="43º BPM/I" {{ (old('batalhao') == '43º BPM/I' ? 'selected' : '') }}>
                                                        43º BPM/I
                                                    </option>
                                                    <option
                                                        value="44º BPM/I" {{ (old('batalhao') == '44º BPM/I' ? 'selected' : '') }}>
                                                        44º BPM/I
                                                    </option>
                                                    <option
                                                        value="45º BPM/I" {{ (old('batalhao') == '45º BPM/I' ? 'selected' : '') }}>
                                                        45º BPM/I
                                                    </option>
                                                    <option
                                                        value="46º BPM/I" {{ (old('batalhao') == '46º BPM/I' ? 'selected' : '') }}>
                                                        46º BPM/I
                                                    </option>
                                                    <option
                                                        value="47º BPM/I" {{ (old('batalhao') == '47º BPM/I' ? 'selected' : '') }}>
                                                        47º BPM/I
                                                    </option>
                                                    <option
                                                        value="48º BPM/I" {{ (old('batalhao') == '48º BPM/I' ? 'selected' : '') }}>
                                                        48º BPM/I
                                                    </option>
                                                    <option
                                                        value="49º BPM/I" {{ (old('batalhao') == '49º BPM/I' ? 'selected' : '') }}>
                                                        49º BPM/I
                                                    </option>
                                                    <option
                                                        value="50º BPM/I" {{ (old('batalhao') == '50º BPM/I' ? 'selected' : '') }}>
                                                        50º BPM/I
                                                    </option>
                                                    <option
                                                        value="51º BPM/I" {{ (old('batalhao') == '51º BPM/I' ? 'selected' : '') }}>
                                                        51º BPM/I
                                                    </option>
                                                    <option
                                                        value="52º BPM/I" {{ (old('batalhao') == '52º BPM/I' ? 'selected' : '') }}>
                                                        52º BPM/I
                                                    </option>
                                                    <option
                                                        value="53º BPM/I" {{ (old('batalhao') == '53º BPM/I' ? 'selected' : '') }}>
                                                        53º BPM/I
                                                    </option>
                                                    <option
                                                        value="54º BPM/I" {{ (old('batalhao') == '54º BPM/I' ? 'selected' : '') }}>
                                                        54º BPM/I
                                                    </option>
                                                </optgroup>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">*Cidade do Batalhão:</span>
                                            <input type="text" name="batalhao_cidade" class="cidadeBusca"
                                                   value="{{ old('batalhao_cidade') }}" placeholder="Buscar cidade">
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Admissao:</span>
                                            <input type="tel" name="admissao" class="mask-date"
                                                   placeholder="Data de Admissão"
                                                   value="{{ old('admissao') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Demissao:</span>
                                            <input type="tel" name="demissao" class="mask-date"
                                                   placeholder="Data de Demissão"
                                                   value="{{ old('demissao') }}"/>
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
                                            <select name="n" class="select2">
                                                @foreach($numeros as $numero)
                                                    <option
                                                        value="{{$numero}}" {{ (old('n') == $numero ? 'selected' : '') }}>{{$numero}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label class="label">
                                            <span class="legend">*Data de inclusão:</span>
                                            <input type="tel" name="created_at" class="mask-date"
                                                   placeholder="Data de inclusão" value="{{ old('created_at') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g4">
                                        <label class="label">
                                            <span class="legend">Alojamento:</span>
                                            <select name="alojamento" class="select2">
                                                @foreach($alojamentos as $alojamento)
                                                    <option
                                                        value="{{$alojamento->cela}}" {{ (old('alojamento') == $alojamento->cela ? 'selected' : '') }}>{{$alojamento->cela}}</option>
                                                @endforeach
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Estagio:</span>
                                            <select name="estagio" class="select2">
                                                <option value="1" {{ (old('estagio') == '1' ? 'selected' : '') }}>1
                                                </option>
                                                <option value="2" {{ (old('estagio') == '2' ? 'selected' : '') }}>2
                                                </option>
                                                <option value="3" {{ (old('estagio') == '3' ? 'selected' : '') }}>3
                                                </option>
                                                <option value="4" {{ (old('estagio') == '4' ? 'selected' : '') }}>4
                                                </option>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Status:</span>
                                            <select name="status" class="select2">
                                                <option
                                                    value="Alvará de Soltura" {{ (old('status') == 'Alvará de Soltura' ? 'selected' : '') }}>
                                                    Alvará de Soltura
                                                </option>
                                                <option
                                                    value="Condenado" {{ (old('status') == 'Condenado' ? 'selected' : '') }}>
                                                    Condenado
                                                </option>
                                                <option
                                                    value="Deserção" {{ (old('status') == 'Deserção' ? 'selected' : '') }}>
                                                    Deserção
                                                </option>
                                                <option
                                                    value="Desinternacao Condicional" {{ (old('status') == 'Desinternacao Condicional' ? 'selected' : '') }}>
                                                    Desinternacao Condicional
                                                </option>
                                                <option
                                                    value="Evadido" {{ (old('status') == 'Evadido' ? 'selected' : '') }}>
                                                    Evadido
                                                </option>
                                                <option
                                                    value="Falecido" {{ (old('status') == 'Falecido' ? 'selected' : '') }}>
                                                    Falecido
                                                </option>
                                                <option
                                                    value="Flagrante" {{ (old('status') == 'Flagrante' ? 'selected' : '') }}>
                                                    Flagrante
                                                </option>
                                                <option
                                                    value="Indulto" {{ (old('status') == 'Indulto' ? 'selected' : '') }}>
                                                    Indulto
                                                </option>
                                                <option
                                                    value="Indulto Humanitario" {{ (old('status') == 'Indulto Humanitario' ? 'selected' : '') }}>
                                                    Indulto Humanitario
                                                </option>
                                                <option
                                                    value="Liberdade Condicional" {{ (old('status') == 'Liberdade Condicional' ? 'selected' : '') }}>
                                                    Liberdade Condicional
                                                </option>
                                                <option
                                                    value="Prisao Albergue Domiciliar" {{ (old('status') == 'Prisao Albergue Domiciliar' ? 'selected' : '') }}>
                                                    Prisao Albergue Domiciliar
                                                </option>
                                                <option
                                                    value="Prisao Civil Pensao Alimentícia" {{ (old('status') == 'Prisao Civil Pensao Alimentícia' ? 'selected' : '') }}>
                                                    Prisao Civil Pensao Alimentícia
                                                </option>
                                                <option
                                                    value="Prisao Preventiva" {{ (old('status') == 'Prisao Preventiva' ? 'selected' : '') }}>
                                                    Prisao Preventiva
                                                </option>
                                                <option
                                                    value="Prisao Temporaria" {{ (old('status') == 'Prisao Temporaria' ? 'selected' : '') }}>
                                                    Prisao Temporaria
                                                </option>
                                                <option
                                                    value="Termino Prisao Civil" {{ (old('status') == 'Termino Prisao Civil' ? 'selected' : '') }}>
                                                    Termino Prisao Civil
                                                </option>
                                                <option
                                                    value="Termino Prisao Temporaria" {{ (old('status') == 'Termino Prisao Temporaria' ? 'selected' : '') }}>
                                                    Termino Prisao Temporaria
                                                </option>
                                                <option
                                                    value="Termo Liberacao PAD" {{ (old('status') == 'Termo Liberacao PAD' ? 'selected' : '') }}>
                                                    Termo Liberacao PAD
                                                </option>
                                                <option
                                                    value="Termo Liberdade Provisoria" {{ (old('status') == 'Termo Liberdade Provisoria' ? 'selected' : '') }}>
                                                    Termo Liberdade Provisoria
                                                </option>
                                                <option
                                                    value="Transferido para outro Presidio" {{ (old('status') == 'Transferido para outro Presidio' ? 'selected' : '') }}>
                                                    Transferido para outro Presidio
                                                </option>
                                            </select>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Assistência Jurídica:</span>
                                            <select name="assistencia_juridica" class="select2">
                                                <option
                                                    value="Assistencia Juridica Própria" {{ (old('assistencia_juridica') == 'Assistencia Juridica Própria' ? 'selected' : '') }}>
                                                    Assistencia Juridica Própria
                                                </option>
                                                <option
                                                    value="Advogado de Associação" {{ (old('assistencia_juridica') == 'Advogado de Associação' ? 'selected' : '') }}>
                                                    Advogado de Associação
                                                </option>
                                                <option
                                                    value="Advogado do Estabelecimento" {{ (old('assistencia_juridica') == 'Advogado do Estabelecimento' ? 'selected' : '') }}>
                                                    Advogado do Estabelecimento
                                                </option>
                                                <option
                                                    value="Defensoria Pública" {{ (old('assistencia_juridica') == 'Defensoria Pública' ? 'selected' : '') }}>
                                                    Defensoria Pública
                                                </option>
                                                <option
                                                    value="Funap" {{ (old('assistencia_juridica') == 'Funap' ? 'selected' : '') }}>
                                                    Funap
                                                </option>
                                                <option
                                                    value="n/c" {{ (old('assistencia_juridica') == 'n/c' ? 'selected' : '') }}>
                                                    n/c
                                                </option>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Procedência:</span>
                                            <input type="text" name="procedencia" placeholder="Procedência"
                                                   value="{{ old('procedencia') }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Captura de Procurado:</span>
                                            <select name="captura_procurado" class="select2">
                                                <option
                                                    value="Não" {{ (old('captura_procurado') == 'Não' ? 'selected' : '') }}>
                                                    Não
                                                </option>
                                                <option
                                                    value="Sim" {{ (old('captura_procurado') == 'Sim' ? 'selected' : '') }}>
                                                    Sim
                                                </option>
                                            </select>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Captura Estado:</span>
                                            <select name="captura_estado" class="select2">
                                                @foreach($estados as $estado)
                                                    <option
                                                        value="{{$estado->Nome}}" {{ (old('captura_estado') == $estado->Nome ? 'selected' : '') }}>{{$estado->Nome}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Tipo de Prisão:</span>
                                            <select name="tipo_prisao" class="select2">
                                                <option
                                                    value="Condenado" {{ (old('tipo_prisao') == 'Condenado' ? 'selected' : '') }}>
                                                    Condenado
                                                </option>
                                                <option
                                                    value="Flagrante" {{ (old('tipo_prisao') == 'Flagrante' ? 'selected' : '') }}>
                                                    Flagrante
                                                </option>
                                                <option
                                                    value="Medida Internação" {{ (old('tipo_prisao') == 'Medida Internação' ? 'selected' : '') }}>
                                                    Medida Internação
                                                </option>
                                                <option
                                                    value="Medida Segurança" {{ (old('tipo_prisao') == 'Medida Segurança' ? 'selected' : '') }}>
                                                    Medida Segurança
                                                </option>
                                                <option
                                                    value="Preventiva" {{ (old('tipo_prisao') == 'Preventiva' ? 'selected' : '') }}>
                                                    Preventiva
                                                </option>
                                                <option
                                                    value="Temporária" {{ (old('tipo_prisao') == 'Temporária' ? 'selected' : '') }}>
                                                    Temporária
                                                </option>
                                            </select>
                                        </label>
                                        <label class="label">
                                            <span class="legend">*Situação Anterior Prisão:</span>
                                            <select name="sit_anterior_prisao" class="select2">
                                                <option
                                                    value="PM da Ativa" {{ (old('sit_anterior_prisao') == 'PM da Ativa' ? 'selected' : '') }}>
                                                    PM da Ativa
                                                </option>
                                                <option
                                                    value="PM Reformado" {{ (old('sit_anterior_prisao') == 'PM Reformado' ? 'selected' : '') }}>
                                                    PM Reformado
                                                </option>
                                                <option
                                                    value="Ex Policial Militar" {{ (old('sit_anterior_prisao') == 'Ex Policial Militar' ? 'selected' : '') }}>
                                                    Ex Policial Militar
                                                </option>
                                                <option
                                                    value="Oficial da Reserva" {{ (old('sit_anterior_prisao') == 'Oficial da Reserva' ? 'selected' : '') }}>
                                                    Oficial da Reserva
                                                </option>
                                                <option
                                                    value="Autônomo" {{ (old('sit_anterior_prisao') == 'Autônomo' ? 'selected' : '') }}>
                                                    Autônomo
                                                </option>
                                                <option
                                                    value="Desempregado" {{ (old('sit_anterior_prisao') == 'Desempregado' ? 'selected' : '') }}>
                                                    Desempregado
                                                </option>
                                                <option
                                                    value="Empregado Formal" {{ (old('sit_anterior_prisao') == 'Empregado Formal' ? 'selected' : '') }}>
                                                    Empregado Formal
                                                </option>
                                                <option
                                                    value="Empregado Informal" {{ (old('sit_anterior_prisao') == 'Empregado Informal' ? 'selected' : '') }}>
                                                    Empregado Informal
                                                </option>
                                                <option
                                                    value="Empregador" {{ (old('sit_anterior_prisao') == 'Empregador' ? 'selected' : '') }}>
                                                    Empregador
                                                </option>
                                            </select>
                                        </label>

                                    </div>

                                    <hr>

                                    <div class="label_g2 mt-1">
                                        <label class="label">
                                            <span class="legend">Data de Liberdade/Remoção:</span>
                                            <input type="tel" name="data_liberdade_remocao" class="mask-date"
                                                   placeholder="Data de Liberdade/Remoção"
                                                   value="{{ old('data_liberdade_remocao') }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Local:</span>
                                            <input type="text" name="local" placeholder="Local"
                                                   value="{{ old('local') }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="documentos" class="d-none">
                            <div class="app_collapse">
                                <div class="app_collapse_content">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Arquivos:</span>
                                            <input type="file" name="arquivos[]" multiple/>
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

@section('js')
    <script src="{{ url(asset('backend/assets/js/jquery-ui.min.js')) }}"></script>
    <script>
        $(document).ready(function () {
            var _token = $('input[name="_token"]').val();
            {{--$('.dynamic').change(function () {--}}
            {{--    if ($(this).val() != '') {--}}
            {{--        var value = $(this).val();--}}
            {{--        var dependent = $(this).data('dependent');--}}

            {{--        $.ajax({--}}
            {{--            url: "{{ route('interno.EstadoMunicipios') }}",--}}
            {{--            method: "POST",--}}
            {{--            data: {value: value, _token: _token, dependent: dependent},--}}
            {{--            success: function (result) {--}}
            {{--                $('#' + dependent).html(result);--}}
            {{--            }--}}
            {{--        })--}}
            {{--    }--}}
            {{--});--}}

            // $('#estado').change(function () {
            //     $('#municipio').val('');
            // });

            $('.cidadeBusca').autocomplete({
                minLength: 2,
                delay: 500,
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{route('interno.cidadeBusca')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: _token,
                            cidade: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(this).val(ui.item.value);
                    return false;
                }
            });
        });
    </script>
@endsection
