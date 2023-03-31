@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Reportes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Compras</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row row-sm">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Cantidad Facturas</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">5.274</span>
                                </h4>
                            </div>
                            <div class="card-chart bg-pink-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-chart-line-outline text-pink tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Cargos (Iva)</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1   font-weight-bold">400.600,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Retenciones</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">302.450,00</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-time  text-purple tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Totales</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">48.000.000,00</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-time  text-purple tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Ventas - Compras
                        </div>
                        <p class="mg-b-20">Comparación entre ventas y compras.</p>
                        <div id="index" class="ht-300"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <div class="row row-sm">
            <div class="col-md-12 col-lg-12 col-xl-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2">Proveedores</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-0">Proveedores con más compras realizadas.</p>
                    </div><!-- card-header -->
                    <div class="card-body p-0">
                        <div class="browser-stats">
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Chrome</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 my-auto">35.502,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Opera</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 my-auto">12.563,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Edge</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 mt-1">25.364,00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- card -->
            </div>
            <div class="col-md-12 col-lg-12 col-xl-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2">Vendedores</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-0">Vendedores con más compras realizadas.</p>
                    </div><!-- card-header -->
                    <div class="card-body p-0">
                        <div class="browser-stats">
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Chrome</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 my-auto">35.502,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Opera</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 my-auto">12.563,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center item  border-bottom">
                                <div class="d-flex">
                                    <img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"
                                        class="ht-30 wd-30 me-2">
                                    <div class="">
                                        <h6 class="">Edge</h6>
                                        <span class="sub-text">Mozilla Foundation, Inc.</span>
                                    </div>
                                </div>
                                <div class="ms-auto my-auto">
                                    <div class="d-flex">
                                        <span class="me-4 mt-1">25.364,00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- card -->
            </div>
        </div>

        <div class="row row-sm ">
            <div class="col-md-12 col-xl-12">
                <div class="card overflow-hidden review-project">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Facturas</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-3">Listado de facturas registradas en el software.</p>
                        <div class="table-responsive mb-0">
                            <table
                                class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Factura</th>
                                        <th>Proveedor</th>
                                        <th>Valor</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="project-contain">
                                                <h6 class="mb-1 tx-13"><a target="_blank"
                                                        href="{{ route('pdf_factura_compra') }}?token=5">Factura No. 01</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>Syscom Colombia S.A.S</td>
                                        <td>500.498,00</td>
                                        <td>31/03/2023</td>
                                        <td><span class="badge bg-primary-gradient">Sin Pago</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="project-contain">
                                                <h6 class="mb-1 tx-13"><a target="_blank"
                                                        href="{{ route('pdf_factura_compra') }}?token=5">Factura No. 02</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>Radiotrans Colombia S.A.S</td>
                                        <td>223.500,00</td>
                                        <td>30/03/2023</td>
                                        <td><span class="badge bg-success-gradient">Con Pago</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/echart/echart.js') }}"></script>
    <script>
        $(function(e) {
            'use strict'
            /*----BarChartEchart----*/
            var echartBar = echarts.init(document.getElementById('index'), {
                color: ['#285cf7', '#7987a1'],
                categoryAxis: {
                    axisLine: {
                        lineStyle: {
                            color: '#888180'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['rgba(171, 167, 167,0.2)']
                        }
                    }
                },
                grid: {
                    x: 40,
                    y: 20,
                    x2: 40,
                    y2: 20
                },
                valueAxis: {
                    axisLine: {
                        lineStyle: {
                            color: '#888180'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(255,255,255,0.1)']
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['rgba(171, 167, 167,0.2)']
                        }
                    }
                },
            });
            echartBar.setOption({
                tooltip: {
                    trigger: 'axis',
                    position: ['35%', '32%'],
                },
                legend: {
                    data: ['New Account', 'Expansion Account']
                },
                toolbox: {
                    show: false
                },
                calculable: false,
                xAxis: [{
                    type: 'category',
                    data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre',
                        'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                }],
                yAxis: [{
                    type: 'value',
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                }],
                series: [{
                    name: 'View Price',
                    type: 'bar',
                    data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
                    markPoint: {
                        data: [{
                            type: 'max',
                            name: ''
                        }, {
                            type: 'min',
                            name: ''
                        }]
                    },
                    markLine: {
                        data: [{
                            type: 'average',
                            name: ''
                        }]
                    }
                }, {
                    name: ' Purchased Price',
                    type: 'bar',
                    data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                    markPoint: {
                        data: [{
                            name: 'Purchased Price',
                            value: 182.2,
                            xAxis: 7,
                            yAxis: 183,
                        }, {
                            name: 'Purchased Price',
                            value: 2.3,
                            xAxis: 11,
                            yAxis: 3
                        }]
                    },
                    markLine: {
                        data: [{
                            type: 'average',
                            name: ''
                        }]
                    }
                }]
            });
        });
    </script>
    <script src="{{ asset('assets/js/app/reportes/compras.js') }}"></script>
@endsection
