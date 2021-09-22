@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-file-o">Editar Processo</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('processos.index') }}">Processos</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Editar</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="">
            <h3 class="text-center text-bold">{{$processo->interno->nome_guerra}} | Nº{{$processo->interno->n}} |
                Estágio : {{$processo->interno->estagio}} </h3>
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
                        <a href="#data" class="nav_tabs_item_link active">Processo</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('processos.update', ['processo'=>$processo->id]) }}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $processo->id }}">
                    <input type="hidden" name="id_interno" value="{{ old('id_interno') ?? $processo->id_interno}}">

                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Crime em durante o serviço:</span>
                                    <select name="em_servico" class="select2">
                                        <option
                                            value="sim" {{ (old('em_servico') == 'sim' ? 'selected' : ($processo->em_servico == 'sim' ? 'selected' : '')) }}>
                                            Sim
                                        </option>
                                        <option
                                            value="não" {{ (old('em_servico') == 'não' ? 'selected' : ($processo->em_servico == 'não' ? 'selected' : '')) }}>
                                            Não
                                        </option>
                                    </select>
                                </label>
                                <label class="label">
                                    <span class="legend">Processo Referência:</span>
                                    <input type="text" name="processo_referencia" placeholder="Processo de Referencia"
                                           class="processo-execucao"
                                           value="{{ old('processo_referencia') ?? $processo->processo_referencia }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Processo:</span>
                                    <input type="text" name="processo_de_execucao" class="processo-execucao"
                                           placeholder="Processo"
                                           value="{{ old('processo_de_execucao') ?? $processo->processo_de_execucao}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Regime:</span>
                                    <select name="regime" class="select2">
                                        <option
                                            value="Aberto" {{ (old('regime') == 'Aberto' ? 'selected' : ($processo->regime == 'Aberto' ? 'selected' : '' )) }}>
                                            Aberto
                                        </option>
                                        <option
                                            value="Fechado" {{ (old('regime') == 'Fechado' ? 'selected' : ($processo->regime == 'Fechado' ? 'selected' : '' )) }}>
                                            Fechado
                                        </option>
                                        <option
                                            value="Integralmente Fechado" {{ (old('regime') == 'Integralmente Fechado' ? 'selected' : ($processo->regime == 'Integralmente Fechado' ? 'selected' : '' )) }}>
                                            Integralmente Fechado
                                        </option>
                                        <option
                                            value="Multa" {{ (old('regime') == 'Multa' ? 'selected' : ($processo->regime == 'Multa' ? 'selected' : '' )) }}>
                                            Multa
                                        </option>
                                        <option
                                            value="Semiaberto" {{ (old('regime') == 'Semiaberto' ? 'selected' : ($processo->regime == 'Semiaberto' ? 'selected' : '' )) }}>
                                            Semiaberto
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Numero do Inquérito:</span>
                                    <input type="text" name="n_inquerito" placeholder="Numero do Inquérito"
                                           value="{{ old('n_inquerito') ?? $processo->n_inquerito}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Multa:</span>
                                    <input type="text" name="multa" placeholder="Multa"
                                           value="{{ old('multa') ?? $processo->multa}}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Situação Processual:</span>
                                    <select name="sit_processual" class="select2">
                                        <option
                                            value="Condenado" {{ (old('sit_processual') == 'Condenado' ? 'selected' : ($processo->sit_processual == 'Condenado' ? 'selected' : '' )) }}>
                                            Condenado
                                        </option>
                                        <option
                                            value="Flagrante" {{ (old('sit_processual') == 'Flagrante' ? 'selected' : ($processo->sit_processual == 'Flagrante' ? 'selected' : '' )) }}>
                                            Flagrante
                                        </option>
                                        <option
                                            value="Medida de Internacao" {{ (old('sit_processual') == 'Medida de Internacao' ? 'selected' : ($processo->sit_processual == 'Medida de Internacao' ? 'selected' : '' )) }}>
                                            Medida de Internacao
                                        </option>
                                        <option
                                            value="Medida de Segurança" {{ (old('sit_processual') == 'Medida de Segurança' ? 'selected' : ($processo->sit_processual == 'Medida de Segurança' ? 'selected' : '' )) }}>
                                            Medida de Segurança
                                        </option>
                                        <option
                                            value="Preventiva" {{ (old('sit_processual') == 'Preventiva' ? 'selected' : ($processo->sit_processual == 'Preventiva' ? 'selected' : '' )) }}>
                                            Preventiva
                                        </option>
                                        <option
                                            value="Temporaria" {{ (old('sit_processual') == 'Temporaria' ? 'selected' : ($processo->sit_processual == 'Temporaria' ? 'selected' : '' )) }}>
                                            Temporaria
                                        </option>
                                        <option
                                            value="Alvara" {{ (old('sit_processual') == 'Alvara' ? 'selected' : '') }}>
                                            Alvara
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">*Reincidencia:</span>
                                    <select name="reincidencia" class="select2">
                                        <option
                                            value="Primario" {{ (old('reincidencia') == 'Primario' ? 'selected' : ($processo->reincidencia == 'Primario' ? 'selected' : '' )) }}>
                                            Primario
                                        </option>
                                        <option
                                            value="Reincidente" {{ (old('reincidencia') == 'Reincidente' ? 'selected' : ($processo->reincidencia == 'Reincidente' ? 'selected' : '' )) }}>
                                            Reincidente
                                        </option>
                                        <option
                                            value="N/C" {{ (old('reincidencia') == 'N/C' ? 'selected' : ($processo->reincidencia == 'N/C' ? 'selected' : '' )) }}>
                                            N/C
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g4">
                                <label class="label">
                                    <span class="legend">Pena (Anos):</span>
                                    <input type="text" name="pena_ano" placeholder="Apenas Números"
                                           value="{{ old('pena_ano') ?? $processo->pena_ano}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Pena (Meses):</span>
                                    <input type="text" name="pena_meses" placeholder="Apenas Números"
                                           value="{{ old('pena_meses') ?? $processo->pena_meses}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Pena (Dias):</span>
                                    <input type="text" name="pena_dias" placeholder="Apenas Números"
                                           value="{{ old('pena_dias') ?? $processo->pena_dias}}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Origem Processo:</span>
                                    <select name="origem_processo" class="select2">
                                        <option
                                            value="Justica Militar" {{ (old('origem_processo') == 'Justica Militar' ? 'selected' : ($processo->origem_processo == 'Justica Militar' ? 'selected' : '' )) }}>
                                            Justica Militar
                                        </option>
                                        <option
                                            value="Justica Comum" {{ (old('origem_processo') == 'Justica Comum' ? 'selected' : ($processo->origem_processo == 'Justica Comum' ? 'selected' : '' )) }}>
                                            Justica Comum
                                        </option>
                                        <option
                                            value="Justica Federal" {{ (old('origem_processo') == 'Justica federal' ? 'selected' : ($processo->origem_processo == 'Justica federal' ? 'selected' : '' )) }}>
                                            Justica Federal
                                        </option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Medida de Tratamento:</span>
                                    <input type="text" name="medida_tratamento" placeholder="Medida"
                                           value="{{ old('medida_tratamento') ?? $processo->medida_tratamento}}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Comutação:</span>
                                    <input type="text" name="comutacao" placeholder="Comutação"
                                           value="{{ old('comutacao') ?? $processo->comutacao}}"/>
                                </label>
                            </div>


                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Vara Comarca:</span>
                                    <input type="text" name="vara_comarca" placeholder="Vara Comarca"
                                           value="{{ old('vara_comarca') ?? $processo->vara_comarca }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Extinção de Punibilidade:</span>
                                    <input type="text" name="exticao_punibilidade" placeholder="Extinção"
                                           value="{{ old('exticao_punibilidade') ?? $processo->exticao_punibilidade}}"/>
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

                <form class="app_form mt-2" action=""
                      method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="row">
                                <input id="legislacao_id" type="hidden" />
                                <label class="label col-2 mx-auto">
                                    <span class="legend">*Legislação:</span>
                                    <select name="legislacao" id="legislacao" class="select2">
                                        <option
                                            value="Cód. Penal Militar">Cód. Penal Militar
                                        </option>
                                        <option
                                            value="Cód. Penal">Cód. Penal
                                        </option>
                                        <option
                                            value="Leis Especiais">Leis Especiais
                                        </option>
                                    </select>
                                </label>

                                <label class="label col-2 mx-auto">
                                    <span class="legend">Leis Especiais:</span>
                                    <input type="text" name="leis-especiais" id="leis-especiais" class="leis-especiais"
                                           value="{{ old('leis_especiais') }}"/>
                                </label>

                                <label class="label col-2 mx-auto">
                                    <span class="legend">Artigo:</span>
                                    <input type="text" name="artigo" id="legislacao_artigo" class="artigo"
                                           value="{{ old('artigo') }}"/>
                                </label>

                                <label class="label col-2 mx-auto">
                                    <span class="legend">Descrição:</span>
                                    <input type="text" name="descricao" id="descricao" class=""
                                           value="{{ old('descricao') }}"/>
                                </label>

                                <div class="col-2 mx-auto align-items-center mt-2">
                                    <a class="btn btn-green icon-plus" id="save">Salvar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table bg-white" id="artigos">
                    <thead>
                    <th>Legislação</th>
                    <th>Leis Especiais</th>
                    <th>Artigo</th>
                    <th>Ações</th>
                    </thead>
                    <tbody class="text-center" id="artigosRows">

                    </tbody>
                </table>
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
                    <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                    <p class="text-center">Tem certeza que deseja excluir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('processos.destroy', ['processo'=>$processo->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            //**Adicionar Artigos */
            const ROTA = "{{route('legislacao.show',['legislacao'=> $processo->id])}}"
            const DELETEROTA = "{{route('legislacao.index')}}"
            const _token = $('input[name="_token"]').val();

            const createButton = (label, type) => {
                return $('<button>').addClass(`btn btn-${type}`).html(label)
            }

            const renderRows = resArtigos => {
                const rows = resArtigos.map( resArtigo => {
                    const removeButton = createButton('Excluir', 'red')
                    removeButton.click(()=> removeArtigo(resArtigo))
                    return $('<tr>')
                        .append($('<td>').append(resArtigo.legislacao))
                        .append($('<td>').append(resArtigo.leis_especiais))
                        .append($('<td>').append(resArtigo.artigo))
                        .append($('<td>').append(resArtigo.descricao))
                        .append($('<td>').append(removeButton))
                })
                $('#artigosRows').html(rows)
            }

            const removeArtigo = resArtigo => {
                $.ajax({
                    method: 'DELETE',
                    url: `${DELETEROTA}`+'/'+resArtigo.id,
                    data: {
                        _token: _token,
                        legislacao: resArtigo.id,
                },
                    success: getArtigos
                })
            }

            const getArtigos = () => {
                $.ajax({
                    url: `${ROTA}`,
                    method: 'GET',
                    success: resArtigos => {
                        renderRows(resArtigos)
                    }
                })
            }

            const saveLegislacao = () => {
                const id_processo = $('[name=id]').val()
                const legislacao = $('[name=legislacao]').val()
                const leis_especiais = $('[name=leis-especiais]').val()
                const artigo = $('[name=artigo]').val()
                const descricao = $('[name=descricao]').val()
                $.ajax({
                    method: 'POST',
                    url: "{{route('legislacao.store')}}",
                    data: {
                        _token: _token,
                        id_processo: id_processo,
                        legislacao: legislacao,
                        leis_especiais: leis_especiais,
                        artigo: artigo,
                        descricao: descricao
                    },
                    success: getArtigos
                })
            }
            $(() => {
                getArtigos()
                $('[id=save]').click(saveLegislacao)
            })

            //**Marcara Processo Execução */
            $('.processo-execucao').mask('9999999-99.9999.9.99.9999');

            //**Mascara Artigo*/
            $('.artigo').mask('999');

            //**Mascara Leis especiais*/
            $('.leis-especiais').mask('99.999', {reverse: true});

            //**Campo Leis Especiais Desabilitado*/
            function campoLeisEspeciais() {
                if ($('#legislacao').val() === 'Leis Especiais') {
                    $('#leis-especiais').prop("disabled", false)
                } else {
                    $('#leis-especiais').val('')
                    $('#leis-especiais').prop("disabled", true);
                }
            }

            campoLeisEspeciais();
            $('#legislacao').change(function () {
                campoLeisEspeciais();
            });
        })
    </script>
@endsection
