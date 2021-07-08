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
        <p class="text-center mt-n3 font-weight-bold">Conferência {{$estagio}}º Estágio {{date('d/m/Y')}}</p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container">
    @if(!empty($internos))
        <h5 class="font-weight-bold">{{$estagio}}º Estágio</h5>
            @foreach($alojamentos->where('estagio', $estagio) as $alojamento)
            <p class="text-center font-weight-bold">{{$alojamento->cela}}</p>
                <table class="table table-sm table-bordered">
                    <thead>
                    <th>Nº</th>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Visita</th>
                    <th>Conferido</th>
                    </thead>
                    <tbody>
                    @foreach ($internos->where('alojamento', $alojamento->cela) as $key => $interno)
                        <tr>
                            <td>{{ $interno->n }}</td>
                            <td>{{ $interno->nome_completo }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="table table-sm table-bordered">
                    <thead>
                    <th>Qtd.</th>
                    <th>{{$internos->where('alojamento', $alojamento->cela)->count()}}</th>
                    <th>Capacidade</th>
                    <th>{{$alojamento->capacidade}}</th>
                    </thead>
                </table>
        @endforeach
    @endif

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
