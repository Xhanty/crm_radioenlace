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
            <div class="d-flex my-auto">
			    <div class=" d-flex right-page">
				    <div class="d-flex justify-content-center me-5">
					    <div class="">
						    <span class="d-block">
							    <span class="label">PAGADAS</span>
						    </span>
						    <span class="value" id="txt_valor_completados">
							    $53,000
						    </span>
					    </div>
							<div class="ms-3 mt-2">
						    <span class="sparkline_bar">
                                <canvas width="52" height="30" style="display: inline-block; width: 52px; height: 30px; vertical-align: top;"></canvas>
                            </span>
					    </div>
				    </div>
				    <div class="d-flex justify-content-center">
						<div class="">
							<span class="d-block">
								<span class="label">PENDIENTES</span>
							</span>
							<span class="value" id="txt_valor_pendientes">
								$34,000
							</span>
						</div>
						<div class="ms-3 mt-2">
							<span class="sparkline_bar31">
                                <canvas width="52" height="30" style="display: inline-block; width: 52px; height: 30px; vertical-align: top;"></canvas>
                            </span>
						</div>
					</div>
				</div>
			</div>
        </div>

        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card overflow-hidden project-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="my-auto">
                                <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="me-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z"></path>
                                    <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
                                    <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
                                    <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z"></path>
                                    <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z"></path>
                                </svg>
                            </div>
                            <div class="project-content">
                                <h6>Invoices</h6>
                                <ul>
                                    <li>
                                        <strong>Processing</strong>
                                        <span>5</span>
                                    </li>

                                    <li>
                                        <strong>Paid</strong>
                                        <span>56</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card  overflow-hidden project-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="my-auto">
                                <svg enable-background="new 0 0 438.891 438.891" class="me-4 ht-60 wd-60 my-auto danger" version="1.1" viewBox="0 0 438.89 438.89" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m347.97 57.503h-39.706v-17.763c0-5.747-6.269-8.359-12.016-8.359h-30.824c-7.314-20.898-25.6-31.347-46.498-31.347-20.668-0.777-39.467 11.896-46.498 31.347h-30.302c-5.747 0-11.494 2.612-11.494 8.359v17.763h-39.707c-23.53 0.251-42.78 18.813-43.886 42.318v299.36c0 22.988 20.898 39.706 43.886 39.706h257.04c22.988 0 43.886-16.718 43.886-39.706v-299.36c-1.106-23.506-20.356-42.068-43.886-42.319zm-196.44-5.224h28.735c5.016-0.612 9.045-4.428 9.927-9.404 3.094-13.474 14.915-23.146 28.735-23.51 13.692 0.415 25.335 10.117 28.212 23.51 0.937 5.148 5.232 9.013 10.449 9.404h29.78v41.796h-135.84v-41.796zm219.43 346.91c0 11.494-11.494 18.808-22.988 18.808h-257.04c-11.494 0-22.988-7.314-22.988-18.808v-299.36c1.066-11.964 10.978-21.201 22.988-21.42h39.706v26.645c0.552 5.854 5.622 10.233 11.494 9.927h154.12c5.98 0.327 11.209-3.992 12.016-9.927v-26.646h39.706c12.009 0.22 21.922 9.456 22.988 21.42v299.36z"></path>
                                    <path d="m179.22 233.57c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z"></path>
                                    <path d="m329.16 256.03h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
                                    <path d="m179.22 149.98c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.364-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z"></path>
                                    <path d="m329.16 172.44h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
                                    <path d="m179.22 317.16c-3.919-4.131-10.425-4.363-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.21-0.391-0.411-0.601-0.604z"></path>
                                    <path d="m329.16 339.63h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
                                </svg>
                            </div>
                            <div class="project-content">
                                <h6>Tasks</h6>
                                <ul>
                                    <li>
                                        <strong>Processing</strong>
                                        <span>42</span>
                                    </li>

                                    <li>
                                        <strong>Completed</strong>
                                        <span>23</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card overflow-hidden project-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="my-auto">
                                <svg enable-background="new 0 0 477.849 477.849" class="me-4 ht-60 wd-60 my-auto success" version="1.1" viewBox="0 0 477.85 477.85" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m374.1 385.52c71.682-74.715 69.224-193.39-5.492-265.08-34.974-33.554-81.584-52.26-130.05-52.193-103.54-0.144-187.59 83.676-187.74 187.22-0.067 48.467 18.639 95.077 52.193 130.05l-48.777 65.024c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l47.275-63.044c65.4 47.651 154.08 47.651 219.48 0l47.275 63.044c5.655 7.541 16.353 9.069 23.893 3.413 7.541-5.655 9.069-16.353 3.413-23.893l-48.775-65.024zm-135.54 24.064c-84.792-0.094-153.51-68.808-153.6-153.6 0-84.831 68.769-153.6 153.6-153.6s153.6 68.769 153.6 153.6-68.769 153.6-153.6 153.6z"></path>
                                    <path d="m145.29 24.984c-33.742-32.902-87.767-32.221-120.67 1.521-32.314 33.139-32.318 85.997-8e-3 119.14 6.665 6.663 17.468 6.663 24.132 0l96.546-96.529c6.663-6.665 6.663-17.468 0-24.133zm-106.55 82.398c-12.186-25.516-1.38-56.08 24.136-68.267 13.955-6.665 30.175-6.665 44.131 0l-68.267 68.267z"></path>
                                    <path d="m452.49 24.984c-33.323-33.313-87.339-33.313-120.66 0-6.663 6.665-6.663 17.468 0 24.132l96.529 96.529c6.665 6.663 17.468 6.663 24.132 0 33.313-33.322 33.313-87.338 0-120.66zm-14.08 82.449-68.301-68.301c19.632-9.021 42.79-5.041 58.283 10.018 15.356 15.341 19.371 38.696 10.018 58.283z"></path>
                                    <path d="m238.56 136.52c-9.426 0-17.067 7.641-17.067 17.067v96.717l-47.787 63.71c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l51.2-68.267c2.216-2.954 3.413-6.547 3.413-10.24v-102.4c1e-3 -9.426-7.64-17.067-17.065-17.067z"></path>
                                </svg>
                            </div>
                            <div class="project-content">
                                <h6>Estimates</h6>
                                <ul>
                                    <li>
                                        <strong>Processing</strong>
                                        <span>2</span>
                                    </li>

                                    <li>
                                        <strong>Accepted</strong>
                                        <span>16</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card overflow-hidden project-card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="my-auto">
                                <svg enable-background="new 0 0 512 512" class="me-4 ht-60 wd-60 my-auto warning" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m259.2 317.72h-6.398c-8.174 0-14.824-6.65-14.824-14.824 1e-3 -8.172 6.65-14.822 14.824-14.822h6.398c8.174 0 14.825 6.65 14.825 14.824h29.776c0-20.548-13.972-37.885-32.911-43.035v-33.74h-29.777v33.739c-18.94 5.15-32.911 22.487-32.911 43.036 0 24.593 20.007 44.601 44.601 44.601h6.398c8.174 0 14.825 6.65 14.825 14.824s-6.65 14.824-14.825 14.824h-6.398c-8.174 0-14.824-6.65-14.824-14.824h-29.777c0 20.548 13.972 37.885 32.911 43.036v33.739h29.777v-33.74c18.94-5.15 32.911-22.487 32.911-43.035 0-24.594-20.008-44.603-44.601-44.603z"></path>
                                    <path d="m502.7 432.52c-7.232-60.067-26.092-111.6-57.66-157.56-27.316-39.764-65.182-76.476-115.59-112.06v-46.29l37.89-98.425-21.667-0.017c-6.068-4e-3 -8.259-1.601-13.059-5.101-6.255-4.559-14.821-10.802-30.576-10.814h-0.046c-15.726 0-24.292 6.222-30.546 10.767-4.799 3.487-6.994 5.081-13.041 5.081h-0.027c-6.07-5e-3 -8.261-1.602-13.063-5.101-6.255-4.559-14.821-10.801-30.577-10.814h-0.047c-15.725 0-24.293 6.222-30.548 10.766-4.8 3.487-6.995 5.081-13.044 5.081h-0.027l-21.484-0.017 36.932 98.721v46.117c-51.158 36.047-89.636 72.709-117.47 111.92-33.021 46.517-52.561 98.116-59.74 157.74l-9.304 77.285h512l-9.304-77.284zm-301.06-395.47c4.8-3.487 6.995-5.081 13.045-5.081h0.026c6.07 4e-3 8.261 1.602 13.062 5.101 6.255 4.559 14.821 10.802 30.578 10.814h0.047c15.725 0 24.292-6.222 30.546-10.767 4.799-3.487 6.993-5.081 13.041-5.081h0.026c6.068 5e-3 8.259 1.602 13.059 5.101 2.869 2.09 6.223 4.536 10.535 6.572l-21.349 55.455h-92.526l-20.762-55.5c4.376-2.041 7.773-4.508 10.672-6.614zm98.029 91.89v26.799h-83.375v-26.799h83.375zm-266.09 351.08 5.292-43.947c6.571-54.574 24.383-101.7 54.458-144.07 26.645-37.537 62.54-71.458 112.73-106.5h103.78c101.84 71.198 150.75 146.35 163.29 250.56l5.291 43.948h-444.85z"></path>
                                </svg>
                            </div>
                            <div class="project-content">
                                <h6>Revenue</h6>
                                <ul>
                                    <li>
                                        <strong>Earnings</strong>
                                        <span>$15,425</span>
                                    </li>
                                    <li>
                                        <strong>Expensive</strong>
                                        <span>$8,147</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($view_alert == 1)
        <div class="alert alert-danger mb-4" role="alert">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                    <span class="alert-inner--text"> Quedan pocos números disponibles en la numeración de
                        facturación autorizada por la DIAN</span>
                </div>
                <div>
                    <button class="btn btn-danger btn-sm btnCerrarAlerta">Cerrar</button>
                </div>
            </div>
        </div>
        @elseif($view_alert == 2)
            <div class="alert alert-danger mb-4" role="alert">
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                        <span class="alert-inner--text"> La fecha de vigencia de la numeración de facturación autorizada por la
                            DIAN esta próxima a vencer</span>
                    </div>
                    <div>
                        <button class="btn btn-danger btn-sm btnCerrarAlerta">Cerrar</button>
                    </div>
                </div>
            </div>
        @endif

        @if ($disabled_fv == 1)
            <div class="alert alert-danger mb-4" role="alert">
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                        <span class="alert-inner--text"> La numeración de facturación autorizada por la DIAN esta vencida</span>
                    </div>
                    <div>
                        <button class="btn btn-danger btn-sm btnCerrarAlerta">Cerrar</button>
                    </div>
                </div>
            </div>
        @endif

        
        <!-- /breadcrumb -->
        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Facturas de venta <badge
                                        class="badge" style="background: #007bff; color: white;" id="cant_facturas">{{ count($facturas) }}</badge></h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button @if ($disabled_fv == 1) disabled @endif class="btn btn-primary"
                                    id="btnNew">+</button>
                                <a href="{{ route('excel_factura_venta') }}" style="margin-right: 10px">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="34" height="34" viewBox="0 0 48 48">
                                        <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path><path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path><path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path><path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                                        </svg></a>
                                <a href="{{ route('pdf_factura_venta_export') }}" target="_blank" style="margin-right: 10px">
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
                                @php
                                    $valor_completados = 0;
                                    $valor_pendientes = 0;
                                @endphp
                                @foreach ($facturas as $key => $factura)
                                    @if ($factura->status == 0)
                                        @php
                                            $bg = 'bg-cancel';
                                        @endphp
                                    @elseif($factura->status == 2)
                                        @php
                                            $bg = 'bg-paid';
                                            $valor_completados += $factura->valor_total;
                                        @endphp
                                    @else
                                        @php
                                            $bg = 'bg-pending';
                                            $valor_pendientes += $factura->valor_total;
                                        @endphp
                                    @endif

                                    <div class="media factura_btn {{ $bg }}" data-id="{{ $factura->id }}">
                                        <div class="media-icon">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            @php
                                                $fecha_vencimiento = date('Y-m-d', strtotime($factura->fecha_elaboracion));
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
                                            <h6><span>FERE-{{ $factura->numero }}@if($bg == 'bg-pending')<badge
                                                        class="badge {{ $color }}">{{ $dias_pasados }}</badge>@endif</span>
                                                <span>{{ number_format($factura->valor_total, 2, ',', '.') }}
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
                        <h1 class="invoice-title">FACTURA DE VENTA ELECTRÓNICA</h1>
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
                                    <!--<a class="dropdown-item btn_options_factura" data-id="0" data-opcion="4"
                                        href="javascript:void(0)">Ver Contabilización</a>-->
                                    <!--<a class="dropdown-item btn_options_factura" data-id="0" data-opcion="4"
                                        href="javascript:void(0)">Borrar</a>-->
                                    <a class="dropdown-item btn_options_factura btn_option_nota_credito" data-id="0" data-opcion="3"
                                        href="javascript:void(0)">Aplicar Nota Crédito</a>
                                    <!--<a class="dropdown-item btn_options_factura" data-id="0" data-opcion="2"
                                        href="javascript:void(0)">Anular</a>-->
                                    <a class="dropdown-item btn_options_factura btn_option_duplicar" data-id="0" data-opcion="1"
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
                                                <!--<th class="text-center">Impuesto<br>Retención</th>-->
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
                                                    <input type="text" placeholder="Valor Unitario" value=""
                                                        class="form-control text-end valor_add input_dinner_valor"
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
                                                <!--<td class="pad-4">
                                                    <select class="form-select retencion_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>-->
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
                                        <!--<div class="col-lg-12 d-flex" style="justify-content: end">
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
                                        </div>-->
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
                                                <!--<th class="text-center">Impuesto<br>Retención</th>-->
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
                                                    <input type="text" placeholder="Valor Unitario" value=""
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
                                                <!--<td class="pad-4">
                                                    <select class="form-select retencion_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>-->
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
                                                id="new_row_forma_edit"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div id="list_formas_pago_edit"></div>
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
                                        <!--<div class="col-lg-12 d-flex" style="justify-content: end">
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
                                        </div>-->
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
                                <option value="0">Con nota crédito</option>
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
                            <input type="number" placeholder="Días de elaboración" class="form-control" id="dia_mora_select">
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
            let USDollar = new Intl.NumberFormat('es-ES', {
                style: 'currency',
                currency: 'COP',
            });

            var productos = @json($productos);
            var formas_pago = @json($formas_pago);
            var impuestos_cargos = @json($impuestos_cargos);
            var impuestos_retencion = @json($impuestos_retencion);
            var valor_completados = @json($valor_completados);
            var valor_pendientes = @json($valor_pendientes);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
            localStorage.setItem('impuestos_cargos', JSON.stringify(impuestos_cargos));
            localStorage.setItem('impuestos_retencion', JSON.stringify(impuestos_retencion));

            $("#txt_valor_completados").text("$ " + USDollar.format(valor_completados));
            $("#txt_valor_pendientes").text("$ " + USDollar.format(valor_pendientes));

            $(".sparkline_bar").sparkline([2, 4, 3, 4, 5, 4,5,3,4], {
                type: 'bar',
                height:30,
                width:50,
                barWidth: 4,
                
                barSpacing: 2,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#0bd02b'
            });

            $(".sparkline_bar31").sparkline([2, 4, 3, 4, 5, 4,5,3,4], {
                type: 'bar',
                height:30,
                width:50,
                barWidth:4,
                barSpacing: 2,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#ebcd26',
            });

            $('.btnCerrarAlerta').click(function() {
                $(this).parent().parent().parent().remove();
            });
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/factura_venta.js') }}"></script>
@endsection
