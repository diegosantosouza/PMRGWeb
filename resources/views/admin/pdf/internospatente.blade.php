<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Guarda - PDF</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url('backend/assets/bootstrap/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ url('backend/assets/bootstrap/css/bootstrap-grid.css') }}"/>
    <style>

        td {
            font-size: 0.8em;
        }

    </style>
</head>
<body>

<div class="row mx-auto">
    <img class="img-header" src="{{url(asset('backend/assets/images/sao_paulo.png'))}}">
    <div class="mx-auto">
        <h3 class="text-center">GOVERNO DO ESTADO DE SÃO PAULO</h3>
        <h5 class="text-center mt-n2">SECRETARIA DE ESTADO DOS NEGÓCIOS DA SEGURANÇA PÚBLICA</h5>
        <p class="text-center mt-n2">Polícia Militar do Estado de São Paulo</p>
        <p class="text-center mt-n3">Presídio Militar Romão Gomes</p>
        <p class="text-center mt-n3 font-weight-bold">Internos por Patente {{date('d/m/Y')}}</p>
    </div>
    <img class="img-header" src="{{url(asset('backend/assets/images/PMRGlogo.png'))}}">
</div>
<div class="container">
    <table class="table table-sm table-bordered">
        <thead>
        <th>Patente</th>
        <th>Cond</th>
        <th>Flag</th>
        <th>Med</th>
        <th>Prev</th>
        <th>Temp</th>
        <th>Total</th>
        <th>Fechado</th>
        <th>Semi-aberto</th>
        <th>Total</th>
        </thead>

        <tbody>
        <tr>
            <td>Sd PM</td>
            <td>{{$internos->where('patente','Sd PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Sd PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Sd PM</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Sd PM')->count()}}</td>
        </tr>
        <tr>
            <td>Sd PM Ref</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Sd PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>Cb PM</td>
            <td>{{$internos->where('patente','Cb PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Cb PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Cb PM</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Cb PM')->count()}}</td>
        </tr>
        <tr>
            <td>Cb PM Ref</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Cb PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>3º Sgt pm</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex 3º Sgt PM</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 3º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>3º Sgt PM Ref</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','3º Sgt PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>2º Sgt PM</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex 2º Sgt PM</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>2º Sgt PM Ref</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','2º Sgt PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>1º Sgt PM</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex 1º Sgt PM</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Sgt PM')->count()}}</td>
        </tr>
        <tr>
            <td>1º Sgt PM Ref</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','1º Sgt PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>Subten PM</td>
            <td>{{$internos->where('patente','Subten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Subten PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Subten PM</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Subten PM')->count()}}</td>
        </tr>
        <tr>
            <td>Subten PM Ref</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Subten PM Ref')->count()}}</td>
        </tr>
        <tr>
            <td>Aluno Oficial</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Aluno Oficial')->count()}}</td>
        </tr>
        <tr>
            <td>Aspirante</td>
            <td>{{$internos->where('patente','Aspirante')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Aspirante')->count()}}</td>
        </tr>
        <tr>
            <td>2º Ten PM</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex 2º Ten PM</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 2º Ten PM')->count()}}</td>
        </tr>
        <tr>
            <td>2º Ten PM Res</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','2º Ten PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>1º Ten PM</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex 1º Ten PM</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex 1º Ten PM')->count()}}</td>
        </tr>
        <tr>
            <td>1º Ten PM Res</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','1º Ten PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>Capitao PM</td>
            <td>{{$internos->where('patente','Capitao PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Capitao PM</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Capitao PM')->count()}}</td>
        </tr>
        <tr>
            <td>Capitao PM Res</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Capitao PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>Major PM</td>
            <td>{{$internos->where('patente','Major PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Major PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Major PM</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Major PM')->count()}}</td>
        </tr>
        <tr>
            <td>Major PM Res</td>
            <td>{{$internos->where('patente','Major PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Major PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>Ten Coronel PM</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Ten Coronel PM</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Ten Coronel PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ten Coronel PM Res</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ten Coronel PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>Coronel PM</td>
            <td>{{$internos->where('patente','Coronel PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM')->count()}}</td>
        </tr>
        <tr>
            <td>Ex Coronel PM</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Ex Coronel PM')->count()}}</td>
        </tr>
        <tr>
            <td>Coronel PM Res</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Coronel PM Res')->count()}}</td>
        </tr>
        <tr>
            <td>Civil</td>
            <td>{{$internos->where('patente','Civil')->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('patente','Civil')->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->where('patente','Civil')->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('patente','Civil')->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('patente','Civil')->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->where('patente','Civil')->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('patente','Civil')->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('patente','Civil')->where('estagio', 4)->count()}}</td>
            <td>{{$internos->where('patente','Civil')->count()}}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td>TOTAL</td>
            <td>{{$internos->where('tipo_prisao','Condenado')->count()}}</td>
            <td>{{$internos->where('tipo_prisao','Flagrante')->count()}}</td>
            <td>{{$internos->whereIn('tipo_prisao',['Medida Segurança', 'Medida Internação'])->count()}}</td>
            <td>{{$internos->where('tipo_prisao','Preventiva')->count()}}</td>
            <td>{{$internos->where('tipo_prisao','Temporária')->count()}}</td>
            <td>{{$internos->whereIn('tipo_prisao',['Condenado','Flagrante','Medida Segurança','Preventiva','Temporária'])->count()}}</td>
            <td>{{$internos->where('estagio','!=',4)->count()}}</td>
            <td>{{$internos->where('estagio', 4)->count()}}</td>
            <td>{{$internos->whereIn('estagio',[1,2,3,4])->count()}}</td>
        </tr>
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

