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
                        <li><a href="{{ route('internos.index') }}" class="text-orange">Processos</a></li>
                    </ul>
                </nav>

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
                        <th>Número</th>
                        <th>Estágio</th>
                        <th>Parentesco</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($visitas as $visita)
                            <tr>
                                <td>{{$visita->nome}}</td>
                                <td>{{$visita->documento}}</td>
                                <td>{{$visita->interno->nome_guerra}}</td>
                                <td>{{$visita->interno->n}}</td>
                                <td>{{$visita->interno->estagio}}</td>
                                <td>{{$visita->parentesco}}</td>
                                <td>{{$visita->status}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('visita.show', ['visitum'=>$visita->id]) }}"></a>
                                    <a class="btn btn-green icon-pencil" href="{{ route('visita.edit', ['visitum'=>$visita->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

