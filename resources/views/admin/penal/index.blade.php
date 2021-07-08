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
                        <li><a href="{{ route('internos.index') }}" class="text-orange">Internos</a></li>
                    </ul>
                </nav>

                <a href="{{ route('internos.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
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
                <table id="dataTable" class="nowrap stripe"  style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>Alojamento</th>
                        <th>Comportamento</th>
                        <th>Entrada</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($internos as $interno)
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
                                <td>{{$interno->comportamento_status}} - {{$interno->comportamento_data}}</td>
                                <td>{{date('d/m/y', strtotime($interno->created_at))}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$interno->id]) }}"></a>
                                    <a class="btn btn-green icon-pencil" href="{{ route('internos.edit', ['interno'=>$interno->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

