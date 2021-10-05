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
                        <li><a href="{{ route('internos.index') }}" class="text-orange">Visitas</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <div class="">
            <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$interno->id]) }}"></a> {{$interno->nome_guerra}} | Nº{{$interno->n}} | Estágio : {{$interno->estagio}}</h3>
        </div>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">

                @if(session()->exists('message'))

                        <div class="message message-{{session()->get('color')}}">
                            <p class="icon-asterisk">{{ session()->get('message') }}</p>
                        </div>

                @endif
                <table id="dataTable" class="nowrap stripe"  style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Parentesco</th>
                        <th>Entrada</th>
                        <th>Saida</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($interno->visitas as $visita)
                        @foreach($interno->registrosVistas as $regs)
                            @if($regs->visita_id == $visita->id)
                                    <tr>
                                        <td>{{$visita->nome}}</td>
                                        <td>{{$visita->documento}}</td>
                                        <td>{{$visita->parentesco}}</td>
                                        <td>{{date('d-m-Y H:i:s', strtotime($regs->chegada))}}</td>
                                        <td>@if($regs->saida != null){{date('d-m-Y H:i:s', strtotime($regs->saida))}}@endif</td>
                                        <td class="text-right">
                                            <a class="btn btn-blue icon-eye" href="{{ route('visita.show', ['visitum'=>$visita->id]) }}"></a>
                                            <a class="btn btn-green icon-pencil" href="{{ route('visita.edit', ['visitum'=>$visita->id]) }}" ></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

