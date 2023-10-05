@extends('layouts.menu')

@section('css')
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

        .badge {
            margin-left: 6px;
            display: inline-block;
            padding: 0.25em 0.5em; /* Ajusta el padding según tus preferencias */
            font-size: 12px; /* Tamaño de fuente */
            font-weight: bold; /* Peso de la fuente */
            border-radius: 4px; /* Borde redondeado */
            background-color: #ffc107; /* Color de fondo */
            color: #000; /* Color del texto */
        }

        /* Estilo para el badge de éxito */
        .badge-success {
            background-color: #28a745; /* Color de fondo para el éxito */
            color: #fff; /* Color del texto para el éxito */
        }

        /* Estilo para el badge de advertencia */
        .badge-warning {
            background-color: #ffc107; /* Color de fondo para la advertencia */
            color: #000; /* Color del texto para la advertencia */
        }

        /* Estilo para el badge de error */
        .badge-danger {
            background-color: #dc3545; /* Color de fondo para el error */
            color: #fff; /* Color del texto para el error */
        }
    </style>

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

        .bg-pending {
            background: rgb(255, 193, 7, .3);
        }

        .bg-paid {
            background: rgb(40, 167, 69, .3);
        }

        .bg-cancel {
            background: rgb(220, 53, 69, .3);
        }

        .center-div {
            display: flex;
            justify-content: center;
        }

        .pagination {
            margin-top: 14px;
            margin-bottom: 12px;
        }

        .page-link {
            color: #000;
            border-radius: 20px;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: not-allowed;
            border-radius: 20px;
        }

        .orange {
            color: #FF8000;
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
                        <li class="breadcrumb-item active" aria-current="page"> Facturas de venta</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if ($view_alert == 1)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> Quedan pocos números disponibles en la numeración de
                    facturación autorizada por la DIAN</span>
            </div>
        @elseif($view_alert == 2)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> La fecha de vigencia de la numeración de facturación autorizada por la
                    DIAN esta próxima a vencer</span>
            </div>
        @endif

        @if ($disabled_fv == 1)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> La numeración de facturación autorizada por la DIAN esta vencida</span>
            </div>
        @endif
        <!-- /breadcrumb -->
        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Facturas de venta</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button @if ($disabled_fv == 1) disabled @endif class="btn btn-primary"
                                    id="btnNew">+</button>
                                <a href="javascript:void(0);" style="margin-right: 10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="34" height="34" viewBox="0 0 48 48">
                                        <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path><path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path><path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path><path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                                        </svg></a>
                                <a href="" style="margin-right: 10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30px" width="30px" version="1.1" id="Layer_1" viewBox="0 0 303.188 303.188" xml:space="preserve">
                                        <g>
                                            <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525  "/>
                                            <path style="fill:#FB3449;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936   c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202   c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251   c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594   c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603   c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02   c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024   c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387   c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205   c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119   c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57   C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041   c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065   c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918   c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985   c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993   c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883   c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265   c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197   c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z    M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542   c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275   c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"/>
                                            <polygon style="fill:#FB3449;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0  "/>
                                            <g>
                                                <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643    v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z     M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857    h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"/>
                                                <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979    h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324    c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43    C160.841,257.523,161.76,254.028,161.76,249.324z"/>
                                                <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374    L196.579,273.871L196.579,273.871z"/>
                                            </g>
                                            <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0  "/>
                                        </g>
                                        </svg>
                                </a>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="main-invoice-list" id="mainInvoiceList">
                                @foreach ($facturas as $key => $factura)
                                    @if ($factura->status == 0)
                                        @php
                                            $bg = 'bg-cancel';
                                        @endphp
                                    @elseif($factura->status == 2)
                                        @php
                                            $bg = 'bg-paid';
                                        @endphp
                                    @else
                                        @php
                                            $bg = 'bg-pending';
                                        @endphp
                                    @endif

                                    <div class="media factura_btn {{ $bg }}" data-id="{{ $factura->id }}">
                                        <div class="media-icon">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            @php
                                                $fecha_vencimiento = date('Y-m-d', strtotime($factura->fecha_elaboracion . ' + 30 days'));
                                                $fecha_actual = date('Y-m-d');
                                                $color = '';
                                                // Convierte ambas fechas en objetos DateTime
                                                $fecha_vencimiento_obj = new DateTime($fecha_vencimiento);
                                                $fecha_actual_obj = new DateTime($fecha_actual);

                                                // Calcula la diferencia entre las fechas
                                                $diferencia = $fecha_actual_obj->diff($fecha_vencimiento_obj);

                                                // Obtiene el número de días pasados
                                                $dias_pasados = $diferencia->days;

                                                // Si van menos de 20 días, poner en verde
                                                if ($dias_pasados < 20) {
                                                    $color = 'badge-success';
                                                } else if ($dias_pasados < 28) {
                                                    $color = 'badge-warning';
                                                } else {
                                                    $color = 'badge-danger';
                                                }
                                            @endphp
                                            <h6><span>Factura No. FE-{{ $factura->numero }}@if($bg == 'bg-pending')<badge
                                                        class="badge {{ $color }}">{{ $dias_pasados }}</badge>@endif</span>
                                                <span>{{ $factura->valor_total }}
                                                    @if ($factura->favorito == 0)
                                                        <i data-id="{{ $factura->id }}"
                                                            class="far fa-star btn_favorite"></i>
                                            @else
                                                <i data-id="{{ $factura->id }}"
                                                    class="fas fa-star btn_favorite orange"></i>
                                    @endif
                                    
                                        @if ($factura->visto_bueno == 0)
                                                <i data-id="{{ $factura->id }}"
                                                    class="far fa-check-circle @if (auth()->user()->hasPermissionTo('contabilidad_visto_bueno')) btn_visto_bueno @endif"></i>
                                        </span>
                                        @else
                                            <i data-id="{{ $factura->id }}"
                                                class="fas fa-check-circle @if (auth()->user()->hasPermissionTo('contabilidad_visto_bueno')) btn_visto_bueno @endif orange"></i></span>
                                        
                                    @endif
                                </span>
                                </h6>
                                <div>
                                    <p><span>Fecha:</span>
                                        {{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}</p>
                                    <p>{{ $factura->razon_social }} (NIT:
                                        {{ $factura->nit }}-{{ $factura->codigo_verificacion }})</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
                        <h1 class="invoice-title">FACTURA VENTA</h1>
                        <div class="billed-from">
                            <h6>RADIO ENLACE S.A.S.</h6>
                            <p>Nit 830.504.313-5<br>
                                Tel: (604) 4448280<br>
                                Medellín - Colombia</p>
                        </div><!-- billed-from -->
                    </div><!-- invoice-header -->
                    <div id="content_factura" class="d-none">
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Facturado a</label>
                                <div class="billed-to">
                                    <h6 id="cliente_view">EDATEL TIGO</h6>
                                    <p id="nit_view">Nit 890.905.065-2<br>
                                        Tel: (034) 3846500<br>
                                        Medellín - Colombia</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Información de la factura</label>
                                <p class="invoice-info-row"><span>Factura No.</span> <span id="num_fact_view">1743</span>
                                </p>
                                <p class="invoice-info-row"><span>Fecha Venta</span> <span
                                        id="compra_view">21/03/2023</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Ítem</th>
                                        <th class="wd-40p">Descripción</th>
                                        <th class="tx-center">Cantidad</th>
                                        <th class="tx-center">Impuesto<br>Cargo</th>
                                        <th class="tx-center">Impuesto<br>Rete.</th>
                                        <th class="tx-right">Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody id="productos_view"></tbody>
                            </table>
                        </div>
                        <hr>
                        <hr>
                        <div style="display: flex; justify-content: center;">
                            <a class="btn btn-success btn_pago_factura" data-id="0" style="margin-right: 10px;"
                                href="javascript:void(0);">Recibir Pago</a>

                            <a class="btn btn-primary btn_imprimir_factura" style="margin-right: 10px;" target="_blank"
                                href="{{ route('pdf_factura_venta') }}?token=0">Descargar e
                                Imprimir</a>

                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Otras Opciones
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="4"
                                        href="javascript:void(0)">Ver Contabilización</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="3"
                                        href="javascript:void(0)">Aplicar Nota Débito</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="2"
                                        href="javascript:void(0)">Anular</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="1"
                                        href="javascript:void(0)">Duplicar</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="0"
                                        href="javascript:void(0)">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="content_loader" class="d-none">
                        <div class="text-center">
                            <div class="spinner-border" role="status" style="color: #3858f9">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
    </div>

    <!-- Add -->
    <div class="row row-sm d-none" id="div_form_add">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title">Nueva factura de venta</h3>
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
                                        <option value="1">FV-1 Factura Electónica de Venta</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                        placeholder="Fecha elaboración" type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Vendedor</label>
                                    <select class="form-select" id="vendedor_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == auth()->user()->id)
                                                <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Consecutivo</label>
                                    <input id="consecutivo_add" class="form-control"
                                        placeholder="Consecutivo" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <label for="">Cliente</label>
                                    <select class="form-select" id="cliente_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                ({{ $cliente->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_add" placeholder="Contacto"
                                        type="text">
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
                                                            <option value="{{ $producto->id }}">
                                                                {{ $producto->nombre }}
                                                                ({{ $producto->marca }} - {{ $producto->modelo }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_add" cols="30" rows="5"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="7"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" value="1"
                                                        class="form-control text-end cantidad_add" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center d-flex pad-4">
                                                    <input disabled type="text" placeholder="0.00"
                                                        class="form-control text-end total_add input_dinner"
                                                        style="border: 0">
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
                                            <select class="form-select formas_pago_add">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-3 d-flex" style="justify-content: end">
                                            <input type="text" placeholder="0.00"
                                                class="form-control col-8 text-end input_dinner forma_pago_input_add">
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
                                        <div class="col-lg-12 mt-5 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Total Bruto:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_bruto_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Descuentos:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_descuentos_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Subtotal:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_subtotal_add">0.00</p>
                                            </div>
                                        </div>
                                        <div id="impuestos_1_add" style="padding: 0px;"></div>
                                        <div id="impuestos_2_add" style="padding: 0px;"></div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="retefte_add" class="form-control text-end" type="text" title="Rte Fte: (%)" placeholder="Rte Fte: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_retefte_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteiva_add" class="form-control text-end" type="text" title="Rte Iva: (%)" placeholder="Rte Iva: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteiva_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteica_add" class="form-control text-end" type="text" title="Rte Ica: (%)" placeholder="Rte Ica: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteica_add">0.00</p>
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
                                        <p class="font-22" id="total_formas_pago_add">0.00</p>
                                    </div>
                                </div>

                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total Neto:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_neto_add">0.00</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control" id="observaciones_add" placeholder="Observaciones" rows="5"
                                        style="resize: none">VR05 VERSIÓN: 01 06/01/2020
FAVOR CONSIGNAR EN LA CUENTA DE AHORROS BANCOLOMBIA 10825335162 A
NOMBRE DE RADIO ENLACE S.A.S.
Enviar comprobante de pago al correo facturacionelectronica@radioenlacesas.com
Autorretenedores de ICA en el municipio de Medellín según Resolución 202050056223
de 2020
Esta factura de Venta constituye título valor según la Ley 1231 del 17 de Julio de 2008,
El no pago de esta generará intereses por mora
mensual a la tasa máxima legal autorizada. En caso de NO PAGO se procederá a
reportarse en las centrales de crédito.</textarea>
                                </div>

                                <div class="col-lg mt-4">
                                    <label for="">Adjunto</label>
                                    <input class="form-control" accept="application/pdf" id="factura_add"
                                        placeholder="Contacto" type="file">
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" id="btnAddFactura">Guardar Factura</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="row row-sm d-none" id="div_form_edit">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title">Modificar factura de venta</h3>
                        </div>
                        <div class="div-2-tables-header" style="margin-bottom: 13px">
                            <button class="btn btn-primary back_home">x</button>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="card-body" style="margin-top: -18px;">
                            <input type="hidden" disabled readonly id="id_factura_edit">
                            <div class="row row-sm">
                                <div class="col-lg-3">
                                    <label for="">Tipo</label>
                                    <select class="form-select" id="tipo_edit">
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">FV-1 Factura Electónica de Venta</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_edit"
                                        placeholder="Fecha elaboración" type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Vendedor</label>
                                    <select class="form-select" id="vendedor_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == auth()->user()->id)
                                                <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Consecutivo</label>
                                    <input id="consecutivo_edit" class="form-control" value="{{ $num_factura }}" disabled
                                        placeholder="Consecutivo" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <label for="">Cliente</label>
                                    <select class="form-select" id="cliente_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                ({{ $cliente->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_edit" placeholder="Contacto"
                                        type="text">
                                </div>
                            </div>
                            <div class="row row-sm mt-5">
                                <div class="table-responsive">
                                    <table id="tbl_data_detail_edit"
                                        class="table border-top-0 table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Descripción</th>
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
                                                    <select class="form-select producto_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}">
                                                                {{ $producto->nombre }}
                                                                ({{ $producto->marca }} - {{ $producto->modelo }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_edit" cols="30" rows="5"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="7"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" value="1"
                                                        class="form-control text-end cantidad_edit" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center d-flex pad-4">
                                                    <input disabled type="text" placeholder="0.00"
                                                        class="form-control text-end total_edit input_dinner"
                                                        style="border: 0">
                                                    <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                        id="new_row_edit"><i class="fa fa-plus"></i></a>
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
                                            <select class="form-select formas_pago_edit">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-3 d-flex" style="justify-content: end">
                                            <input type="text" placeholder="0.00"
                                                class="form-control col-8 text-end input_dinner forma_pago_input_edit">
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
                                            <div class="text-end col-6">
                                                <p class="font-20">Total Bruto:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_bruto_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Descuentos:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_descuentos_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Subtotal:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_subtotal_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div id="impuestos_1_edit" style="padding: 0px;"></div>
                                        <div id="impuestos_2_edit" style="padding: 0px;"></div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="retefte_edit" class="form-control text-end" type="text" title="Rte Fte: (%)" placeholder="Rte Fte: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_retefte_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteiva_edit" class="form-control text-end" type="text" title="Rte Iva: (%)" placeholder="Rte Iva: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteiva_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteica_edit" class="form-control text-end" type="text" title="Rte Ica: (%)" placeholder="Rte Ica: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteica_edit">0.00</p>
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
                                        <p class="font-22" id="total_formas_pago_edit">0.00</p>
                                    </div>
                                </div>

                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total Neto:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_neto_edit">0.00</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Observaciones</label>
                                    <textarea class="form-control" id="observaciones_edit" placeholder="Observaciones" rows="5"
                                        style="resize: none">VR05 VERSIÓN: 01 06/01/2020
FAVOR CONSIGNAR EN LA CUENTA DE AHORROS BANCOLOMBIA 10825335162 A
NOMBRE DE RADIO ENLACE S.A.S.
Enviar comprobante de pago al correo facturacionelectronica@radioenlacesas.com
Autorretenedores de ICA en el municipio de Medellín según Resolución 202050056223
de 2020
Esta factura de Venta constituye título valor según la Ley 1231 del 17 de Julio de 2008,
El no pago de esta generará intereses por mora
mensual a la tasa máxima legal autorizada. En caso de NO PAGO se procederá a
reportarse en las centrales de crédito.</textarea>
                                </div>

                                <div class="col-lg mt-4">
                                    <label for="">Adjunto</label>
                                    <input class="form-control" accept="application/pdf" id="factura_edit"
                                        placeholder="Contacto" type="file">
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" id="btnEditFactura">Modificar Factura</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Filtros -->
    <div class="modal  fade" id="modalSelectFilter">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Sección de filtros</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Cliente</label>
                            <select class="form-select" id="cliente_select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} -
                                        ({{ $cliente->nit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Estado</label>
                            <select class="form-select" id="estado_select">
                                <option value="">Seleccione una opción</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Pagada</option>
                                <!--<option value="0">Anulada</option>-->
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Producto / Servicio</label>
                            <select class="form-select" id="producto_select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($productos_filtro as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->nombre }}
                                        ({{ $producto->marca }} - {{ $producto->modelo }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Número Factura</label>
                            <input type="number" placeholder="Número Factura" class="form-control" id="num_factura_select">
                        </div>
                        <!--<div class="col-lg">
                            <label for="">Serial (Producto)</label>
                            <input type="number" placeholder="Serial (Producto)" class="form-control"
                                id="serial_factura_select">
                        </div>-->
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Consecutivo Inicio</label>
                            <input type="number" placeholder="Consecutivo Inicio" class="form-control" id="cons_inicio_select">
                        </div>
                        <div class="col-lg">
                            <label for="">Consecutivo Fin</label>
                            <input type="number" placeholder="Consecutivo Fin" class="form-control" id="cons_fin_select">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio_select">
                        </div>
                        <div class="col-lg">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin_select">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Mayor o menor (Días después de la fecha de elaboración)</label>
                            <select class="form-select" id="mayor_menor_select">
                                <option value="">Seleccione una opción</option>
                                <option value="1">Mayor</option>
                                <option value="2">Menor</option>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Días de elaboración</label>
                            <input type="number" placeholder="Día de mora" class="form-control" id="dia_mora_select">
                        </div>
                    </div>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" id="btn_filtrar">Filtrar</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('factura_venta') }}" id="btn_clear">Limpiar filtros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelectFilter" data-bs-toggle="modal"
        data-bs-effect="effect-scale">Filtros</a>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var productos = @json($productos);
            var formas_pago = @json($formas_pago);
            var impuestos_cargos = @json($impuestos_cargos);
            var impuestos_retencion = @json($impuestos_retencion);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
            localStorage.setItem('impuestos_cargos', JSON.stringify(impuestos_cargos));
            localStorage.setItem('impuestos_retencion', JSON.stringify(impuestos_retencion));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/factura_venta.js') }}"></script>
@endsection
