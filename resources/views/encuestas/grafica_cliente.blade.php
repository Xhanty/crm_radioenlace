@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Satisfacción
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Promedio de satisfacción</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="satisfaccionChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var encuestas = @json($encuestas);
            console.log(encuestas);

            var labels = encuestas.map(function(encuesta) {
                return encuesta.razon_social;
            });

            var data = encuestas.map(function(encuesta) {
                return encuesta.promedio;
            });

            var ctx = document.getElementById('satisfaccionChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Promedio de Satisfacción',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5 // Puedes ajustar el rango máximo según tus necesidades
                        }
                    }
                }
            });
        });
    </script>
@endsection
