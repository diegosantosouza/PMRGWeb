@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user-plus">Novo Usuário</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('users.index') }}">Usuários</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('users.create') }}" class="text-orange">Novo Usuário</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dash_content_app_box">
        <div class="nav">

            @if($errors->all())
                @foreach($errors->all() as $error)
                    <div class="message message-orange">
                        <p class="icon-asterisk">{{ $error }}</p>
                    </div>
                @endforeach
            @endif

            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                </li>

            </ul>

            <form class="app_form" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="nav_tabs_content">
                    <div id="data">
                        <div class="label_gc">
                            <span class="legend">Perfil:</span>
                            <label class="label">
                                <input type="checkbox" name="admin" {{ (old('lessor') == 'on' || old('lessor') == true ? 'checked' : '') }}><span>Administrador</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="ativo" {{ (old('lessee') == 'on' || old('lessee') == true ? 'checked' : '') }}><span>Usuário</span>
                            </label>
                        </div>

                        <div class="label_gc">
                            <span class="legend">Permitido editar:</span>
                            <label class="label">
                                <input type="checkbox" name="penal" {{ (old('penal') == 'on' || old('penal') == true ? 'checked' : '') }}><span>Penal</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="labor" {{ (old('labor') == 'on' || old('labor') == true ? 'checked' : '') }}><span>Labor</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="juridica" {{ (old('juridica') == 'on' || old('juridica') == true ? 'checked' : '' ) }}><span>Juridica</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="pjmd" {{ (old('pjmd') == 'on' || old('pjmd') == true ? 'checked' : '' ) }}><span>Pjmd</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="escolta" {{ (old('escolta') == 'on' || old('escolta') == true ? 'checked': '' ) }}><span>Escolta</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="guarda" {{ (old('guarda') == 'on' || old('guarda') == true ? 'checked': '' ) }}><span>Guarda</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="naps" {{ (old('naps') == 'on' || old('naps') == true ? 'checked' : '' ) }}><span>Naps</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="uis" {{ (old('uis') == 'on' || old('uis') == true ? 'checked' : '' ) }}><span>Uis</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="uge" {{ (old('uge') == 'on' || old('uge') == true ? 'checked' : '' ) }}><span>Uge</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p1" {{ (old('p1') == 'on' || old('p1') == true ? 'checked' : '' ) }}><span>P1</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p2" {{ (old('p2') == 'on' || old('p2') == true ? 'checked' : '' ) }}><span>P2</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p4" {{ (old('p4') == 'on' || old('p4') == true ? 'checked' : '' ) }}><span>P4</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p5" {{ (old('p5') == 'on' || old('p5') == true ? 'checked' : '' ) }}><span>P5</span>
                            </label>
                        </div>

                        <label class="label">
                            <span class="legend">*Nome:</span>
                            <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}"/>
                        </label>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*RE:</span>
                                <input type="text" name="re" placeholder="RE do usuário"
                                       value="{{ old('re') }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Seção:</span>
                                <select name="secao" class="select2">
                                    <option value="penal" {{ (old('secao') == 'Penal' ? 'selected' : '') }}>Penal</option>
                                    <option value="laborterapia" {{ (old('secao') == 'Laborterapia' ? 'selected' : '') }}>Laborterapia</option>
                                    <option value="juridica" {{ (old('secao') == 'Juridica' ? 'selected' : '') }}>Juridica</option>
                                    <option value="pjmd" {{ (old('secao') == 'Pjmd' ? 'selected' : '') }}>Pjmd</option>
                                    <option value="escolta" {{ (old('secao') == 'Escolta' ? 'selected' : '') }}>Escolta</option>
                                    <option value="guarda" {{ (old('secao') == 'Guarda' ? 'selected' : '') }}>Guarda</option>
                                    <option value="naps" {{ (old('secao') == 'Naps' ? 'selected' : '') }}>Naps</option>
                                    <option value="uis" {{ (old('secao') == 'Uis' ? 'selected' : '') }}>Uis</option>
                                    <option value="p2" {{ (old('secao') == 'P2' ? 'selected' : '') }}>P2</option>
                                </select>
                            </label>

                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*E-mail:</span>
                                <input type="email" name="email" placeholder="E-mail funcional"
                                       value="{{ old('email') }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Senha:</span>
                                <input type="password" name="password" placeholder="Senha de acesso"
                                       value=""/>
                            </label>

                        </div>

                        <div class="label_g2">

                            <label class="label">
                                <span class="legend">Foto</span>
                                <input type="file" name="foto">
                            </label>

                        </div>

                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection
