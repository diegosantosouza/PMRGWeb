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
                        <li><a href="{{ route('penal.index') }}">Penal</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('alojamentos.index') }}" class="text-orange">Advogados</a></li>
                    </ul>
                </nav>

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
                        <th>Nome</th>
                        <th>OAB</th>
                        <th>Interno</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($advogados as $advogado)
                            <tr>
                                <td>{{$advogado->nome_advogado}}</td>
                                <td>{{$advogado->oab}}</td>
                                <td>{{$advogado->id_interno}}</td>
                                <td class="text-right">
                                    <a class="btn btn-green icon-pencil" href="{{ route('advogados.edit', ['advogado'=>$advogado->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

