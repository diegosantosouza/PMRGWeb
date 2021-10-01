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
                    <div class="label_g4">
                        <label class="label">
                            <span class="legend">Nome do visitante:</span>
                            <input type="text" id="nome" name="nome" placeholder="Busca por nome"
                                   value=""/>
                        </label>
                        <label class="label">
                            <span class="legend">Documento do visitante:</span>
                            <input type="text" id="documento" name="documento" placeholder="Busca por documento"
                                   value=""/>
                        </label>
                        <label class="label">
                            <span class="legend">Interno número:</span>
                            <input type="text" id="n" name="n" placeholder="Busca por numero"
                                   value=""/>
                        </label>
                        <label class="label">
                            <span class="legend">Interno nome:</span>
                            <input type="text" id="nome_guerra" name="nome_guerra" placeholder="Busca por nome de interno"
                                   value=""/>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <div class="table-responsive">
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
            function clearinternoNumero() {
                $('#n').val('')
            }
            function clearinternoNome() {
                $('#nome_guerra').val('')
            }

            $('#nome').keyup(function () {
                if (this.value.length > 1){
                    clearDocumento()
                    clearinternoNumero()
                    clearinternoNome()
                    let params = $(this).val();
                    getVisita('nome', params);
                }
            });
            $('#documento').keyup(function () {
                if (this.value.length > 1) {
                    clearNome()
                    clearinternoNumero()
                    clearinternoNome()
                    let params = $(this).val();
                    getVisita('documento', params);
                }
            });
            $('#n').keyup(function () {
                if (this.value.length != null) {
                    clearNome()
                    clearDocumento()
                    clearinternoNome()
                    let params = $(this).val();
                    getVisitaInterno('n', params);
                }
            });
            $('#nome_guerra').keyup(function () {
                if (this.value.length != null) {
                    clearNome()
                    clearDocumento()
                    clearinternoNumero()
                    let params = $(this).val();
                    getVisitaInterno('nome_guerra', params);
                }
            });

            /**Ação de Busca*/

            const getVisita = (tipo, params) => {
                setTimeout(() => {
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
                }, 200)
            }

            /**Renderiza as linhas pela pequisa de visita[nome , documento]*/
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

            const getVisitaInterno = (tipo, params) => {
                setTimeout(() => {
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
                                renderRowsInterno(JSON.parse(resVisitas))
                            }
                    })
                }, 200)
            }

            /**Renderiza as linhas pela pequisa de interno[nome , documento]*/
            const renderRowsInterno = resVisitas => {
                if (resVisitas != null) {
                    const rows = resVisitas.visitas.map(Visita => {
                        const entradaButton = createButton('Entrada', 'green')
                        entradaButton.click(() => entradaInterno(Visita, resVisitas))
                        return $('<tr>')
                            .append($('<td>').append(Visita.nome))
                            .append($('<td>').append(Visita.documento))
                            .append($('<td>').append(resVisitas.n + "-" + resVisitas.nome_guerra))
                            .append($('<td>').append(resVisitas.estagio))
                            .append($('<td>').append(Visita.parentesco))
                            .append($('<td>').append(Visita.status))
                            .append($('<td class="text-right">').append(entradaButton))
                    })
                    $('#visitasRows').html(rows)
                }
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

            /**Efetua entrada pelos campos numero e nome do interno*/
            function entradaInterno(Visita , resVisitas) {
                $.ajax({
                    method: 'POST',
                    url: "{{route('entradavisitantes.entrada')}}",
                    data: {
                        _token: _token,
                        visita: Visita.id,
                        interno: resVisitas.id
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

            /**Cria botao*/
            const createButton = (label, type) => {
                return $('<button>').addClass(`btn btn-${type}`).html(label)
            }
        })
    </script>
@endsection


