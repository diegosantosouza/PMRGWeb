@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-file-o">Processo</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Processos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Visualizar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold">{{$processo->interno->nome_guerra}} | Nº{{$processo->interno->n}} | Estágio : {{$processo->interno->estagio}} </h3>
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

            <form class="app_form" action="" method="post" enctype="multipart/form-data">

                <div class="nav_tabs_content">
                    <div id="data">
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

            </form>
        </div>
    </div>
</section>
@endsection

