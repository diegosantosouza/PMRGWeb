@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="">População carcerária</h4>
                        <h1 class="text-center mt-4 mb-4">{{$internos->count()}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4 class="">Estágios</h4>
                        <!-- DONUT CHART -->
                        <div class="card card-danger">

                            <div class="card-body">
                                <canvas id="estagiosChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </article>

                    <article class="users radius">
                        <h4 class="">Gênero</h4>
                        <h1 class="text-center mt-4 mb-2">
                            Masculino: {{$internos->where('sexo', 'Masculino')->count()}}</h1>
                        <h1 class="text-center mt-2 mb-2">
                            Feminino: {{$internos->where('sexo', 'Feminino')->count()}}</h1>
                    </article>
                </section>
            </div>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="blog radius">
                        <h4 class="">Status cacerário</h4>
                        <!-- DONUT CHART -->
                        <div class="card card-danger">

                            <div class="card-body">
                                <canvas id="statusChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </article>

                    <article class="users radius">
                        <h4 class="">Remição</h4>
                        <h1 class="text-center mt-4 mb-2">
                            Trabalho: {{$internos->where('empregador', true)->count()}}</h1>
                        <h1 class="text-center mt-2 mb-2">Estudo: {{$internos->where('estudo', true)->count()}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4 class="">PDI's em instrução</h4>
                        <h1 class="text-center mt-4 mb-2">{{$comportamentos->count()}}</h1>
                        <h3 class="text-center mt-1 mb-1">
                            <pre>Grave:{{$comportamentos->where('tipo_falta', 'Grave')->count()}}   Média:{{$comportamentos->where('tipo_falta', 'Média')->count()}}   Leve:{{$comportamentos->where('tipo_falta', 'Leve')->count()}}</pre>
                        </h3>
                    </article>
                </section>
            </div>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="blog radius">
                        <h4 class="">Ocupação</h4>
                        <!-- BAR CHART -->
                        <div class="card card-danger">

                            <div class="card-body">
                                <canvas id="barChart"
                                        style="min-height: 250px; height: 500px; max-height: 100%; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </article>

                    <article class="users radius">
                        <h4 class="">Últimos cadastros</h4>
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ultimosInternos as $interno)
                                <tr>
                                    <td>{{$interno->n}}</td>
                                    <td>{{$interno->nome_guerra}}</td>
                                    <td>{{$interno->created_at}}</td>
                                    <td><a class="icon-cog btn btn-orange"
                                           href="{{ route('internos.show', ['interno' => $interno->id]) }}">Gerenciar</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </article>

                    <article class="blog radius">
                        <h4 class="">Alvarás</h4>
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Data</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alvaras as $interno)
                                <tr>
                                    <td>{{$interno->nome_guerra}}</td>
                                    <td>{{date('d-m-Y', strtotime($interno->deleted_at))}}</td>
                                    <td><a class="icon-cog btn btn-orange"
                                           href="{{ route('interno.excluidosShow', ['interno' => $interno->id]) }}">Gerenciar</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </article>
                </section>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ url('backend/assets/js/chart/Chart.min.js')}}"></script>
    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */


            //-------------
            //- DONUT CHART Estagios Chart-
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#estagiosChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    '1',
                    '2',
                    '3',
                    '4',
                ],
                datasets: [
                    {
                        data: [{{$internos->where('estagio', 1)->count()}}, {{$internos->where('estagio', 2)->count()}}, {{$internos->where('estagio', 3)->count()}}, {{$internos->where('estagio', 4)->count()}}],
                        backgroundColor: ['#f56954', '#f39c12', '#00a65a', '#00c0ef'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- DONUT CHART Status Chart-
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#statusChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'condenado',
                    'Pris. prevent.',
                    'Pris. temp.',
                    'Flagrante',
                ],
                datasets: [
                    {
                        data: [{{$internos->where('status', 'Condenado')->count()}}, {{$internos->where('status', 'Prisao Preventiva')->count()}}, {{$internos->where('status', 'Prisão Temporária')->count()}}, {{$internos->where('status', 'Flagrante')->count()}}],
                        backgroundColor: ['#f56954', '#f39c12', '#00a65a', '#00c0ef'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- BAR CHART Ocupação -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = {
                labels: ['1º estágio', '2º estágio', '3º estágio', '4º estágio'],
                datasets: [
                    {
                        label: 'Ocupação',
                        backgroundColor: ['#c54939', '#a8721c', '#218c59', '#147f98'],
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [{{$internos->where('estagio', 1)->count()}}, {{$internos->where('estagio', 2)->count()}}, {{$internos->where('estagio', 3)->count()}}, {{$internos->where('estagio', 4)->count()}}]
                    },
                    {
                        label: 'Capacidade',
                        backgroundColor: ['#f56954', '#f39c12', '#00a65a', '#00c0ef'],
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [{{$alojamentos->where('estagio', 1)->sum('capacidade')}}, {{$alojamentos->where('estagio', 2)->sum('capacidade')}}, {{$alojamentos->where('estagio', 3)->sum('capacidade')}}, {{$alojamentos->where('estagio', 4)->sum('capacidade')}}]
                    },
                ]
            }
            var temp0 = barChartData.datasets[0]
            var temp1 = barChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        })
    </script>
@endsection
