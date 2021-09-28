@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-arrow-up">Entrada</h2>
            <h2 class="">Contagem de entrada: <span id="contagem">{{$contagem}}</span></h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('entradavisitantes.index') }}" class="text-orange">Entrada</a></li>
                    </ul>
                </nav>
                <a class="btn btn-orange icon-arrow-down" href="{{route('entradavisitantes.listasaida')}}">Saída</a>
            </div>
        </header>

        @include('admin.users.filter')

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <form class="app_form">
                    @csrf
                    <div class="label_g2">
                        <label class="label">
                            <span class="legend">Nome:</span>
                            <input type="text" id="nome" name="nome" placeholder="Busca por nome"
                                   value=""/>
                        </label>
                        <label class="label">
                            <span class="legend">Documento:</span>
                            <input type="text" id="documento" name="documento" placeholder="Busca por documento"
                                   value=""/>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="" class="nowrap stripe table-hover"  style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th class="text-left">Nome</th>
                            <th class="text-left">Documento</th>
                            <th class="text-left">Interno</th>
                            <th class="text-left">Estágio</th>
                            <th class="text-left">Parentesco</th>
                            <th class="text-left">Status</th>
                            <th class="text-left"></th>
                        </tr>
                    </thead>
                    <tbody id="visitasRows">

                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            /**Rota de Busca */
            const _token = $('input[name="_token"]').val();

            function clearNome() {
                $('#nome').val('')
            }
            function clearDocumento() {
                $('#documento').val('')
            }

            $('#nome').keypress(function () {
                if (this.value.length > 1){
                    clearDocumento()
                    let params = $(this).val();
                    getVisita('nome', params);
                }
            });
            $('#documento').keypress(function () {
                if (this.value.length > 1) {
                    clearNome()
                    let params = $(this).val();
                    getVisita('documento', params);
                }
            });

            /**Ação de Busca*/

            const getVisita = (tipo, params) => {
                $.ajax({
                    url: "{{ route('visita.visitaSearch') }}",
                    data: {
                        _token: _token,
                        tipo: tipo,
                        params: params,
                    },
                    method: 'POST',
                    success:
                        resVisitas => {
                        renderRows(JSON.parse(resVisitas))
                    }
                })
            }

            /**Efetua entrada*/
            function entrada(Visita) {
                $.ajax({
                    method: 'POST',
                    url: "{{route('entradavisitantes.entrada')}}",
                    data: {
                        _token: _token,
                        visita: Visita.id,
                        interno: Visita.interno.id
                    },
                    success: function(res) {
                        var a = JSON.parse(res);
                        if (a.contagem != undefined){
                            $('#contagem').text(a.contagem)
                        }
                        alert(a.message);
                    }
                })
            }

            /**Renderiza as linhas*/
            const renderRows = resVisitas => {
                const rows = resVisitas.map( Visita => {
                    const entradaButton = createButton('Entrada', 'green')
                    entradaButton.click(()=> entrada(Visita))
                    return $('<tr>')
                        .append($('<td>').append(Visita.nome))
                        .append($('<td>').append(Visita.documento))
                        .append($('<td>').append(Visita.interno.n +"-"+ Visita.interno.nome_guerra))
                        .append($('<td>').append(Visita.interno.estagio))
                        .append($('<td>').append(Visita.parentesco))
                        .append($('<td>').append(Visita.status))
                        .append($('<td class="text-right">').append(entradaButton))
                })
                $('#visitasRows').html(rows)
            }

            /**Cria botao*/
            const createButton = (label, type) => {
                return $('<button>').addClass(`btn btn-${type}`).html(label)
            }
        })
    </script>
@endsection


