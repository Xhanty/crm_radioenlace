@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Facturas de compra</li>
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
                                <h3 class="card-title">Facturas</h3>
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
                                <h3 class="card-title">Nueva factura de compra</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary back_home">x</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <div class="row row-sm">
                                    <div class="col-lg-3">
                                        <label for="">Tipo</label>
                                        <select class="form-select" id="tipo_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="2">Nota de crédito</option>
                                            <option value="3">Nota de débito</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Centro de costo</label>
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
                                    <div class="col-lg-3">
                                        <label for="">Proveedor</label>
                                        <select class="form-select" id="proveedor_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="2">RR</option>
                                            <option value="3">AA</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">Contacto</label>
                                        <input class="form-control" disabled id="contacto_add" placeholder="Contacto"
                                            type="text">
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">No. Factura Proveedor</label>
                                        <input class="form-control" id="factura1_proveedor_add" placeholder="Contacto"
                                            type="text">
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">Consecutivo Factura Proveedor</label>
                                        <input class="form-control" id="factura2_proveedor_add" placeholder="Consecutivo Factura Proveedor"
                                            type="text">
                                    </div> 
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg">
                                    </div>
                                    <div class="col-lg">
                                        <label class="ckbox"><input id="chk_proveedor" type="checkbox"><span>Proveedor por item</span></label>
                                    </div>

                                    <div class="col-lg">
                                        <label class="ckbox"><input id="chk_iva" type="checkbox"><span>IVA/Impoconsumo incluido</span></label>
                                    </div>

                                    <div class="col-lg">
                                        <label class="ckbox"><input id="chk_procentaje" type="checkbox"><span>Descuento en porcentaje</span></label>
                                    </div> 
                                    <div class="col-lg">
                                    </div>
                                </div>
                                <br>
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" id="btnAddFactura">Guardar Factura</button>
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
    <script src="{{ asset('assets/js/app/contabilidad/factura_compra.js') }}"></script>
@endsection
