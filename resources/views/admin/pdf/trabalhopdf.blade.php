<!DOCTYPE html>
<html>
<head>
    <title>User list - PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: "Open Sans", sans-serif;
            font-size: 0.7em;
        }

    </style>
</head>
<body>
        @foreach($internos as $interno)
            <div style="width: 50%; display: table;">
                <div style="display: table-row">
                    <div style="display: flex;flex-wrap: wrap;
                        width: 100%;
                    height: 120px;
                    margin-left: 5px;
                    border: 5px solid;
                    border-color: #000000 #000000 #000000 #000000; display: table-cell;">
                        <h1 style="margin-left: 15px;">{{$interno->n}}</h1>
                        <p style="margin-top:-50px;margin-left: 70px; font-size: 1.1em;">{{$interno->nome_completo}}</p>
                        <p style="margin-top: -5px;margin-left: 70px;font-size: 1.2em;font-weight: bold;">Estágio: {{$interno->estagio}}</p>
                        <p style="margin-top: -40px;margin-left: 180px;font-size: 1.2em;font-weight: bold;">{{$interno->re}}</p>
                        <p style="margin-top: -10px;margin-left: 70px;font-size: 1.1em;text-align: center;">{{$interno->trabalho->empregador}} seg-sex:{{$interno->trabalho->horario_semana}}, sáb-dom:{{$interno->trabalho->horario_fim_semana}}</p>
                        <p style="margin-top: 0px;margin-left: 60px;margin-right: 5px;font-size: 1.2em;text-align: right;font-weight: bold;">{{date('m/Y')}}</p>
                    </div>

                </div>
            </div>
        @endforeach

</body>
</html>
