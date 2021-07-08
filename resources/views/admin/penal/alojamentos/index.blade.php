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
                        <li><a href="{{ route('alojamentos.index') }}" class="text-orange">Alojamentos</a></li>
                    </ul>
                </nav>
                <a href="{{ route('alojamentos.create') }}" class="btn btn-orange icon-flag ml-1">Criar novo</a>
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
                        <th>Estágio</th>
                        <th>Cela</th>
                        <th>Ocupação</th>
                        <th>Vagas/Capacidade</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($alojamentos as $alojamento)
                            <tr>
                                <td>{{$alojamento->estagio}}</td>
                                <td>{{$alojamento->cela}}</td>
                                <td>
                                    <div class="progress">

                                        @if($vagas->where('alojamento',$alojamento->cela)->count() >= $alojamento->capacidade)
                                            <div class="progress-bar bg-danger"
                                        @else
                                            <div class="progress-bar bg-success"
                                        @endif
                                         role="progressbar" aria-valuenow="" aria-valuemin="0"
                                             aria-valuemax="100" style="width: {{($vagas->where('alojamento',$alojamento->cela)->count() * 100) / $alojamento->capacidade }}%">
                                            </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{$vagas->where('alojamento',$alojamento->cela)->count().'/'.$alojamento->capacidade}}</span>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-blue icon-eye" href="{{ route('alojamentos.show', ['alojamento'=>$alojamento->cela]) }}"></a>
                                    <a class="btn btn-green icon-pencil" href="{{ route('alojamentos.edit', ['alojamento'=>$alojamento->id]) }}" ></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>


@endsection

