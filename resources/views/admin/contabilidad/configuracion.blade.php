@extends('layouts.menu')

@section('css')
    <link href="{{ asset('assets/css/app/tables_img.css') }}" rel="stylesheet">
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
                        <li class="breadcrumb-item active" aria-current="page"> Configuración</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <style>
            .box a {
                font-size: 16px;
                color: hsl(229, 6%, 66%);
                text-decoration: none;
            }

            .box h2 {
                font-size: 1.45rem;
                font-weight: 700;
                color: hsl(229, 31%, 21%);
            }

            .box {
                border-radius: 5px;
                background-color: white;
                box-shadow: 0px 30px 40px -20px hsl(229, 6%, 66%);
                padding: 30px;
                margin: 20px;
                -webkit-transition: 1s linear;
                transition: 1s linear;
                animation: 1s ease-in-out 0s 1 slideInFromTop;
            }

            #div_organizacion {
                -webkit-transition: 1s linear;
                transition: 1s linear;
                animation: 1s ease-in-out 0s 1 slideInFromTop
            }

            #div_formas_pago {
                -webkit-transition: 1s linear;
                transition: 1s linear;
                animation: 1s ease-in-out 0s 1 slideInFromTop
            }

            #div_pucs {
                -webkit-transition: 1s linear;
                transition: 1s linear;
                animation: 1s ease-in-out 0s 1 slideInFromTop
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

            .cyan {
                border-top: 3px solid hsl(180, 62%, 55%);
            }

            .red {
                border-top: 3px solid hsl(0, 78%, 62%);
            }

            .blue {
                border-top: 3px solid hsl(212, 86%, 64%);
            }

            .orange {
                border-top: 3px solid hsl(34, 97%, 64%);
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
        </style>

        <div class="row row-sm" id="div_general">
            <div class="row1-container">
                <div class="box box-down cyan">
                    <h2>Terceros</h2>
                    <ul>
                        <li><a href="javascript:void(0);">Clientes</a></li>
                        <li><a href="javascript:void(0);">Proveedores</a></li>
                        <li><a href="javascript:void(0);">Empleados</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-team-builder.svg"
                        alt="Terceros">
                </div>

                <div class="box red">
                    <h2>General</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnOrganizacion">Organización</a></li>
                        <li><a href="javascript:void(0);" id="btnFormasPago">Formas de pago</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-supervisor.svg"
                        alt="General">
                </div>

                <div class="box box-down blue">
                    <h2>Catálogo</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnPuc">PUC</a></li>
                        <li><a href="javascript:void(0);">Centros de costos</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-calculator.svg"
                        alt="Catálogo">
                </div>
            </div>
            <div class="row2-container">
                <div class="box orange">
                    <h2>Opción</h2>
                    <ul>
                        <li><a href="javascript:void(0);">Opción 1</a></li>
                        <li><a href="javascript:void(0);">Opción 2</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-karma.svg"
                        alt="Opción">
                </div>
            </div>
        </div>

        @include('admin.contabilidad.configuracion.organizacion')
        @include('admin.contabilidad.configuracion.formas_pago')
        @include('admin.contabilidad.configuracion.pucs')

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
    <script src="https://homfen.github.io/dataTables.treeGrid.js/dataTables.treeGrid.js"></script>
    <script src="{{ asset('assets/js/app/contabilidad/configuracion.js') }}"></script>
@endsection
