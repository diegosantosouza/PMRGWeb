@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-flag">Editar Alojamento</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('processos.index') }}">Alojamentos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Editar</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="">
        <h3 class="text-center text-bold">Estágio:{{$alojamento->estagio}} | Cela:{{$alojamento->cela}} | Capacidade : {{$alojamento->capacidade}} </h3>
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
                    <a href="#data" class="nav_tabs_item_link active">Alojamento</a>
                </li>
            </ul>

            <form class="app_form" action="{{ route('alojamentos.update', ['alojamento'=>$alojamento->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $alojamento->id }}">

                <div class="nav_tabs_content">
                    <div id="data">

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">Estágio:</span>
                                <select name="estagio" class="select2">
                                    <option value="1" {{ (old('estagio') == '1' ? 'selected' : ($alojamento->estagio == '1' ? 'selected' : '' )) }}>1</option>
                                    <option value="2" {{ (old('estagio') == '2' ? 'selected' : ($alojamento->estagio == '2' ? 'selected' : '' )) }}>2</option>
                                    <option value="3" {{ (old('estagio') == '3' ? 'selected' : ($alojamento->estagio == '3' ? 'selected' : '' )) }}>3</option>
                                    <option value="4" {{ (old('estagio') == '4' ? 'selected' : ($alojamento->estagio == '4' ? 'selected' : '' )) }}>4</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">Cela:</span>
                                <input type="text" name="cela" placeholder="Nome da cela" value="{{ old('cela') ?? $alojamento->cela}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Capacidade:</span>
                                <input type="text" name="capacidade" placeholder="capacidade de internos" value="{{ old('capacidade') ?? $alojamento->capacidade}}"/>
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
                <form action="{{route('alojamentos.destroy', ['alojamento'=>$alojamento->id])}}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

