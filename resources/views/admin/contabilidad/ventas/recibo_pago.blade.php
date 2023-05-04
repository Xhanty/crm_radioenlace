@extends('layouts.menu')

@section('content')
    <style>
        .bg-gray {
            background-color: #bfbfbf;
        }

        .pad-4 {
            padding: 4px !important;
            border: 0px !important;
        }

        .center-text {
            display: flex;
            border: 0 !important;
            justify-content: center;
        }

        .font-20 {
            font-size: 18px;
        }

        .font-22 {
            font-size: 20px;
            font-weight: 500;
        }

        #div_general {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_form_add {
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
    </style>

    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Recibos de pago</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Recibos de pago</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary" id="btnNew">+</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="main-invoice-list" id="mainInvoiceList">
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002300</span> <span>$25</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 921021</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media selected">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002299</span> <span>$16</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 435423</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002300</span> <span>$32</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 921021</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002300</span> <span>$18</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 921021</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002300</span> <span>$25</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 921021</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002299</span> <span>$16</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 435423</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6><span>Invoice002300</span> <span>$32</span></h6>
                                        <div>
                                            <p><span>Date:</span> Oct 25</p>
                                            <p><span>Product:</span> 921021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- main-invoice-list -->
            <div class="col-md-12 col-xl-8">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="invoice-header">
                                <h1 class="invoice-title">Recibo Pago / Egreso</h1>
                            </div><!-- invoice-header -->
                            <div class="row mg-t-20">
                                <div class="col-md">
                                    <label class="tx-gray-600">Pagado a</label>
                                    <div class="billed-to">
                                        <h6>Andres Caceres</h6>
                                        <p>1.015.478.894<br>
                                            Medellín, Colombia</p>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="tx-gray-600">Información</label>
                                    <p class="invoice-info-row"><span>Recibo No.</span> <span>01</span></p>
                                    <p class="invoice-info-row"><span>Operación</span> <span>Anticipo</span></p>
                                    <p class="invoice-info-row"><span>Fecha</span> <span>10/03/2023</span></p>
                                </div>
                            </div>
                            <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="wd-20p">Factura</th>
                                            <th class="tx-center">Concepto</th>
                                            <th class="tx-right">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Anticipo</td>
                                            <td class="tx-center">RP-1-15 10/03/2023</td>
                                            <td class="tx-right">1.112.121</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right tx-uppercase tx-bold tx-inverse" colspan="2">Total COP</td>
                                            <td class="tx-right" colspan="1">
                                                <h4 class="tx-primary tx-bold">1.112.121</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="valign-middle" colspan="3">
                                                <div class="invoice-notes">
                                                    <label class="main-content-label tx-13">Observaciones</label>
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                        quae ab illo inventore veritatis et quasi architecto beatae vitae
                                                        dicta sunt explicabo.</p>
                                                </div><!-- invoice-notes -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <a class="btn btn-primary btn-block" href="javascript:void(0);">Generar PDF</a>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>

        <div class="row row-sm d-none" id="div_form_add">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Nuevo recibo de pago</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary back_home">x</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <div class="col-lg-11">
                                            <label for="">Tipo</label>
                                            <select class="form-select" id="tipo_add">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">RP-1-Recibo de pago / Egreso</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-lg-11">
                                            <label for="">Proveedor</label>
                                            <select class="form-select" id="proveedor_add">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}
                                                        ({{ $proveedor->nit }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <!-- Anticipo quita la tabla, de resto lista las deudas -->
                                        <div class="col-lg-11">
                                            <label for="">Realizar un</label>
                                            <select class="form-select" id="proveedor_add">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Abono a deudad</option>
                                                <option value="2">Anticipo</option>
                                                <option value="3">Avanzado (Impuestos, descuentos y ajustes)</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-lg-11">
                                            <label for="">De donde sale el dinero</label>
                                            <select class="form-select" id="proveedor_add">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Efectivo</option>
                                                <option value="2">Pago tranferencia</option>
                                                <option value="3">Pago por cuenta bancaria</option>
                                                <option value="4">Honorarios</option>
                                                <option value="5">Salarios por pagar</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="col-lg-11">
                                            <label for="">Fecha elaboración</label>
                                            <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                                placeholder="Fecha elaboración" type="date">
                                        </div>
                                        <br>
                                        <div class="col-lg-11">
                                            <label for="">Centro de costo</label>
                                            <select class="form-select" id="centro_costo_add">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($centros_costos as $centro_costo)
                                                    <option value="{{ $centro_costo->id }}">({{ $centro_costo->code }})
                                                        {{ $centro_costo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-sm mt-5">
                                    <div class="table-responsive">
                                        <table id="tbl_data_detail"
                                            class="table border-top-0 table-bordered text-nowrap border-bottom">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th class="text-center"><input type="checkbox"></th>
                                                    <th class="text-center">Vencimiento</th>
                                                    <th class="text-center">Cuota</th>
                                                    <th class="text-center">Saldo</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <label for="">Observaciones</label>
                                        <textarea class="form-control" placeholder="Observaciones" rows="3" id="observaciones_add"
                                            style="height: 90px; resize: none"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row-sm">
                                    <div class="col-lg">
                                        <input type="file" id="file_add" multiple class="form-control">
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" id="btnAddFactura">Guardar Recibo Pago</button>
                                </div>
                            </div>
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

        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/recibo_pago.js') }}"></script>
@endsection
