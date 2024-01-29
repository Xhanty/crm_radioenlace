@extends('layouts.menu')

@section('css')
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

        <div class="row row-sm" id="div_general">
            <div class="row1-container">
                <div class="box box-down cyan" style="border-top: 14px solid hsl(180, 62%, 55%)">
                    <h2 style="margin-top: -8px">Nómina</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="btnImpuestos">Facturación</a></li>
                        <li><a href="javascript:void(0);" id="btnComprobantes">Reportes</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-team-builder.svg"
                        alt="Terceros">
                </div>

                <div class="box red" style="border-top: 14px solid hsl(0, 78%, 62%)">
                    <h2 style="margin-top: -8px">Ventas</h2>
                    <ul>
                        <li><a href="{{ route('factura_venta') }}">Facturación</a></li>
                        <li><a href="{{ route('recibos_pagos') }}">Recibos de caja</a></li>
                        <li><a href="{{ route('reporte_ventas') }}">Reportes</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-supervisor.svg"
                        alt="General">
                </div>

                <div class="box box-down blue" style="border-top: 14px solid hsl(212, 86%, 64%)">
                    <h2 style="margin-top: -8px">Otros Comprobantes</h2>
                    <ul>
                        <li><a href="javascript:void(0);" id="">Otros Comprobantes</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-karma.svg"
                        alt="Catálogo">
                </div>
            </div>
            <div class="row2-container">
                <div class="box orange" style="border-top: 14px solid hsl(34, 97%, 64%)">
                    <h2 style="margin-top: -8px">Compras</h2>
                    <ul>
                        <li><a href="{{ route('factura_compra') }}" id="btnAdminCiudades">Facturación</a></li>
                        <li><a href="{{ route('comprobantes_egresos') }}" id="btnFormasPago">Egresos</a></li>
                        <li><a href="javascript:void(0);" id="btnFormasPago">Radian</a></li>
                        <li><a href="{{ route('reporte_compras') }}" id="btnAdminTipoEmpresa">Reportes</a></li>
                    </ul>
                    <img style="float:right; width: 40px;" src="https://assets.codepen.io/2301174/icon-calculator.svg"
                        alt="Opción">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
