<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Guarda - PDF</title>
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
        <p class="text-center mt-n3 font-weight-bold">Internos {{date('d/m/Y')}}</p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container">
    <table class="table table-sm table-bordered">
        <thead>
        <th>Nº</th>
        <th>RE</th>
        <th>Nome</th>
        <th>Estágio</th>
        <th>Alojamento</th>
        <th>Inclusão</th>
        </thead>
        <tbody>
        @foreach ($internos as $key => $interno)
        <tr>
            <td class="small">{{ $interno->n }}</td>
            <td class="small">{{ $interno->re }}</td>
            <td class="small">{{ $interno->nome_completo }}</td>
            <td class="small">{{ $interno->estagio }}</td>
            <td class="small">{{ $interno->alojamento }}</td>
            <td class="small">{{ date('d/m/Y', strtotime($interno->created_at)) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="mt-5">
    <h5>Conferido por:___________________________________</h5>
    <h5>Observações:</h5>
</div>
</body>

<script src="{{ url('backend/assets/js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        window.print()
    });

</script>
</html>
