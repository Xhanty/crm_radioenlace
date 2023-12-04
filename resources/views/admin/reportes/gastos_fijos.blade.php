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
                        <li class="breadcrumb-item"><a href="gastos_fijos/general.xlsx">Reportes</a></li>
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
                            <h4 class="card-title mb-3">Gastos Fijos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">62.254.409,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/general.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
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
            <!--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Viáticos</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">0</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-time text-purple tx-24"></i>
                            </div>
                        </div>
                        <div class="d-flex mt-2" style="justify-content: center;">
                            <a href="gastos_fijos/general.xlsx" class="btn btn-primary mt-3">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <!-- row closed -->
    </div>
@endsection
