@extends('layouts.menu')

@section('css')
    <style>
        .btn-flotante {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            border-radius: 5px;
            letter-spacing: 2px;
            background-color: #3858F9;
            padding: 18px 30px;
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #3858F9;
            color: #ffffff;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }

        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Reportes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Gastos Fijos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="row row-sm">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Gastos De Funcionamiento</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">10.037.083,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/funcionamiento.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Vehículos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">16.703.649,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/vehiculos.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Viáticos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">3.812.680,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/viaticos.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Servicios</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">5.074.181,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/servicios.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Seguros</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">4.166.131,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/seguros.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Honorarios</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">2.820.000,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/honorarios.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Materiales y respuestos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">800.000,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/repuestos_radios.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Caja General</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">863.004,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/caja_general.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Gastos Médicos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">3.729.223,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/gastos_medicos.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Dotación</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">898.969,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/dotacion.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Mantenimiento de vehículos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">4.666.666,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/mantenimientos_vehiculos.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Seguro Empleados</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">559.196,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/seguro_empleados.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Arrendamientos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">9.032.260,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/arrendamientos.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Otros Gastos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">1.791.667,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/otros.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Nómina</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">140.767.188,00</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-time text-purple tx-24"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/nomina.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
@endsection
