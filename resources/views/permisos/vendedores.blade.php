<div id="vendedores_div" class="col-lg-8 col-xl-10 div-list-ocult">
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header d-flex" style="border-bottom: 1px #e7e7e7 solid; margin-bottom: 8px">
                <div class="col-12" style="padding: 0px;">
                    <div class="card-title" style="margin-bottom: 0px">Ventas / Cotizaciones</div>
                </div>
            </div>
            <div class="row" style="width: 99%; margin-left: 6px">
                <div class="col-lg-6 col-xl-4 col-md-12 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex">
                                        <div class="settings-main-icon me-4 mt-1"><i class="fa fa-eye"></i>
                                        </div>
                                        <div>
                                            <p class="tx-20 font-weight-semibold d-flex mb-0">Cotizaciones</p>
                                            <p class="tx-13 text-muted mb-0">Visualizar cotizaciones de otros usuarios
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                    <select class="form-select" multiple id="select_usuarios_cotizaciones">
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
