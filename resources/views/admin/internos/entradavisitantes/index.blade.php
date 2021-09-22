@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-arrow-up">Entrada</h2>
            <h2 class="">Contagem de entrada: {{$contagem}}</h2>

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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($visitas as $visita)
                        @if(!empty($visita->interno->n))
                            <tr>
                                <td>{{$visita->nome}}</td>
                                <td>{{$visita->documento}}</td>
                                <td>{{$visita->interno->n.'-'.$visita->interno->nome_guerra}}</td>
                                <td>{{$visita->interno->estagio}}</td>
                                <td>{{$visita->parentesco}}</td>
                                <td>{{$visita->status}}</td>
                                <td class="text-right">
                                    <form class="app_form" action="{{route('entradavisitantes.entrada', ['visita'=>$visita->id, 'interno'=>$visita->interno->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <a class="btn btn-blue icon-eye" href="{{ route('visita.show', ['visitum'=>$visita->id]) }}"></a>
                                        <button class="btn btn-green icon-arrow-up" type="submit">entrada</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

