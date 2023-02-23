<!-- row Edit -->
<div class="row row-sm d-none" id="div_ciudades">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(34, 97%, 64%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Ciudades</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Departamento</label>
                        <select class="form-select" id="departamento_add_ciudad">
                            <option value="">Seleccione una opción</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Ciudad</label>
                        <input class="form-control" id="ciudad_add_ciudad" placeholder="Ciudad" type="text">
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnAddCiudad" type="button">Agregar Ciudad</button>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="tbl_ciudades" class="table border-top-0 table-bordered text-nowrap border-bottom">
                        <thead>
                            <tr>
                                <th>Departamento</th>
                                <th>Ciudad</th>
                                <th>Creador</th>
                                <th>Fecha</th>
                                <th>Status</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
