@extends('admin.main')

@section('content')
<style>
th {
    text-align: center!important;
}
textarea {
    resize: none;
}
</style>
<div class="content">
    <div class="page-title text-center">
        <h3>Dashboard </h3>
    </div>

    @if(auth()->user()->empresa_id != 2)
        <div class="row" id="data_user_admin">
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom text-left">
                <div class="tiles blue added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Total de empresas </div>
                        <div class="heading"> <span class="animate-number" data-value="{{$dashboard->total_empresas}}" data-animation-duration="1000">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Disponibles en el panel</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom text-left">
                <div class="tiles green added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Total de empleados </div>
                        <div class="heading"> <span class="animate-number" data-value="{{$dashboard->total_empleados}}" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Registrados desde el sistema</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom text-left">
                <div class="tiles red added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                        <div class="tiles-title"> Usuarios sistema </div>
                        <div class="heading"> <span class="animate-number" data-value="{{$dashboard->total_usuarios}}" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-white progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="" ></div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Activos en el sistema </span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles purple added-margin">
                    <div class="tiles-body">
                        <div class="controller"> <a href="javascript:;" class=""></a> <a href="javascript:;" class="remove"></a> </div>
                            <div class="tiles-title"> Total de listas pagadas </div>
                            <div class="row-fluid">
                            <div class="heading"><span class="animate-number" data-value="{{$dashboard->total_listas_pagadas}}" data-animation-duration="700">0</span> </div>
                            <div class="progress transparent progress-white progress-small no-radius">
                                <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%"></div>
                            </div>
                        </div>
                        <div class="description"><span class="text-white mini-description ">Finalizadas desde el sistema</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="text-center col-sm-12 col-xs-12"><!-- Se imprime con todo el ancho de la página -->
                <canvas id="myChart" height="200" width="700"></canvas>  
            </div>
        </div>
    @endif
</div>
<script type="text/javascript">
var ctx = document.getElementById("myChart");

/*var data = {
    labels: ventas.dias_semana,
    datasets: [
        {
            label: "Ventas de última semana en Pesos (MXN)",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: ventas.total_ventas,
            spanGaps: false,
        }
    ]
};

var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }]
        }
    }
});*/
</script>
@endsection