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
                        <li><a href="" class="text-orange">Usuários</a></li>
                    </ul>
                </nav>

                <a href="{{ route('users.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
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
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Admin</th>
                        <th>Seção</th>
                        <th>Email</th>
                        <th>Data</th>
                        <th>Ativo</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        @if($user->admin==1)
                            <tr class="gradient-yellow">
                        @else
                            <tr>
                        @endif

                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->admin == true ? 'sim' : 'não'}}</td>
                                <td>{{$user->secao}}</td>
                                <td><a href="mailto:{{$user->email}}" class="text-orange">{{$user->email}}</a></td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->ativo == true ? 'sim' : ''}}</td>
                                <td class="text-right">
                                    <a class="btn btn-green icon-pencil" href="{{ route('users.edit', ['user' => $user->id]) }}"></a>
                                </td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
