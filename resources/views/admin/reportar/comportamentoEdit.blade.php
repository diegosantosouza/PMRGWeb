@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-bookmark">Editar Comportamento</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('visita.index') }}">Pjmd</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Editar Comportamento</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$comportamento->id]) }}"></a> {{$comportamento->nome_guerra}} | Nº{{$comportamento->n}} | Estágio : {{$comportamento->estagio}}</h3>
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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Comportamento</a>
                    </li>
                </ul>

            <form class="app_form" action="{{ route('pjmd.comportamentoUpdate', ['pjmd'=>$comportamento->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <div class="label_g2 mt-1">
                            <label class="label">
                                <span class="legend">*Comportamento:</span>
                                <select name="comportamento_status" class="select2">
                                    <option value="Mau" {{ (old('comportamento_status') == 'Mau' ? 'selected' : ($comportamento->comportamento_status == 'Mau' ? 'selected' : '')) }}>Mau</option>
                                    <option value="Regular" {{ (old('comportamento_status') == 'Regular' ? 'selected' : ($comportamento->comportamento_status == 'Regular' ? 'selected' : '')) }}>Regular</option>
                                    <option value="Bom" {{ (old('comportamento_status') == 'Bom' ? 'selected' : ($comportamento->comportamento_status == 'Bom' ? 'selected' : '')) }}>Bom</option>
                                    <option value="Otimo" {{ (old('comportamento_status') == 'Otimo' ? 'selected' : ($comportamento->comportamento_status == 'Otimo' ? 'selected' : '')) }}>Otimo</option>
                                </select>
                            </label>
                            <label class="label">
                                <span class="legend">*Data:</span>
                                <input class="mask-date" type="tel" name="comportamento_data" value="{{ old('comportamento_data') ?? $comportamento->comportamento_data}}"/>
                            </label>
                        </div>
                    </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>
                </div>

                </div>
            </form>
        </div>
    </div>
</section>


@endsection

