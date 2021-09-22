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
                        <th>Processo</th>
                        <th>Nº Inquérito</th>
                        <th>Interno</th>
                        <th>Situação Proc.</th>
                        <th>Regime</th>
                        <th>Proc. Referência</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($processos as $processo)
                            <tr>
                                <td>{{$processo->processo_de_execucao}}</td>
                                <td>{{$processo->n_inquerito}}</td>
                                <td>{{$processo->interno->n}}</td>
                                <td>{{$processo->sit_processual}}</td>
                                <td>{{$processo->regime}}</td>
                                <td>{{$processo->processo_referencia}}</td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('processos.show', ['processo'=>$processo->id]) }}"></a>
                                    <a class="btn btn-green icon-pencil" href="{{ route('processos.edit', ['processo'=>$processo->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

