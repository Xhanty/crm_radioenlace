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
                        <li class="breadcrumb-item active" aria-current="page"> Nota Débito (Ventas)</li>
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
                                <h3 class="card-title">Nota Débito (Ventas)</h3>
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
                                <h1 class="invoice-title">Invoice</h1>
                                <div class="billed-from">
                                    <h6>BootstrapDash, Inc.</h6>
                                    <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                        Tel No: 324 445-4544<br>
                                        Email: youremail@companyname.com</p>
                                </div><!-- billed-from -->
                            </div><!-- invoice-header -->
                            <div class="row mg-t-20">
                                <div class="col-md">
                                    <label class="tx-gray-600">Billed To</label>
                                    <div class="billed-to">
                                        <h6>Juan Dela Cruz</h6>
                                        <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                            Tel No: 324 445-4544<br>
                                            Email: youremail@companyname.com</p>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="tx-gray-600">Invoice Information</label>
                                    <p class="invoice-info-row"><span>Invoice No</span> <span>GHT-673-00</span></p>
                                    <p class="invoice-info-row"><span>Project ID</span> <span>32334300</span></p>
                                    <p class="invoice-info-row"><span>Issue Date:</span> <span>November 21, 2017</span></p>
                                    <p class="invoice-info-row"><span>Due Date:</span> <span>November 30, 2017</span></p>
                                </div>
                            </div>
                            <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="wd-20p">Type</th>
                                            <th class="wd-40p">Description</th>
                                            <th class="tx-center">QNTY</th>
                                            <th class="tx-right">Unit Price</th>
                                            <th class="tx-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Website Design</td>
                                            <td class="tx-12">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium doloremque laudantium, totam rem aperiam...</td>
                                            <td class="tx-center">2</td>
                                            <td class="tx-right">$150.00</td>
                                            <td class="tx-right">$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>Firefox Plugin</td>
                                            <td class="tx-12">At vero eos et accusamus et iusto odio dignissimos ducimus
                                                qui blanditiis praesentium voluptatum deleniti atque...</td>
                                            <td class="tx-center">1</td>
                                            <td class="tx-right">$1,200.00</td>
                                            <td class="tx-right">$1,200.00</td>
                                        </tr>
                                        <tr>
                                            <td>iPhone App</td>
                                            <td class="tx-12">Et harum quidem rerum facilis est et expedita distinctio
                                            </td>
                                            <td class="tx-center">2</td>
                                            <td class="tx-right">$850.00</td>
                                            <td class="tx-right">$1,700.00</td>
                                        </tr>
                                        <tr>
                                            <td class="valign-middle" colspan="2" rowspan="4">
                                                <div class="invoice-notes">
                                                    <label class="main-content-label tx-13">Notes</label>
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                        accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                        quae ab illo inventore veritatis et quasi architecto beatae vitae
                                                        dicta sunt explicabo.</p>
                                                </div><!-- invoice-notes -->
                                            </td>
                                            <td class="tx-right">Sub-Total</td>
                                            <td class="tx-right" colspan="2">$5,750.00</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right">Tax (5%)</td>
                                            <td class="tx-right" colspan="2">$287.50</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right">Discount</td>
                                            <td class="tx-right" colspan="2">-$50.00</td>
                                        </tr>
                                        <tr>
                                            <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
                                            <td class="tx-right" colspan="2">
                                                <h4 class="tx-primary tx-bold">$5,987.50</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                <h3 class="card-title">Nueva nota débito</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary back_home">x</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <label for="">Clientes</label>
                                        <select class="form-select" id="tipo_add" multiple>
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} ({{ $cliente->nit }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-3">
                                        <label for="">Factura</label>
                                        <select class="form-select" id="tipo_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="2">Nota de crédito</option>
                                            <option value="3">Nota de débito</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Tipo</label>
                                        <select class="form-select" id="centro_costo_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="2">RR</option>
                                            <option value="3">AA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Fecha elaboración</label>
                                        <input class="form-control" id="fecha_add" placeholder="Fecha elaboración"
                                            type="date">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Número</label>
                                        <input class="form-control" disabled id="numero_add" placeholder="Número"
                                            type="text">
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <label for="">Proveedor</label>
                                        <select class="form-select" id="proveedor_add">
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }} ({{ $proveedor->nit }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="">Contacto</label>
                                        <input class="form-control" disabled id="contacto_add" placeholder="Contacto"
                                            type="text">
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="">Vendedor</label>
                                        <select class="form-select" id="centro_costo_add">
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row row-sm mt-5">
                                    <div class="table-responsive">
                                        <table id="tbl_data_detail"
                                            class="table border-top-0 table-bordered text-nowrap border-bottom">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Producto</th>
                                                    <th class="text-center">Descripción</th>
                                                    <th class="text-center">Bodega</th>
                                                    <th class="text-center">Cant</th>
                                                    <th class="text-center">Valor Unitario</th>
                                                    <th class="text-center">Descuento</th>
                                                    <th class="text-center">Impuesto<br>Cargo</th>
                                                    <th class="text-center">Impuesto<br>Retención</th>
                                                    <th class="text-center">Valor Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background: #f9f9f9;">
                                                    <td class="center-text pad-4">1</td>
                                                    <td class="pad-4">
                                                        <select class="form-select producto_add">
                                                            <option value="">Seleccione una opción</option>
                                                            @foreach ($productos as $producto)
                                                                <option value="{{ $producto->id }}">{{ $producto->nombre }}
                                                                    ({{ $producto->marca }} - {{ $producto->modelo }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="pad-4">
                                                        <textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="2"></textarea>
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Bodega"
                                                            class="form-control bodega_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Cantidad"
                                                            class="form-control text-end cantidad_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Valor Unitario"
                                                            class="form-control text-end valor_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Descuento"
                                                            class="form-control text-end descuento_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <select class="form-select cargo_add">
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="1">IVA 19%</option>
                                                            <option value="2">Iva Serv 19%</option>
                                                            <option value="3">IVA 16%</option>
                                                            <option value="4">IVA 5%</option>
                                                            <option value="5">Impoconsumo 8%</option>
                                                        </select>
                                                    </td>
                                                    <td class="pad-4">
                                                        <select class="form-select retencion_add">
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="1">Retefuente 11%</option>
                                                            <option value="2">Retefuente 10%</option>
                                                            <option value="3">Retefuente 7%</option>
                                                            <option value="4">Retefuente 6%</option>
                                                            <option value="5">Retención 5%</option>
                                                            <option value="6">Retefuente 4%</option>
                                                            <option value="8">Arriendos 4%</option>
                                                            <option value="9">Arriendos 3.5%</option>
                                                            <option value="10">Retefuente 3.5%</option>
                                                            <option value="11">Retefuente 2.5%</option>
                                                            <option value="12">Retefuente 2%</option>
                                                            <option value="13">Retefuente 1%</option>
                                                            <option value="14">Autoretención del cree 0.4%</option>
                                                            <option value="15">Retefuente 0.1%</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center d-flex pad-4">
                                                        <input disabled type="text" placeholder="0.00"
                                                            class="form-control text-end total_add" style="border: 0">
                                                        <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                            id="new_row"><i class="fa fa-plus"></i></a>
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row row-sm mt-3">
                                    <div class="col-lg-6 mt-3">
                                        <h3 class="card-title">Forma de pago</h3>
                                        <hr>
                                        <div class="row row-sm">
                                            <div class="col-lg-6">
                                                <select class="form-select">
                                                    <option value="">Seleccione una opción</option>
                                                    @foreach ($formas_pago as $forma_pago)
                                                        <option value="{{ $forma_pago->id }}">{{ $forma_pago->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-3 d-flex" style="justify-content: end">
                                                <input type="text" placeholder="0.00"
                                                    class="form-control col-8 text-end">
                                            </div>
                                            <div class="col-lg-1 d-flex" style="justify-content: center">
                                                <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                    id="new_row_forma"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                        <div id="list_formas_pago"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row row-sm mt-2">
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div style="width: 100%; margin-right: 24%" class="text-end">
                                                    <p class="font-20">Total Bruto:</p>
                                                </div>
                                                <div>
                                                    <p class="font-20">0.00</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div style="width: 100%; margin-right: 24%" class="text-end">
                                                    <p class="font-20">Descuentos:</p>
                                                </div>
                                                <div>
                                                    <p class="font-20">0.00</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div style="width: 100%; margin-right: 24%" class="text-end">
                                                    <p class="font-20">Subtotal:</p>
                                                </div>
                                                <div>
                                                    <p class="font-20">0.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg d-flex" style="justify-content: end">
                                        <div>
                                            <p class="font-22">Total formas de pagos:</p>
                                        </div>
                                        <div style="margin-left: 10%">
                                            <p class="font-22">0.00</p>
                                        </div>
                                    </div>

                                    <div class="col-lg d-flex" style="justify-content: end">
                                        <div>
                                            <p class="font-22">Total Neto:</p>
                                        </div>
                                        <div style="margin-left: 10%">
                                            <p class="font-22">0.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" id="btnAddFactura">Guardar Nota Débito</button>
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
            var productos = @json($productos);
            var formas_pago = @json($formas_pago);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/nota_debito.js') }}"></script>
@endsection
