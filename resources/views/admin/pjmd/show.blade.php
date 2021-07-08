@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-bookmark">PDI</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('pjmd.index') }}">Pjmd</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">PDI</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$comportamento->interno->id]) }}"></a> {{$comportamento->interno->nome_guerra}} | Nº{{$comportamento->interno->n}} | Estágio : {{$comportamento->interno->estagio}}</h3>
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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos <span class="badge badge-warning right">{{$documentos->count()}}</span></a>
                    </li>
                </ul>

            <form class="app_form" action="" method="post" enctype="multipart/form-data">

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Número do PDI:</span>
                                <input type="text" name="numero" placeholder="Exemplo 123/20/2020" value="{{ $comportamento->numero }}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*PDI Status:</span>
                                <input type="text" name="pdi_status" value="{{ $comportamento->pdi_status}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Tipo de falta:</span>
                                <input type="text" name="tipo_falta" value="{{ $comportamento->tipo_falta}}"/>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Data de Início:</span>
                                <input type="tel" name="data_inicio" class="mask-date" value="{{ $comportamento->data_inicio }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Data de Término:</span>
                                <input type="tel" name="data_termino" class="mask-date" value="{{ $comportamento->data_termino }}"/>
                            </label>
                        </div>

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Assunto:</span>
                                <textarea name="assunto" rows="5">{{$comportamento->assunto}}</textarea>
                            </label>
                        </div>

                        <hr class="mb-1">

                        <div class="label_g5">
                            <label class="label">
                                <span class="legend">Punição:</span>
                                <textarea name="punicao" rows="5">{{$comportamento->punicao}}</textarea>
                            </label>
                        </div>

                    </div>


                    <div id="documentos" class="d-none">
                        @foreach($documentos as $documento)
                            <div class="mt-1">
                                <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                                <hr>
                            </div>
                        @endforeach
                    </div>

                </div>

            </form>
        </div>
    </div>
</section>
@endsection

