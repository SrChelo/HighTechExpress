@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Bienvenido {{$user->name}}</h1>
        @can('Cliente')
            <a href="{{ route('envio.create') }}" class="btn btn-success">Solicita un envío</a>
        @endcan
        @can('Repartidor')
            <div class="container">
                <div class="row">
                    <h3>Solicitudes en espera</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-dark">
                            <th scope="col">Tipo</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Dimension</th>
                            <th scope="col">Out Date</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">Out Place</th>
                            <th scope="col">Arrival Place</th>
                            <th scope="col">Status</th>
                        </thead>
                        <tbody>
                            @foreach($espera as $envio)
                                <tr>
                                    <td>{{$envio->nombre}}</td>
                                    <td>{{$envio->weight}}</td>
                                    <td>{{$envio->dimen}}</td>
                                    <td>{{$envio->date_a}}</td>
                                    <td>{{$envio->date_b}}</td>
                                    <td>{{$envio->place_a}}</td>
                                    <td>{{$envio->place_b}}</td>
                                    @switch($envio->state)
                                    @case('En Espera')
                                    <td class="bg-info">
                                    @break
                                    @case('Denegado')
                                    <td class="bg-danger">
                                    @break
                                    @case('En Camino')
                                    <td class="bg-warning">
                                    @break
                                    @case('Terminado')
                                    <td class="bg-success">
                                    @break
                                    @endswitch{{$envio->state}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan="8" class="text-center"> . . .</td>
                            </tr>
                            <tr class="">
                                <td colspan="8" class="bg-info text-center text-light"><a href="{{ route('enviosAdd') }}">Ver Todos</a></td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
                <div class="row">
                    <h3>Solicitudes en mi ruta</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-dark">
                            <th scope="col">Tipo</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Dimension</th>
                            <th scope="col">Out Date</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">Out Place</th>
                            <th scope="col">Arrival Place</th>
                            <th scope="col">Status</th>
                        </thead>
                        <tbody>
                            @foreach($ruta as $envio)
                                <tr>
                                    <td>{{$envio->nombre}}</td>
                                    <td>{{$envio->weight}}</td>
                                    <td>{{$envio->dimen}}</td>
                                    <td>{{$envio->date_a}}</td>
                                    <td>{{$envio->date_b}}</td>
                                    <td>{{$envio->place_a}}</td>
                                    <td>{{$envio->place_b}}</td>
                                    @switch($envio->state)
                                    @case('En Espera')
                                    <td class="bg-info">
                                    @break
                                    @case('Denegado')
                                    <td class="bg-danger">
                                    @break
                                    @case('En Camino')
                                    <td class="bg-warning">
                                    @break
                                    @case('Terminado')
                                    <td class="bg-success">
                                    @break
                                    @endswitch{{$envio->state}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="">
                                <td colspan="8" class="text-center"> . . .</td>
                            </tr>
                            <tr class="">
                                <td colspan="8" class="bg-info text-center text-light"><a href="{{ route('ruta') }}">Ver Todos</a></td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
            </div>
        @endcan
        @can('Administrador')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{$cEnvios}}</span>
                                <span>Solicitudes Recibidas</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="myChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{$cUsuarios}}</span>
                                <span>Usuarios Registrados</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="myChart1" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @endcan
</div>
@endsection
@can('Administrador')
@section('scripts')
<script type="text/javascript">
window.onload = function(){
    window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
var COLORS = [
    '#4dc9f6',
    '#f67019',
    '#f53794',
    '#537bc4',
    '#acc236',
    '#166a8f',
    '#00a950',
    '#58595b',
    '#8549ba'
];
var ctx1 = document.getElementById('myChart').getContext('2d');
var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var myChart = new Chart(ctx1, {
    type:'line',
    data: {
        labels:MONTHS,
        datasets:[{
            label:'',
            borderColor: window.chartColors.green,
            backgroundColor: window.chartColors.red,
            data:[  @foreach($envios as $envio)
                    {{$envio}} ,
                    @endforeach
        ]
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Solicitudes Recibidas por mes en el año corriente'
        },
        tooltips: {
            mode: 'index',
        },
        hover: {
            mode: 'index'
        },
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                stacked: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
});
var mode      = 'index';
var intersect = true;
var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  };
var ctx2 = document.getElementById('myChart1').getContext('2d');
var myChart = new Chart(ctx2, {
    type:'bar',
    data: {
        labels:MONTHS,
        datasets:[{
                label:'',
                type                : 'line',
                data                :   [  @foreach($users as $user)
                                                {{$user}} ,
                                            @endforeach
                                        ],
                backgroundColor     : 'transparent',
                borderColor         : '#007bff',
                pointBorderColor    : '#007bff',
                pointBackgroundColor: '#007bff',
                fill                : false
            }
        ]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Solicitudes Recibidas por mes en el año corriente'
        },
        tooltips: {
            mode: 'index',
        },
        hover: {
            mode: 'index'
        },
        scales             : {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                stacked: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
      }
});

}
</script>
@endsection
@endcan