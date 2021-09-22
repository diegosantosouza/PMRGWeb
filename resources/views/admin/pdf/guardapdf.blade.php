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

<div class="row mx-auto container">
    <img class="img-header" src="{{url(asset('backend/assets/images/sao_paulo.png'))}}">
    <div class="mx-auto">
        <h3 class="text-center">GOVERNO DO ESTADO DE SÃO PAULO</h3>
        <h5 class="text-center mt-n2">SECRETARIA DE ESTADO DOS NEGÓCIOS DA SEGURANÇA PÚBLICA</h5>
        <p class="text-center mt-n2">Polícia Militar do Estado de São Paulo</p>
        <p class="text-center mt-n3">Presídio Militar Romão Gomes</p>
        <p class="text-center mt-n3 font-weight-bold">Conferência {{date('d/m/Y')}}</p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container">
    @if(!empty($internos1))
        <h5 class="font-weight-bold">1º Estágio</h5>
        @foreach($alojamentos->where('estagio', 1) as $alojamento)
            <p class="text-center font-weight-bold">{{$alojamento->cela}}</p>
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Visita</th>
                    <th>Conferido</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($internos1->where('alojamento', $alojamento->cela) as $key => $interno)
                    <tr>
                        <td class="small">{{ $interno->n }}</td>
                        <td class="small">{{ $interno->nome_guerra }}</td>
                        <td class="small"></td>
                        <td class="small"></td>
                        <td class="small"></td>
                        <td class="small"></td>
                        <td class="small"></td>
                        <td class="small"></td>
                        <td class="small"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table class="table table-sm table-bordered">
                <thead>
                <th>Qtd.</th>
                <th>{{$internos1->where('alojamento', $alojamento->cela)->count()}}</th>
                <th>Capacidade</th>
                <th>{{$alojamento->capacidade}}</th>
                </thead>
            </table>
        @endforeach
        <div style="page-break-after: always"></div>
    @endif

    @if(!empty($internos2))

        <h5 class="font-weight-bold">2º Estágio</h5>
        @foreach($alojamentos->where('estagio', 2) as $alojamento)
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
                @foreach ($internos2->where('alojamento', $alojamento->cela) as $key => $interno)
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
                <th>{{$internos2->where('alojamento', $alojamento->cela)->count()}}</th>
                <th>Capacidade</th>
                <th>{{$alojamento->capacidade}}</th>
                </thead>
            </table>
        @endforeach
        <div style="page-break-after: always"></div>

    @endif

    @if(!empty($internos3))
        <h5 class="font-weight-bold">3º Estágio</h5>
        @foreach($alojamentos->where('estagio', 3) as $alojamento)
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
                @foreach ($internos3->where('alojamento', $alojamento->cela) as $key => $interno)
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
                <th>{{$internos3->where('alojamento', $alojamento->cela)->count()}}</th>
                <th>Capacidade</th>
                <th>{{$alojamento->capacidade}}</th>
                </thead>
            </table>
        @endforeach
        <div style="page-break-after: always"></div>
    @endif

    @if(!empty($internos4))
        <h5 class="font-weight-bold">4º Estágio</h5>
        @foreach($alojamentos->where('estagio', 4) as $alojamento)
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
                @foreach ($internos4->where('alojamento', $alojamento->cela) as $key => $interno)
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
                <th>{{$internos4->where('alojamento', $alojamento->cela)->count()}}</th>
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
