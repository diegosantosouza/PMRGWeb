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
                        <li><a href="{{ route('empregador.index') }}">Jurídica</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('estudos.index') }}" class="text-orange">Estudo</a></li>
                    </ul>
                </nav>
                <a href="{{ route('estudos.create') }}" class="btn btn-orange icon-book ml-1">Criar novo</a>
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
                        <th>Instituição de Ensino</th>
                        <th>Internos ativos</th>
                        <th>Horário seg. a sex.</th>
                        <th>Horário final de semana</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($estudos as $estudo)
                            <tr>
                                <td>{{$estudo->instituicao_ensino}}</td>
                                <td>{{$estudo->internos_count}}</td>
                                <td>{{$estudo->horario_semana}}</td>
                                <td>{{$estudo->horario_fim_semana}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('estudos.show', ['estudo'=>$estudo->id]) }}"></a>
                                    <a class="btn btn-green icon-pencil" href="{{ route('estudos.edit', ['estudo'=>$estudo->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

