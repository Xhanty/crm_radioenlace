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
                            <h4 class="card-title mb-3">Facturas</h4>
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
                                        <span class="me-4 my-auto">35,502</span>
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
                                        <span class="me-4 my-auto">12,563</span>
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
                                        <span class="me-4 mt-1">25,364</span>
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
                                        <span class="me-4 my-auto">35,502</span>
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
                                        <span class="me-4 my-auto">12,563</span>
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
                                        <span class="me-4 mt-1">25,364</span>
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
                                        <th>Factura</th>
                                        <th>Proveedor</th>
                                        <th>Valor</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="project-contain">
                                                <h6 class="mb-1 tx-13"><a target="_blank"
                                                        href="{{ route('pdf_factura_compra') }}?token=5">Angular
                                                        Project</a></h6>
                                            </div>
                                        </td>
                                        <td>Web Design</td>
                                        <td>01 Jan 2020</td>
                                        <td>15 March 2020</td>
                                        <td><span class="badge bg-primary-gradient">Sin Pago</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="project-contain">
                                                <h6 class="mb-1 tx-13"><a target="_blank"
                                                        href="{{ route('pdf_factura_compra') }}?token=5">PHP Project</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>Web Development</td>
                                        <td>03 March 2020</td>
                                        <td>15 Jun 2020</td>
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
    <script src="{{ asset('assets/js/app/reportes/compras.js') }}"></script>
@endsection
