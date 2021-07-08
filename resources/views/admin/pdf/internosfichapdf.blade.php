<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>PMRG - PDF</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url('backend/assets/bootstrap/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ url('backend/assets/bootstrap/css/bootstrap-grid.css') }}"/>
</head>
<body>

<div class="row mx-auto">
    <img class="img-header" src="{{url(asset('backend/assets/images/sao_paulo.png'))}}">
    <div class="mx-auto">
        <h3 class="text-center">GOVERNO DO ESTADO DE SÃO PAULO</h3>
        <h5 class="text-center mt-n2">SECRETARIA DE ESTADO DOS NEGÓCIOS DA SEGURANÇA PÚBLICA</h5>
        <p class="text-center mt-n2">Polícia Militar do Estado de São Paulo</p>
        <p class="text-center mt-n3">Presídio Militar Romão Gomes</p>
        <p class="text-center mt-n3 font-weight-bold">FICHA CARCERÁRIA </p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container">
    <div class="row d-flex justify-content-between border border-dark">
        <h6 class="my-auto mx-2">DADOS PESSOAIS</h6>
        <p class="my-auto ml-5">Status:{{$interno->status}}</p>
        <p class="my-auto mr-5">Pasta:</p>
    </div>
    <div class="row d-flex mt-1">
        <div class="d-flex flex-column col-9">
            <div class="row d-flex">
                <p class="my-auto flex-fill">RE:{{$interno->re}}</p>
                <p class="my-auto flex-fill">Nº:{{$interno->n}}</p>
                <p class="my-auto flex-fill">RG:{{$interno->rg}}</p>
                <p class="my-auto flex-fill">Alojamento:{{$interno->alojamento}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Funcional:{{$interno->funcional}}</p>
                <p class="my-auto flex-fill">Proc.
                    Execução:@if($primeiroprocesso != null) {{$primeiroprocesso->processo_de_execucao }} @endif</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Nome:{{$interno->nome_completo}}</p>
                <p class="my-auto flex-fill">Nome/Guerra:{{$interno->nome_guerra}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Cidade:{{$interno->natural}}</p>
                <p class="my-auto flex-fill">Estado:{{$interno->estado}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Data nascimeto:{{$interno->nascimento.' '.$idade->y.'anos'}}</p>
                <p class="my-auto flex-fill">Sexo:{{$interno->sexo}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Batalhão:{{$interno->batalhao}}</p>
                <p class="my-auto flex-fill">Btl cidade:{{$interno->batalhao_cidade}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Patente:{{$interno->patente}}</p>
                <p class="my-auto flex-fill">Situação:{{$interno->situacao}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Adminssão:{{$interno->admissao}}</p>
                <p class="my-auto flex-fill">Demissão:{{$interno->demissao}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Estado civil:{{$interno->estado_civil}}</p>
                <p class="my-auto flex-fill">Cônjuge:{{$interno->conjugue}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Grau instrução:{{$interno->escolaridade}}</p>
                <p class="my-auto flex-fill">Religião:{{$interno->religiao}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Pai:{{$interno->pai}}</p>
                <p class="my-auto flex-fill">Mãe:{{$interno->mae}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Endereço:{{$interno->endereco}}</p>
                <p class="my-auto flex-fill">Cidade:{{$interno->cidade}}</p>
            </div>
            <div class="row d-flex">
                <p class="my-auto flex-fill">Cpf:{{$interno->cpf}}</p>
                <p class="my-auto flex-fill">Titulo:{{$interno->titulo_eleitor}}</p>
                <p class="my-auto flex-fill">Zona:{{$interno->zona}}</p>
                <p class="my-auto flex-fill">Seção:{{$interno->secao}}</p>
            </div>
        </div>
        <div class="d-flex col-3">
            <img class="justify-content-center" style="max-width: 270px" img src="@if($interno->url_foto == null)
            {{ url(asset('backend/assets/images/avatarDefault.png')) }}">
            @else
                {{url(asset($interno->url_foto))}}">
            @endif
        </div>
    </div>
    <div class="row d-flex justify-content-between border border-dark mt-2">
        <h6 class="my-auto mx-2">CARACTERÍSTICAS FÍSICAS</h6>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Etnia:{{$interno->etnia}}</p>
        <p class="my-auto flex-fill">Cabelos:{{$interno->cabelos}}</p>
        <p class="my-auto flex-fill">Altura:{{$interno->altura}}</p>
        <p class="my-auto flex-fill">Peso:{{$interno->peso}}</p>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Defeitos Físicos:{{$interno->defeitos_fisicos}}</p>
        <p class="my-auto flex-fill">Sinais de nascença:{{$interno->sinais_nascenca}}</p>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Cicatrizes:{{$interno->cicatrizes}}</p>
        <p class="my-auto flex-fill">Tatuagens:{{$interno->tatuagens}}</p>
    </div>
    <div class="row d-flex justify-content-between border border-dark mt-2">
        <h6 class="my-auto mx-2">INCLUSÃO/REMOÇÃO</h6>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Data Inclusão:{{$interno->created_at}}</p>
        <p class="my-auto flex-fill">Tipo Prisão:{{$interno->tipo_prisao}}</p>
        <p class="my-auto flex-fill">Artigo:@if($primeiroprocesso != null) {{$primeiroprocesso->artigo}} @endif</p>
        <p class="my-auto flex-fill">CPM/CPB:@if($primeiroprocesso != null) {{$primeiroprocesso->cpb_cpm}} @endif</p>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Procedência:{{$interno->procedencia}}</p>
        <p class="my-auto flex-fill">Data Lib./Remoção:{{$interno->data_liberdade_remocao}}</p>
        <p class="my-auto flex-fill">Local:{{$interno->local}}</p>
    </div>
    <div class="row d-flex justify-content-between border border-dark mt-2">
        <h6 class="my-auto mx-2">DOCUMENTOS</h6>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill"><input type="checkbox"> Registro Nascimento</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Cédula Identidade</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Carteira Trabalho</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Título Eleitor</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Registro Casamento</p>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill"><input type="checkbox"> Registro Batismo</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Certificado Militar</p>
        <p class="my-auto flex-fill"><input type="checkbox"> CNH</p>
        <p class="my-auto flex-fill"><input type="checkbox"> Outros:</p>
    </div>
    <div class="row d-flex justify-content-between border border-dark mt-2">
        <h6 class="my-auto mx-2">ACIDENTE/DOENÇA GRAVE/MORTE</h6>
    </div>
    <div class="row d-flex">
        <p class="my-auto flex-fill">Solicita que seja
            avisado:@if($primeiroprocesso != null) {{$primeiroprocesso->acidente_doenca_morte}} @endif</p>
    </div>
    <div class="row d-flex justify-content-between border border-dark mt-2">
        <h6 class="my-auto mx-2">SITUAÇÃO PROCESSUAL</h6>
    </div>
    <p class="my-auto flex-fill">Situação Proc:{{$interno->status}}</p>
    @if(!empty($interno->processos))
        <table style="width:100%;margin-left: 0px; font-size: 1.0em;">
            <tr style="text-decoration: underline;">
                <td style="width: 25%;">Processo</td>
                <td style="width: 25%;">Vara</td>
                <td style="width: 25%;">Situação</td>
                <td style="width: 25%;">Tempo de Condenação</td>
            </tr>
            @foreach($interno->processos as $processo)
                <tr>
                    <td>{{$processo->n_inquerito}}</td>
                    <td>{{$processo->vara_comarca}}</td>
                    <td>{{$processo->sit_processual}}</td>
                    <td>{{'0'.$processo->pena_ano.' anos,'.'0'.$processo->pena_meses.' meses,'.'0'.$processo->pena_dias.' dias'}}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <div class="row d-flex justify-content-around" style="margin-top: 200px ">
        <h6 class="my-auto mx-2">Assinatura do Servidor Responsável</h6>
        <h6 class="my-auto mx-2">Assinatura do Interno</h6>
    </div>
</div>

<script src="{{ url('backend/assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        window.print()
    });

</script>
</body>
</html>
