@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-book">Editar Estudo</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Jurídica</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Estudo</a></li>
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
                    <a href="#data" class="nav_tabs_item_link active">Estudo</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('estudos.update', ['estudo'=>$estudo->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="nav_tabs_content">
                    <div id="data">

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Instituição de Ensino:</span>
                                <input type="text" name="instituicao_ensino" placeholder="Nome da Instituição" value="{{ old('instituicao_ensino') ?? $estudo->instituicao_ensino}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Horário seg. a sex.:</span>
                                <input type="text" name="horario_semana" placeholder="Ex: 08:30/17:00" value="{{ old('horario_semana') ?? $estudo->horario_semana}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Horário fim de semana:</span>
                                <input type="text" name="horario_fim_semana" placeholder="Ex: 08:30/13:00" value="{{ old('horario_fim_semana') ?? $estudo->horario_fim_semana}}"/>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>
                    <button type="button" id="myModal" class="btn btn-large btn-red icon-trash" data-toggle="modal" data-target="#deleteModal">Deletar</button>
                </div>
            </form>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="deleteModalLabel">Deletar</h2>
                <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                <p class="text-center">Tem certeza que deseja excluir?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                <form action="{{route('estudos.destroy', ['estudo'=>$estudo->id])}}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

