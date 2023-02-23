<!-- row Edit -->
<div class="row row-sm d-none" id="div_organizacion">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table" style="border-radius: 4px; background: hsl(0, 78%, 62%)">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Organización</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img id="img_cliente_edit" class="avatar border rounded-circle" style="width: 10pc; height: 10pc;"
                        src="{{ asset('images/clientes/noavatar.png') }}">
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Tipo Empresa</label>
                        <select id="tipo_empresa_organizacion" class="form-select">
                            <option value="">Seleccione un tipo de cliente</option>
                            @foreach ($tipos_empresas as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Nombre</label>
                        <input class="form-control" id="nombre_organizacion" placeholder="Nombre" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Tipo Documento</label>
                        <select id="tipo_doc_organizacion" class="form-select">
                            <option value="">Seleccione un opción</option>
                            @foreach ($tipos_documentos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Número Documento</label>
                        <input class="form-control" id="documento_organizacion" placeholder="Número Documento"
                            type="text">
                    </div>
                    <div class="col-sm mg-t-10 mg-lg-t-0 d-none">
                        <label for="">Dígito Verificación</label>
                        <input class="form-control" id="digito_verifi_organizacion" placeholder="Dígito Verificación"
                            type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Ciudad</label>
                        <select id="ciudad_organizacion" class="form-select">
                            <option value="">Seleccione un opción</option>
                            @foreach ($ciudades as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item->departamento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Dirección</label>
                        <input class="form-control" id="direccion_organizacion" placeholder="Dirección" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Tipo Régimen</label>
                        <select id="tipo_regimen_organizacion" class="form-select">
                            <option value="">Seleccione un opción</option>
                            @foreach ($tipos_regimenes as $item)
                                <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Teléfono</label>
                        <input class="form-control" id="telefono_organizacion" placeholder="Teléfono" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Contacto</label>
                        <input class="form-control" id="contacto_organizacion" placeholder="Contacto" type="text">
                    </div>
                    <div class="col-lg">
                        <label for="">Correo del contacto</label>
                        <input class="form-control" id="email_contacto_organizacion" placeholder="Correo del contacto"
                            type="email">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Página Web</label>
                        <input class="form-control" id="pagina_web_organizacion" placeholder="Página Web"
                            type="text">
                    </div>
                    <div class="col-lg">
                        <label for="">Logo/Avatar</label>
                        <input class="form-control" id="avatar_organizacion" type="file">
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button class="btn ripple btn-primary" id="btnModificarOrganizacion1" type="button">Actualizar
                        Información</button>
                </div>
                <br>
                <h3 class="card-title mt-2">Datos Fiscales</h3>
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-detail mt-3 tab-card">
                                <div class="card-header tab-card-header" style="border: 1px solid #ccc;">
                                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-1 active" href="javascript:void(0)">
                                                Datos Tributarios
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-2" href="javascript:void(0)">
                                                Representante Legal
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-3" href="javascript:void(0)">
                                                Representante Legal Suplente
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-4" href="javascript:void(0)">
                                                Contador
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-5" href="javascript:void(0)">
                                                Revisor Fiscal
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show p-3 active" id="one_detail">
                                        <br>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Actividad Económica</label>
                                                <select id="actividades_tribu_organizacion" class="form-select"
                                                    multiple="multiple">
                                                    <option value="">Seleccione un opción</option>
                                                    @foreach ($actividades_economicas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->code }} -
                                                            {{ $item->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Tarifa ICA</label>
                                                <input class="form-control" id="ica_tribu_organizacion"
                                                    placeholder="Tarifa ICA" type="number">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Maneja AIU</label>
                                                <select id="maneja_aiu_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Utilizo dos impuestos cargos en la factura de
                                                    venta</label>
                                                <select id="nimpuestos_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Es agente retenedor del impuesto sobre las ventas
                                                    IVA</label>
                                                <select id="retenedor_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Maneja impuesto Ad-Valorem (para industrias de
                                                    licores)</label>
                                                <select id="impuesto_valorem_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Responsabilidades Fiscales</label>
                                                <select id="responsabilidades_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Tributos</label>
                                                <select id="tributos_tribu_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Anexo Dian</label>
                                                <input class="form-control" id="anexo_dian_organizacion" type="file">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion2"
                                                type="button">Actualizar Información</button>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="tab-pane fade show p-3" id="two_detail">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Nombres</label>
                                                <input class="form-control" id="nombres_repre_organizacion"
                                                    placeholder="Nombres" type="text">
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Apellidos</label>
                                                <input class="form-control" id="apellidos_repre_organizacion"
                                                    placeholder="Apellidos" type="text">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Tipo Identificación</label>
                                                <select id="tipo_doc_repre_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    @foreach ($tipos_documentos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Número Documento</label>
                                                <input class="form-control" id="documento_repre_organizacion"
                                                    placeholder="Número Documento" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion3"
                                                type="button">Actualizar Información</button>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="tab-pane fade show p-3" id="three_detail">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Nombres</label>
                                                <input class="form-control" id="nombres_represuple_organizacion"
                                                    placeholder="Nombres" type="text">
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Apellidos</label>
                                                <input class="form-control" id="apellidos_represuple_organizacion"
                                                    placeholder="Apellidos" type="text">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Tipo Identificación</label>
                                                <select id="tipo_doc_represuple_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    @foreach ($tipos_documentos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Número Documento</label>
                                                <input class="form-control" id="documento_represuple_organizacion"
                                                    placeholder="Número Documento" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion4"
                                                type="button">Actualizar Información</button>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="tab-pane fade show p-3" id="four_detail">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Nombres</label>
                                                <input class="form-control" id="nombres_contador_organizacion"
                                                    placeholder="Nombres" type="text">
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Apellidos</label>
                                                <input class="form-control" id="apellidos_contador_organizacion"
                                                    placeholder="Apellidos" type="text">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Tipo Identificación</label>
                                                <select id="tipo_doc_contador_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    @foreach ($tipos_documentos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Número Documento</label>
                                                <input class="form-control" id="documento_contador_organizacion"
                                                    placeholder="Número Documento" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion5"
                                                type="button">Actualizar Información</button>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="tab-pane fade show p-3" id="five_detail">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Nombres</label>
                                                <input class="form-control" id="nombres_revisor_organizacion"
                                                    placeholder="Nombres" type="text">
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Apellidos</label>
                                                <input class="form-control" id="apellidos_revisor_organizacion"
                                                    placeholder="Apellidos" type="text">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Tipo Identificación</label>
                                                <select id="tipo_doc_revisor_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    @foreach ($tipos_documentos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Número Documento</label>
                                                <input class="form-control" id="documento_revisor_organizacion"
                                                    placeholder="Número Documento" type="text">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion6"
                                                type="button">Actualizar Información</button>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
