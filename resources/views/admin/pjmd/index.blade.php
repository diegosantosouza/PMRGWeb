@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Filtro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('pjmd.index') }}" class="text-orange">Pjmd</a></li>
                    </ul>
                </nav>
                <button type="button" id="myModal" class="btn btn-orange icon-bookmark" data-toggle="modal"
                        data-target="#adicionarModal">Criar novo
                </button>
                {{--                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>--}}

            </div>
        </header>

        {{--        @include('admin.users.filter')--}}

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">

                @if(session()->exists('message'))

                    <div class="message message-{{session()->get('color')}}">
                        <p class="icon-asterisk">{{ session()->get('message') }}</p>
                    </div>

                @endif
                <table id="dataTable" class="nowrap stripe" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Interno</th>
                        <th>Status</th>
                        <th>Falta</th>
                        <th>Início</th>
                        <th>Término</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comportamentos as $comportamento)
                        @if(!empty($comportamento->interno->n))
                            <tr>
                                <td>{{$comportamento->numero}}</td>
                                <td>{{$comportamento->interno->n}}-{{$comportamento->interno->nome_guerra}}</td>
                                <td>{{$comportamento->pdi_status}}</td>
                                <td>{{$comportamento->tipo_falta}}</td>
                                <td>{{$comportamento->data_inicio}}</td>
                                <td>{{$comportamento->data_termino}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye"
                                       href="{{ route('pjmd.show', ['pjmd'=>$comportamento->id]) }}"></a>
                                    <a class="btn btn-green icon-pencil"
                                       href="{{ route('pjmd.edit', ['pjmd'=>$comportamento->id]) }}"></a>
                                </td>
                            </tr>
                            @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Adicionar Modal -->
    <div class="modal fade" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="adicionarModalLabel">Adicionar Interno</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <h4 class="text-center">Insira o número do Interno</h4>
                    <form class="app_form" action="{{ route('pjmd.create') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input class="" id="internoBusca" type="text" name="interno" placeholder="Número">
                        <button type="submit" class="btn btn-green icon-plus">Adicionar</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url(asset('backend/assets/js/jquery-ui.min.js')) }}"></script>
    <script>
        $(document).ready(function () {
            var _token = $('input[name="_token"]').val();

            $('#internoBusca').autocomplete({
                minLength: 1,
                delay: 500,
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{route('interno.internoBusca')}}",
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
                appendTo: $('#adicionarModal'),
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(this).val(ui.item.value);
                    return false;
                }
            });

        });
    </script>
@endsection

