<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Visitantes - PDF</title>
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
        <p class="text-center mt-n3 font-weight-bold">Visitantes data {{$data}} <b>Total: {{$visitantes->count()}}</b>
        </p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container mt-n2">
    <table class="table table-sm table-bordered">
        <thead>
        <th>Nome</th>
        <th>Documento</th>
        <th>Parentesco</th>
        <th>Nº</th>
        <th>Estágio</th>
        <th>Entrada</th>
        <th>Saída</th>
        </thead>
        <tbody>
        @foreach ($visitantes as $key => $visitante)
            <tr>
                <td>{{$visitante->visitas->nome }}</td>
                <td>{{$visitante->visitas->tipo_doc.' '.$visitante->visitas->documento}}</td>
                <td>{{$visitante->visitas->parentesco}}</td>
                <td>{{$visitante->interno->n}}</td>
                <td>{{$visitante->interno->estagio}}</td>
                <td>@if (!empty($visitante->created_at)) {{date('H:i:s', strtotime($visitante->created_at))}} @endif</td>
                <td>@if (!empty($visitante->saida)) {{date('H:i:s', strtotime($visitante->saida))}} @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>

<script src="{{ url('backend/assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        window.print()
    });

</script>
</html>
