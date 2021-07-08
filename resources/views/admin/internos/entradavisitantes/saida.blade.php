@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-arrow-down">Saída</h2>
            <h2 class="">Contagem de saida: {{$contagem}}</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('entradavisitantes.listasaida') }}" class="text-orange">Saída</a></li>
                    </ul>
                </nav>
                <a class="btn btn-green icon-arrow-up" href="{{route('entradavisitantes.index')}}">Entrada</a>
            </div>
        </header>

        @include('admin.users.filter')

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
                        <th>Interno</th>
                        <th>Estágio</th>
                        <th>Parentesco</th>
                        <th>Status</th>
                        <th>Entrada</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($entradas as $entrada)
                            <tr>
                                <td>{{$entrada->visitas->nome}}</td>
                                <td>{{$entrada->visitas->documento}}</td>
                                <td>{{$entrada->visitas->interno->n.'-'.$entrada->visitas->interno->nome_guerra}}</td>
                                <td>{{$entrada->visitas->interno->estagio}}</td>
                                <td>{{$entrada->visitas->parentesco}}</td>
                                <td>{{$entrada->visitas->status}}</td>
                                <td>{{date('d-m-Y H:i:s', strtotime($entrada->chegada))}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('visita.show', ['visitum'=>$entrada->visitas->id]) }}"></a>
                                    <a class="btn btn-orange icon-arrow-down" href="{{ route('entradavisitantes.saida', ['visita'=>$entrada->id]) }}">saída</a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

