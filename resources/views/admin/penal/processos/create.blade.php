@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-file-o">Novo Processo</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Processos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Criar novo</a></li>
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
                    <a href="#data" class="nav_tabs_item_link active">Processo</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('processos.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="data">

                        <input type="hidden" name="id_interno" value="{{$interno->id}}">

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Crime em durante o serviço:</span>
                                <select name="em_servico" class="select2">
                                    <option value="sim" {{ (old('em_servico') == 'sim' ? 'selected' : '') }}>Sim</option>
                                    <option value="não" {{ (old('em_servico') == 'não' ? 'selected' : '') }}>Não</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Processo de Execução:</span>
                                <input type="text" name="processo_de_execucao" placeholder="Processo de Execução"
                                       value="{{ old('processo_de_execucao') }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Regime:</span>
                                <select name="regime" class="select2">
                                    <option value="Aberto" {{ (old('regime') == 'Aberto' ? 'selected' : '') }}>Aberto</option>
                                    <option value="Fechado" {{ (old('regime') == 'Fechado' ? 'selected' : '') }}>Fechado</option>
                                    <option value="Integralmente Fechado" {{ (old('regime') == 'Integralmente Fechado' ? 'selected' : '') }}>Integralmente Fechado</option>
                                    <option value="Multa" {{ (old('regime') == 'Multa' ? 'selected' : '') }}>Multa</option>
                                    <option value="Semiaberto" {{ (old('regime') == 'Semiaberto' ? 'selected' : '') }}>Semiaberto</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Numero do Inquérito:</span>
                                <input type="text" name="n_inquerito" placeholder="Numero do Inquérito" value="{{ old('n_inquerito')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Multa:</span>
                                <input type="text" name="multa" placeholder="Multa" value="{{ old('multa')}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Situação Processual:</span>
                                <select name="sit_processual" class="select2">
                                    <option value="Condenado" {{ (old('sit_processual') == 'Condenado' ? 'selected' : '') }}>Condenado</option>
                                    <option value="Flagrante" {{ (old('sit_processual') == 'Flagrante' ? 'selected' : '') }}>Flagrante</option>
                                    <option value="Medida de Internacao" {{ (old('sit_processual') == 'Medida de Internacao' ? 'selected' : '') }}>Medida de Internacao</option>
                                    <option value="Medida de Segurança" {{ (old('sit_processual') == 'Medida de Segurança' ? 'selected' : '') }}>Medida de Segurança</option>
                                    <option value="Preventiva" {{ (old('sit_processual') == 'Preventiva' ? 'selected' : '') }}>Preventiva</option>
                                    <option value="Temporaria" {{ (old('sit_processual') == 'Temporaria' ? 'selected' : '') }}>Temporaria</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">*Reincidencia:</span>
                                <select name="reincidencia" class="select2">
                                    <option value="Primario" {{ (old('reincidencia') == 'Primario' ? 'selected' : '') }}>Primario</option>
                                    <option value="Reincidente" {{ (old('reincidencia') == 'Reincidente' ? 'selected' : '') }}>Reincidente</option>
                                    <option value="N/C" {{ (old('reincidencia') == 'N/C' ? 'selected' : '') }}>N/C</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Pena (Anos):</span>
                                <input type="text" name="pena_ano" placeholder="Apenas Números" value="{{ old('pena_ano')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Pena (Meses):</span>
                                <input type="text" name="pena_meses" placeholder="Apenas Números" value="{{ old('pena_meses')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Pena (Dias):</span>
                                <input type="text" name="pena_dias" placeholder="Apenas Números" value="{{ old('pena_dias')}}"/>

                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Origem Processo:</span>
                                <select name="origem_processo" class="select2">
                                    <option value="Justica Militar" {{ (old('origem_processo') == 'Justica Militar' ? 'selected' : '') }}>Justica Militar</option>
                                    <option value="Justica Comum" {{ (old('origem_processo') == 'Justica Comum' ? 'selected' : '') }}>Justica Comum</option>
                                    <option value="Justica Federal" {{ (old('origem_processo') == 'Justica federal' ? 'selected' : '') }}>Justica Federal</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*CPB CPM:</span>
                                <select name="cpb_cpm" class="select2">
                                    <option value="Cód. Penal Militar" {{ (old('cpb_cpm') == 'Cód. Penal Militar' ? 'selected' : '') }}>Cód. Penal Militar</option>
                                    <option value="Cód. Penal" {{ (old('cpb_cpm') == 'Cód. Penal' ? 'selected' : '') }}>Cód. Penal</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">Artigo:</span>
                                <select name="artigo" class="select2">
                                    @foreach($artigos as $artigo)
                                        <option value="{{$artigo->artigo}}" {{ (old('artigo') == $artigo->artigo ? 'selected' : '') }}>{{$artigo->artigo}}</option>
                                    @endforeach
                                </select>
                            </label>

                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Medida de Tratamento:</span>
                                <input type="text" name="medida_tratamento" placeholder="Medida" value="{{ old('medida_tratamento')}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Comutação:</span>
                                <input type="text" name="comutacao" placeholder="Comutação" value="{{ old('comutacao')}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Vara Comarca:</span>
                                <input type="text" name="vara_comarca" placeholder="Vara Comarca"
                                       value="{{ old('vara_comarca') }}"/>
                            </label>
                            <label class="label">
                                <span class="legend">Extinção de Punibilidade:</span>
                                <input type="text" name="exticao_punibilidade" placeholder="Extinção" value="{{ old('exticao_punibilidade')}}"/>
                            </label>
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

