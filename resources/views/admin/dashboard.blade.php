@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-cog">Administrador</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-users">Aguardando Acesso</h4>
                        <h1 class="text-center mt-2 mb-2">{{$users->where('ativo', NULL)->count()}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-check-circle">Usuários Ativos</h4>
                        <h1 class="text-center mt-2 mb-2">{{$users->where('ativo', 1)->count()}}</h1>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-home">Administradores</h4>
                        <h1 class="text-center mt-2 mb-2">{{$users->where('admin', 1)->count()}}</h1>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-users">Últimos Usuários Cadastrados</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuário</th>
                            <th>Seção</th>
                            <th>Email</th>
                            <th>Data</th>
                            <th>Ativo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users->where('ativo', '=' , 0) as $user)
                            <tr>
                                <td><a href="" ></a>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><a href="" class="text-orange"></a>{{ $user->secao }}</td>
                                <td class="text-orange"><a href="mailto:{{ $user->email }}" class="text-orange">{{ $user->email }}</a></td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-orange"> <a href="" ></a> {{ "não" }}</td>
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


    </div>
@endsection
