@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-gg">Editar Trabalho</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('processos.index') }}">Jurídica</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Trabalho</a></li>
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

                @if(session()->exists('message'))
                    <div class="message message-{{session()->get('color')}}">
                        <p class="icon-asterisk">{{ session()->get('message') }}</p>
                    </div>
                @endif


                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Trabalho</a>
                    </li>
                </ul>

                <form class="app_form" action="" method="post" enctype="multipart/form-data">
                    <fieldset disabled>
                        <div class="nav_tabs_content">
                            <div id="data">

                                <div class="label_g4">
                                    <label class="label">
                                        <span class="legend">Empregador:</span>
                                        <input type="text" name="empregador" placeholder="Nome do empregador"
                                               value="{{ old('instituicao_ensino') ?? $empregador->empregador}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Horário seg. a sex.:</span>
                                        <input type="text" name="horario_semana" placeholder="Ex: 08:30/17:00"
                                               value="{{ old('horario_semana') ?? $empregador->horario_semana}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Horário fim de semana:</span>
                                        <input type="text" name="horario_fim_semana" placeholder="Ex: 08:30/13:00"
                                               value="{{ old('horario_fim_semana') ?? $empregador->horario_fim_semana}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="text-right mt-2">
                        <a class="btn btn-large btn-green icon-pencil"
                           href="{{ route('empregador.editarTrabalho', ['trabalho'=>$empregador->id]) }}">Editar</a>
                    </div>
                </form>

                <div class="ml-2">
                    <h2>Adicionar Interno</h2>
                    <form class="app_form"
                          action="{{ route('empregador.internoAdic', ['empregador'=>$empregador->id]) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <input type="text" class="col-2" id="internoBusca" name="empregador"
                                   placeholder="Insira o número do Interno">
                            <button type="submit" class="btn btn-green icon-plus">Adicionar</button>
                        </div>
                    </form>
                </div>

                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
                        <table id="dataTable" class="nowrap stripe" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Alojamento</th>
                                <th>Processso exec.</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($empregador->internos as $interno)
                                @if($interno->estagio==1)
                                    <tr class="gradient-red">
                                @elseif($interno->estagio==2)
                                    <tr class="gradient-yellow">
                                @elseif($interno->estagio==3)
                                    <tr class="gradient-green">
                                @elseif($interno->estagio==4)
                                    <tr class="gradient-blue">
                                @else($interno->estagio== '')
                                    <tr>
                                        @endif
                                        <td>{{$interno->n}}</td>
                                        <td>{{$interno->nome_guerra}}</td>
                                        <td>{{$interno->status}}</td>
                                        <td>{{$interno->alojamento}}</td>
                                        <td></td>
                                        <td class="text-right">
                                            <a class="btn btn-red icon-trash" id="myModal" data-toggle="modal"
                                               data-target="#deleteTrabalhoModal{{$interno->id}}"></a>
                                        </td>
                                    </tr>

                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal empregador -->
    @foreach($empregador->internos as $interno)
        <div class="modal fade" id="deleteTrabalhoModal{{$interno->id}}" tabindex="-1"
             aria-labelledby="deleteTrabalhoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="deleteTrabalhoModalLabel">Deletar</h2>
                        <button type="button" class="btn btn-red icon-times icon-notext search_close"
                                data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                        <p class="text-center">Tem certeza que deseja excluir {{$interno->n}}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('empregador.internoTrabalho', ['interno'=>$interno->id]) }}"
                              method="post" class="">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-red icon-trash">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(this).val(ui.item.value);
                    return false;
                }
            });
        });
    </script>
@endsection

