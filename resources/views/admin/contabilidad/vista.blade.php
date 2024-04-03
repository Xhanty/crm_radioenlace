@extends('layouts.menu')

@section('css')
    <style>
        .bg-info {
            background: linear-gradient(45deg, rgb(156, 156, 156), #DA251D) !important;
        }

        .box {
            margin-top: 20px;
        }

        .box:hover {
            box-shadow: 0px 30px 40px -20px hsl(229, 31%, 21%);
            transform: scale(1.05);
            /* Escala ligeramente el elemento al hacer hover */
            transition: transform 0.3s ease;
            /* Agrega una transición suave */
        }

        /* También puedes aplicar animaciones específicas a elementos dentro del card en hover, por ejemplo: */

        .box:hover img {
            transform: rotate(10deg);
            /* Rota la imagen 10 grados al hacer hover */
            transition: transform 0.3s ease;
            /* Agrega una transición suave */
        }

        .rounded {
            border-radius: 22px !important;
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .box:hover {
            box-shadow: 0px 30px 40px -20px hsl(229, 31%, 21%);
        }

        @media (max-width: 450px) {
            .box {
                height: 200px;
            }
        }

        @media (max-width: 950px) and (min-width: 450px) {
            .box {
                text-align: center;
                height: 180px;
            }
        }

        @media (min-width: 950px) {
            .row1-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .row2-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .box-down {
                position: relative;
                top: 150px;
            }

            .box {
                width: 20%;

            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Para las imágenes */
        .img-cards {
            animation: fadeIn 1s ease-in-out;
        }

        /* Para los contenedores de texto */
        .h3-cards {
            animation: slideIn 1s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Contabilidad</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container" id="content_list_options" style="display: block">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/compras.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Compras y
                                Gastos</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/ventas.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Ventas</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/nomina.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Nómina</a></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/contabilidad.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);"
                                style="color: white">Contabilidad</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/inventario.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Productos y
                                Servicios</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/habilitacion.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Habilitación
                                Electrónica</a></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/indicadores.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Indicadores</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/reportes.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Reportes</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/reportes_nomina.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Reportes de
                                Nómina</a></h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_compras" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                                    type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Contact</button>
                            </li>
                        </ul>
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary" id="back">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">...</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.box').click(function() {
                $('#content_list_options').hide();
                $('#content_list_compras').show();
            });

            $('#back').click(function() {
                $('#content_list_options').show();
                $('#content_list_compras').hide();
            });
        });
    </script>
@endsection
