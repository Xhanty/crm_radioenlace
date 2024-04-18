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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Conciliación Bancaria</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm" id="show_list_excel">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Listado de conciliaciones bancarias</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Nueva Conciliación</button>

                            <a href="{{ route('excel_factura_venta') }}" style="margin-right: 10px">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="34" height="34"
                                    viewBox="0 0 48 48">
                                    <path fill="#4CAF50"
                                        d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                                    <path fill="#FFF"
                                        d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z">
                                    </path>
                                    <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                                    <path fill="#FFF"
                                        d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z">
                                    </path>
                                </svg></a>
                            <a href="{{ route('pdf_factura_venta_export') }}" target="_blank" style="margin-right: 10px">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    height="30px" width="30px" version="1.1" id="Layer_1"
                                    viewBox="0 0 303.188 303.188" xml:space="preserve">
                                    <g>
                                        <polygon style="fill:#E8E8E8;"
                                            points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525  " />
                                        <path style="fill:#FB3449;"
                                            d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936   c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202   c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251   c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594   c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603   c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02   c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024   c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387   c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205   c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119   c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57   C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041   c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065   c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918   c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985   c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993   c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883   c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265   c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197   c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z    M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542   c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275   c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z" />
                                        <polygon style="fill:#FB3449;"
                                            points="227.64,25.263 32.842,25.263 32.842,0 219.821,0  " />
                                        <g>
                                            <path style="fill:#A4A9AD;"
                                                d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643    v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z     M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857    h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z" />
                                            <path style="fill:#A4A9AD;"
                                                d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979    h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324    c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43    C160.841,257.523,161.76,254.028,161.76,249.324z" />
                                            <path style="fill:#A4A9AD;"
                                                d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374    L196.579,273.871L196.579,273.871z" />
                                        </g>
                                        <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0  " />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-20p border-bottom-0">Elaborada Por</th>
                                        <th class="wd-20p border-bottom-0">Mes</th>
                                        <th class="wd-15p border-bottom-0">Año</th>
                                        <th class="wd-15p border-bottom-0">Saldo Final</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($conciliaciones as $conciliacion)
                                        @php
                                            $bgcolor = '';

                                            if ($conciliacion->visto_bueno == 1) {
                                                $bgcolor = 'style="background-color: #c3e6cb"';
                                            } else {
                                                $bgcolor = 'style="background-color: #f5c6cb"';
                                            }

                                            // Pasar los meses a texto
                                            $mes = '';
                                            switch ($conciliacion->mes) {
                                                case 1:
                                                    $mes = 'Enero';
                                                    break;
                                                case 2:
                                                    $mes = 'Febrero';
                                                    break;
                                                case 3:
                                                    $mes = 'Marzo';
                                                    break;
                                                case 4:
                                                    $mes = 'Abril';
                                                    break;
                                                case 5:
                                                    $mes = 'Mayo';
                                                    break;
                                                case 6:
                                                    $mes = 'Junio';
                                                    break;
                                                case 7:
                                                    $mes = 'Julio';
                                                    break;
                                                case 8:
                                                    $mes = 'Agosto';
                                                    break;
                                                case 9:
                                                    $mes = 'Septiembre';
                                                    break;
                                                case 10:
                                                    $mes = 'Octubre';
                                                    break;
                                                case 11:
                                                    $mes = 'Noviembre';
                                                    break;
                                                case 12:
                                                    $mes = 'Diciembre';
                                                    break;
                                            }
                                        @endphp
                                        <tr {!! $bgcolor !!}>
                                            <td>{{ $conciliacion->empleado }}</td>
                                            <td>{{ $mes }}</td>
                                            <td>{{ $conciliacion->anio }}</td>
                                            <td>{{ $conciliacion->saldo_final }}</td>
                                            <td>
                                                <a href="javascript:void(0);" title="Visualizar"
                                                    data-id="{{ $conciliacion->id }}" class="btn btn-primary btnView"><i
                                                        class="fas fa-eye"></i></a>
                                                @if ($conciliacion->visto_bueno == 0)
                                                    <a href="javascript:void(0);" title="Aprobar"
                                                        data-id="{{ $conciliacion->id }}"
                                                        class="btn btn-success btnCompletar"><i
                                                            class="fas fa-check"></i></a>
                                                @else
                                                    <a href="javascript:void(0);" title="Desaprobar"
                                                        data-id="{{ $conciliacion->id }}"
                                                        class="btn btn-danger btnDesaprobar"><i
                                                            class="fas fa-times"></i></a>
                                                @endif
                                                <a href="javascript:void(0);" title="Modificar"
                                                    data-id="{{ $conciliacion->id }}" class="btn btn-warning btnEdit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="javascript:void(0);" title="Eliminar"
                                                    data-id="{{ $conciliacion->id }}" class="btn btn-danger btnDelete"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Content Add Excel -->
        <div class="row row-sm d-none" id="show_content_excel">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Listado desde el excel</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <a class="btn btn-primary" id="newRowAdd">Añadir</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- basic-datatable-t -->
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="excelTable">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Debito</th>
                                        <th>Crédito</th>
                                        <th>Saldo</th>
                                        <!--<th>Dcto.</th>-->
                                        <th>Cliente</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <div class="text-center d-flex">
                                <div class="col-lg">
                                    <a class="btn btn-warning" href="{{ route('conciliacion_bancaria') }}">Regresar</a>
                                </div>
                                <div class="col-lg">
                                    <button class="btn btn-primary" id="btnGuardarExcel">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Edit Excel -->
        <div class="row row-sm d-none" id="edit_content_excel">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Listado desde el excel</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <a class="btn btn-primary" id="newRowEdit">Añadir</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- basic-datatable-t -->
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="excelTableEdit">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Debito</th>
                                        <th>Crédito</th>
                                        <th>Saldo</th>
                                        <!--<th>Dcto.</th>-->
                                        <th>Cliente</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <div class="text-center d-flex">
                                <div class="col-lg">
                                    <a class="btn btn-warning" href="{{ route('conciliacion_bancaria') }}">Regresar</a>
                                </div>
                                <div class="col-lg">
                                    <button class="btn btn-primary" id="btnModificarExcel">Modificar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content View Excel -->
        <div class="row row-sm d-none" id="view_content_excel">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Listado desde el excel</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <!--<a class="btn btn-primary" id="newRowAdd">Añadir</a>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- basic-datatable-t -->
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="excelTableView">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Debito</th>
                                        <th>Crédito</th>
                                        <th>Saldo</th>
                                        <!--<th>Dcto.</th>-->
                                        <th>Cliente</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                            <div class="text-center d-flex">
                                <div class="col-lg">
                                    <a class="btn btn-warning" href="{{ route('conciliacion_bancaria') }}">Regresar</a>
                                </div>
                                <div class="col-lg">
                                    <!--<button class="btn btn-primary" id="btnGuardarExcel">Guardar</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Nueva Conciliación</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Mes</label>
                                <select class="form-select" id="mesadd">
                                    <option value="0">Seleccione</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8" selected>Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Año</label>
                                <input class="form-control" id="anioadd" placeholder="Año de la conciliación"
                                    type="number" value="2023">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Documento (.xlsx) - (Opcional)</label>
                                <input class="form-control" id="exceladd" type="file" accept=".xlsx">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <a target="_blank" href="{{ asset('FormatoConciliacion.xlsx') }}">Descargar formato</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnCargarExcel" type="button">Seleccionar</button>
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
                            <label for="">Año</label>
                            <input type="number" class="form-control" id="anio_select" placeholder="Año">
                        </div>
                        <div class="col-lg">
                            <label for="">Empleado</label>
                            <select class="form-select" id="empleado_select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Fecha Inicio</label>
                            <input type="date" placeholder="Fecha Inicio" class="form-control"
                                id="fecha_inicio_select">
                        </div>
                        <div class="col-lg">
                            <label for="">Fecha Fin</label>
                            <input type="date" placeholder="Fecha Fin" class="form-control" id="fecha_fin_select">
                        </div>
                    </div>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" id="btn_filtrar">Filtrar</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('conciliacion_bancaria') }}" id="btn_clear">Limpiar filtros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelectFilter" data-bs-toggle="modal"
        data-bs-effect="effect-scale">Filtros</a>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'></script>
    <script src="{{ asset('assets/js/app/contabilidad/conciliacion_bancaria.js') }}"></script>
    <script>
        let clientes = @json($clientes);
        // Guardar en localstorage
        localStorage.setItem('clientes', JSON.stringify(clientes));
    </script>
@endsection
