@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user">Editar Visitante</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin.inicio') }}">Início</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('visita.index') }}">Visitas</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Editar visitante</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="">
        <h3 class="text-center text-bold"><a class="btn btn-blue icon-eye" href="{{ route('internos.show', ['interno'=>$visita->interno->id]) }}"></a> {{$visita->interno->nome_guerra}} | Nº{{$visita->interno->n}} | Estágio : {{$visita->interno->estagio}}</h3>
    </div>

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
                        <a href="#dados_cadastrais" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#documentos" class="nav_tabs_item_link">Documentos <span class="badge badge-warning right">{{$documentos->count()}}</span></a>
                    </li>
                </ul>

            <form class="app_form" action="{{ route('visita.update', ['visitum'=>$visita->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="nav_tabs_content">
                    <div id="dados_cadastrais">

                        <input type="hidden" name="id_interno" value="{{$visita->interno->id}}">

                        <div class="label_gc">
                            <span class="legend">Possui:</span>
                            <label class="label">
                                <input type="checkbox" name="antecedentes" {{ (old('antecedentes') == 'on' || old('antecedentes') == true ? 'checked' : ($visita->antecedentes == true ? 'checked' : '')) }}><span>Antecedentes_Criminal</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="autorizacao_judicial" {{ (old('autorizacao_judicial') == 'on' || old('autorizacao_judicial') == true ? 'checked' : ($visita->autorizacao_judicial == true ? 'checked' : '')) }}><span>Autorização_Judicial</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="autorizacao_menor" {{ (old('autorizacao_menor') == 'on' || old('autorizacao_menor') == true ? 'checked' : ($visita->autorizacao_menor == true ? 'checked' : '')) }}><span>Autorização_Menor</span>
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="nome" class="firstuppercase" placeholder="Nome Completo" value="{{  old('nome') ?? $visita->nome }}"/>
                            </label>

                            <div class="card mx-auto">
                                <img class="dash_sidebar_user_thumb" alt="foto" src="{{url(asset($visita->url_foto))}}">
                                <div class="card-body">
                                    <label class="label">
                                        <span class="legend">Foto</span>
                                        <input type="file" name="foto" value="{{ old('foto') ?? $visita->foto }}">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Genero:</span>
                                <select name="sexo" class="select2">
                                    <option value="Masculino" {{ (old('sexo') == 'Masculino' ? 'selected' : ($visita->sexo == 'Masculino' ? 'selected' : '')) }}>Masculino</option>
                                    <option value="Feminino" {{ (old('sexo') == 'Feminino' ? 'selected' : ($visita->sexo == 'Feminino' ? 'selected' : '')) }}>Feminino</option>
                                    <option value="Outros" {{ (old('sexo') == 'Outros' ? 'selected' : ($visita->sexo == 'Outros' ? 'selected' : '')) }}>Outros</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">*Parentesco:</span>
                                <select name="parentesco" class="select2">
                                    <option value="Afilhado(a)" {{ (old('parentesco') == 'Afilhado(a)' ? 'selected' : ($visita->parentesco == 'Afilhado(a)' ? 'selected' : '')) }}>Afilhado(a)</option>
                                    <option value="Amasia(o)" {{ (old('parentesco') == 'Amasia(o)' ? 'selected' : ($visita->parentesco == 'Amasia(o)' ? 'selected' : '')) }}>Amasia(o)</option>
                                    <option value="Amigo(a)" {{ (old('parentesco') == 'Amigo(a)' ? 'selected' : ($visita->parentesco == 'Amigo(a)' ? 'selected' : '')) }}>Amigo(a)</option>
                                    <option value="Avô(a)" {{ (old('parentesco') == 'Avô(a)' ? 'selected' : ($visita->parentesco == 'Avô(a)' ? 'selected' : '')) }}>Avô(a)</option>
                                    <option value="Bisavô(ó)" {{ (old('parentesco') == 'Bisavô(ó)' ? 'selected' : ($visita->parentesco == 'Bisavô(ó)' ? 'selected' : '')) }}>Bisavô(ó)</option>
                                    <option value="Bisneto(a)" {{ (old('parentesco') == 'Bisneto(a)' ? 'selected' : ($visita->parentesco == 'Bisneto(a)' ? 'selected' : '')) }}>Bisneto(a)</option>
                                    <option value="Comadre" {{ (old('parentesco') == 'Comadre' ? 'selected' : ($visita->parentesco == 'Comadre' ? 'selected' : '')) }}>Comadre</option>
                                    <option value="Compadre" {{ (old('parentesco') == 'Compadre' ? 'selected' : ($visita->parentesco == 'Compadre' ? 'selected' : '')) }}>Compadre</option>
                                    <option value="Cunhado(a)" {{ (old('parentesco') == 'Cunhado(a)' ? 'selected' : ($visita->parentesco == 'Cunhado(a)' ? 'selected' : '')) }}>Cunhado(a)</option>
                                    <option value="Enteado(a)" {{ (old('parentesco') == 'Enteado(a)' ? 'selected' : ($visita->parentesco == 'Enteado(a)' ? 'selected' : '')) }}>Enteado(a)</option>
                                    <option value="Esposo(a)" {{ (old('parentesco') == 'Esposo(a)' ? 'selected' : ($visita->parentesco == 'Esposo(a)' ? 'selected' : '')) }}>Esposo(a)</option>
                                    <option value="Ex-Esposo(a)" {{ (old('parentesco') == 'Ex-Esposo(a)' ? 'selected' : ($visita->parentesco == 'Ex-Esposo(a)' ? 'selected' : '')) }}>Ex-Esposo(a)</option>
                                    <option value="Filho(a)" {{ (old('parentesco') == 'Filho(a)' ? 'selected' : ($visita->parentesco == 'Filho(a)' ? 'selected' : '')) }}>Filho(a)</option>
                                    <option value="Genro" {{ (old('parentesco') == 'Genro' ? 'selected' : ($visita->parentesco == 'Genro' ? 'selected' : '')) }}>Genro</option>
                                    <option value="Irmão(ã)" {{ (old('parentesco') == 'Irmão(ã)' ? 'selected' : ($visita->parentesco == 'Irmão(ã)' ? 'selected' : '')) }}>Irmão(ã)</option>
                                    <option value="Madastra" {{ (old('parentesco') == 'Madastra' ? 'selected' : ($visita->parentesco == 'Madastra' ? 'selected' : '')) }}>Madastra</option>
                                    <option value="Madrinha" {{ (old('parentesco') == 'Madrinha' ? 'selected' : ($visita->parentesco == 'Madrinha' ? 'selected' : '')) }}>Madrinha</option>
                                    <option value="Mãe" {{ (old('parentesco') == 'Mãe' ? 'selected' : ($visita->parentesco == 'Mãe' ? 'selected' : '')) }}>Mãe</option>
                                    <option value="Namorado(a)" {{ (old('parentesco') == 'Namorado(a)' ? 'selected' : ($visita->parentesco == 'Namorado(a)' ? 'selected' : '')) }}>Namorado(a)</option>
                                    <option value="Neto(a)" {{ (old('parentesco') == 'Neto(a)' ? 'selected' : ($visita->parentesco == 'Neto(a)' ? 'selected' : '')) }}>Neto(a)</option>
                                    <option value="Nora" {{ (old('parentesco') == 'Nora' ? 'selected' : ($visita->parentesco == 'Nora' ? 'selected' : '')) }}>Nora</option>
                                    <option value="Padastro" {{ (old('parentesco') == 'Padastro' ? 'selected' : ($visita->parentesco == 'Padastro' ? 'selected' : '')) }}>Padastro</option>
                                    <option value="Padrinho" {{ (old('parentesco') == 'Padrinho' ? 'selected' : ($visita->parentesco == 'Padrinho' ? 'selected' : '')) }}>Padrinho</option>
                                    <option value="Pai" {{ (old('parentesco') == 'Pai' ? 'selected' : ($visita->parentesco == 'Pai' ? 'selected' : '')) }}>Pai</option>
                                    <option value="Primo(a)" {{ (old('parentesco') == 'Primo(a)' ? 'selected' : ($visita->parentesco == 'Primo(a)' ? 'selected' : '')) }}>Primo(a)</option>
                                    <option value="Sobrinho(a)" {{ (old('parentesco') == 'Sobrinho(a)' ? 'selected' : ($visita->parentesco == 'Sobrinho(a)' ? 'selected' : '')) }}>Sobrinho(a)</option>
                                    <option value="Sogro(a)" {{ (old('parentesco') == 'Sogro(a)' ? 'selected' : ($visita->parentesco == 'Sogro(a)' ? 'selected' : '')) }}>Sogro(a)</option>
                                    <option value="Tio(a)" {{ (old('parentesco') == 'Tio(a)' ? 'selected' : ($visita->parentesco == 'Tio(a)' ? 'selected' : '')) }}>Tio(a)</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Tipo de Documento:</span>
                                <select name="tipo_doc" class="select2">
                                    <option value="RG" {{ (old('tipo_doc') == 'RG' ? 'selected' : ($visita->tipo_doc == 'RG' ? 'selected' : '')) }}>RG</option>
                                    <option value="CPF" {{ (old('tipo_doc') == 'CPF' ? 'selected' : ($visita->tipo_doc == 'CPF' ? 'selected' : '')) }}>CPF</option>
                                    <option value="Cert Nasc" {{ (old('tipo_doc') == 'Cert Nasc' ? 'selected' : ($visita->tipo_doc == 'Cert Nasc' ? 'selected' : '')) }}>Cert Nasc</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">*Documento:</span>
                                <input type="text" name="documento" placeholder="Numero do documento" value="{{ old('documento') ?? $visita->documento }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Status:</span>
                                <select name="status" class="select2">
                                    <option value="Ativo" {{ (old('status') == 'Ativo' ? 'selected' : ($visita->status == 'Ativo' ? 'selected' : '')) }}>Ativo</option>
                                    <option value="Inativo" {{ (old('status') == 'Inativo' ? 'selected' : ($visita->status == 'Inativo' ? 'selected' : '')) }}>Inativo</option>
                                    <option value="Suspenso" {{ (old('status') == 'Suspenso' ? 'selected' : ($visita->status == 'Suspenso' ? 'selected' : '')) }}>Suspenso</option>
                                </select>
                            </label>
                        </div>

                        <div class="label_g4">
                            <label class="label">
                                <span class="legend">*Data de Nascimento:</span>
                                <input type="tel" name="dt_nascimento" class="mask-date"
                                       placeholder="Data de Nascimento" value="{{ old('dt_nascimento') ?? $visita->dt_nascimento }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Nacionalidade:</span>
                                <input type="text" name="nacionalidade" placeholder="Nacionalidade" value="{{ old('nacionalidade') ?? $visita->nacionalidade }}"/>
                            </label>

                            <label class="label">
                                <span class="legend">*Naturalidade:</span>
                                <input name="naturalidade" class="cidadeBusca"
                                       value="{{ old('naturalidade') ?? $visita->naturalidade }}"
                                       placeholder="Buscar cidade">
                            </label>

                            <label class="label">
                                <span class="legend">*Estado:</span>
                                <select name="uf" class="select2">
                                    @foreach($estados as $estado)
                                        <option value="{{$estado->Nome}}" {{ (old('uf') == $estado->Nome ? 'selected' : ($visita->uf == $estado->Nome ? 'selected' : '')) }}>{{$estado->Nome}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Filiação</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Mãe:</span>
                                        <input type="text" name="mae" class="firstuppercase" placeholder="Nome Completo" value="{{ old('mae') ?? $visita->mae }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Pai:</span>
                                        <input type="text" name="pai" class="firstuppercase" placeholder="Nome Completo" value="{{ old('pai') ?? $visita->pai }}"/>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Endereço</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Endereço:</span>
                                        <input type="text" name="endereco"
                                               placeholder="Rua, nº, complemento" value="{{ old('endereco') ?? $visita->endereco }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*Cidade:</span>
                                        <input name="cidade" class="cidadeBusca"
                                               value="{{ old('cidade') ?? $visita->cidade }}"
                                               placeholder="Buscar cidade">
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Telefone de Contato:</span>
                                        <input type="tel" name="celular" class="mask-cell"
                                               placeholder="Número do Telefonce com DDD" value="{{ old('celular') ?? $visita->celular }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">*CEP:</span>
                                        <input type="tel" name="cep" placeholder="CEP" value="{{ old('cep') ?? $visita->cep }}"/>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Veículo</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Placa:</span>
                                        <input type="text" name="placa" placeholder="Placa do veiculo"value="{{ old('placa') ?? $visita->placa }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Modelo:</span>
                                        <input type="text" name="modelo" placeholder="Ex corolla, civic, gol " value="{{ old('modelo') ?? $visita->modelo}}"/>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="app_collapse mt-2">
                            <div class="app_collapse_header collapse">
                                <h3>Observações</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <div class="label_g5">
                                    <label class="label">
                                        <span class="legend">Escreva:</span>
                                        <textarea name="observacoes" rows="5">{{old('observacoes') ?? $visita->observacoes}}</textarea>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="documentos" class="d-none">
                        @foreach($documentos as $documento)
                            <div class="mt-1">
                                <a target="_blank" href="{{asset('storage/'.$documento->path)}}" class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</a>
                                <div class="text-right">
                                    <button type="button" id="myModal" class="btn btn-small btn-red icon-trash" data-toggle="modal" data-target="#deleteArquivo{{$documento->id}}">Deletar</button>
                                </div>
                                <hr>
                            </div>
                        @endforeach

                        <div class="label_g2 mt-1">
                            <label class="label">
                                <span class="legend">Arquivos:</span>
                                <input type="file" name="arquivos[]" multiple />
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
                <form action="{{route('visita.destroy', ['visitum'=>$visita->id])}}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach($documentos as $documento)
    <!-- Modal Arquivos -->
    <div class="modal fade" id="deleteArquivo{{$documento->id}}" tabindex="-1" aria-labelledby="deleteArquivoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="deleteArquivoLabel">Deletar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">{{ \Illuminate\Support\Facades\Auth::user()['name'] }}</h4>
                    <p class="text-center">Tem certeza que deseja excluir <strong class="text-orange">{{\Illuminate\Support\Str::afterLast($documento->path, '/')}}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('visita.arquivoDelete', ['visita'=>$documento->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash" >Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('js')
    <script src="{{ url(asset('backend/assets/js/jquery-ui.min.js')) }}"></script>
    <script>
        $(document).ready(function () {
            var _token = $('input[name="_token"]').val();

            $('.cidadeBusca').autocomplete({
                minLength: 2,
                delay: 500,
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{route('interno.cidadeBusca')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: _token,
                            cidade: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $(this).val(ui.item.value);
                    return false;
                }
            });
            //**Primeira letra maiuscula*/
            $(".firstuppercase").keypress(function (e) {
                var str = $(this).val();
                str = str.replace(/(^|\s|$)(?!de|do|d$)(.)/g, (geral, match1, match2) => match1 + match2.toUpperCase());
                $(this).val(str);
            });
        });
    </script>
@endsection

