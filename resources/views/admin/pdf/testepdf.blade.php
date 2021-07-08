<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Telemática - PDF</title>
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
        <p class="text-center mt-n3 font-weight-bold">Histórico de atendimentos Seção Telemática entre {{$data_inicio}} e {{$data_termino}} </p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container mt-n2">
    <table class="table table-sm table-bordered">
        <thead>
        <th>ID</th>
        <th>Solicitante</th>
        <th>IP</th>
        <th>Seção</th>
        <th>Suporte</th>
        <th>Classificação</th>
        <th>Data</th>
        <th>Finalizado</th>
        </thead>
        <tbody>
        @foreach ($suportes as $key => $suporte)
            <tr>
                <td>{{ $suporte->id }}</td>
                <td>{{ $suporte->solicitante_nome }}</td>
                <td>{{ $suporte->ip }}</td>
                <td>{{ $suporte->solicitante_secao }}</td>
                <td>{{ $suporte->suporte_nome }}</td>
                <td>{{ $suporte->modalidade->classificacao }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($suporte->created_at))}}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($suporte->created_at))}}</td>
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
