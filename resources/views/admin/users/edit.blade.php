@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user">Editar Usuário</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('users.index') }}">Usuários</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('users.create') }}" class="text-orange">Editar Usuário</a></li>
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

            @if(session()->exists('message'))
                <div class="message message-{{session()->get('color')}}">
                    <p class="icon-asterisk">{{ session()->get('message') }}</p>
                </div>
            @endif


            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                </li>

            </ul>

            <form class="app_form" action="{{ route('users.update', ['user'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="nav_tabs_content">
                    <div id="data">
                    @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                        <div class="label_gc">
                            <span class="legend">Perfil:</span>
                            <label class="label">
                                <input type="checkbox" name="admin" {{ (old('admin') == 'on' || old('admin') == true ? 'checked' : ($user->admin == true ? 'checked' : '' )) }}><span>Administrador</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="ativo" {{ (old('ativo') == 'on' || old('ativo') == true ? 'checked' : ($user->ativo == true ? 'checked' : '' )) }}><span>Ativo</span>
                            </label>
                        </div>


                        <div class="label_gc">
                            <span class="legend">Permitido editar:</span>
                            <label class="label">
                                <input type="checkbox" name="penal" {{ (old('penal') == 'on' || old('penal') == true ? 'checked' : ($user->penal == true ? 'checked' : '' )) }}><span>Penal</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="labor" {{ (old('labor') == 'on' || old('labor') == true ? 'checked' : ($user->labor == true ? 'checked' : '' )) }}><span>Labor</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="juridica" {{ (old('juridica') == 'on' || old('juridica') == true ? 'checked' : ($user->juridica == true ? 'checked' : '' )) }}><span>Juridica</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="pjmd" {{ (old('pjmd') == 'on' || old('pjmd') == true ? 'checked' : ($user->pjmd == true ? 'checked' : '' )) }}><span>Pjmd</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="escolta" {{ (old('escolta') == 'on' || old('escolta') == true ? 'checked' : ($user->escolta == true ? 'checked' : '' )) }}><span>Escolta</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="guarda" {{ (old('guarda') == 'on' || old('guarda') == true ? 'checked' : ($user->guarda == true ? 'checked' : '' )) }}><span>Guarda</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="naps" {{ (old('naps') == 'on' || old('naps') == true ? 'checked' : ($user->naps == true ? 'checked' : '' )) }}><span>Naps</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="uis" {{ (old('uis') == 'on' || old('uis') == true ? 'checked' : ($user->uis == true ? 'checked' : '' )) }}><span>Uis</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="uge" {{ (old('uge') == 'on' || old('uge') == true ? 'checked' : ($user->uge == true ? 'checked' : '' )) }}><span>Uge</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p1" {{ (old('p1') == 'on' || old('p1') == true ? 'checked' : ($user->p1 == true ? 'checked' : '' )) }}><span>P1</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p2" {{ (old('p2') == 'on' || old('p2') == true ? 'checked' : ($user->p2 == true ? 'checked' : '' )) }}><span>P2</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p4" {{ (old('p4') == 'on' || old('p4') == true ? 'checked' : ($user->p4 == true ? 'checked' : '' )) }}><span>P4</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="p5" {{ (old('p5') == 'on' || old('p5') == true ? 'checked' : ($user->p5 == true ? 'checked' : '' )) }}><span>P5</span>
                            </label>
                        </div>
                    @endif
                        <label class="label">
                            <span class="legend">*Nome:</span>
                            <input type="text" name="name" placeholder="Nome" value="{{ old('name') ?? $user->name}}"/>
                        </label>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*RE:</span>
                                <input type="text" name="re" placeholder="RE do usuário"
                                       value="{{ old('re') ?? $user->re}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Seção:</span>
                                <select name="secao" class="select2">
                                    <option value="penal" {{ (old('secao') == 'Penal' ? 'selected' : ($user->secao == 'penal' ? 'selected' : '' )) }}>Penal</option>
                                    <option value="laborterapia" {{ (old('secao') == 'Laborterapia' ? 'selected' :  ($user->secao == 'juridica' ? 'selected' : '' )) }}>Laborterapia</option>
                                    <option value="juridica" {{ (old('secao') == 'Juridica' ? 'selected' : ($user->secao == 'juridica' ? 'selected' : '' )) }}>Juridica</option>
                                    <option value="pjmd" {{ (old('secao') == 'Pjmd' ? 'selected' : ($user->secao == 'pjmd' ? 'selected' : '' )) }}>Pjmd</option>
                                    <option value="escolta" {{ (old('secao') == 'Escolta' ? 'selected' : ($user->secao == 'escolta' ? 'selected' : '' )) }}>Escolta</option>
                                    <option value="guarda" {{ (old('secao') == 'Guarda' ? 'selected' : ($user->secao == 'guarda' ? 'selected' : '' )) }}>Guarda</option>
                                    <option value="naps" {{ (old('secao') == 'Naps' ? 'selected' :  ($user->secao == 'naps' ? 'selected' : '' )) }}>Naps</option>
                                    <option value="uis" {{ (old('secao') == 'Uis' ? 'selected' :  ($user->secao == 'uis' ? 'selected' : '' )) }}>Uis</option>
                                    <option value="p2" {{ (old('secao') == 'P2' ? 'selected' :  ($user->secao == 'p2' ? 'selected' : '' )) }}>P2</option>
                                </select>
                            </label>

                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*E-mail:</span>
                                <input type="email" name="email" placeholder="E-mail funcional"
                                       value="{{ old('email') ?? $user->email}}"/>
                            </label>

                            <label class="label">
                                <span class="legend">Foto</span>
                                <input type="file" name="foto">
                            </label>

                        </div>

                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações</button>
                    <button type="button" id="myModal" class="btn btn-large btn-red icon-trash" data-toggle="modal" data-target="#deleteModal">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="deleteModalLabel">Deletar</h2>
                <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                <p class="text-center">Tem certeza que deseja excluir?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                <form action="{{route('users.destroy', ['user'=>$user->id])}}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
