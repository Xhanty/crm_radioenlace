<!-- row Edit -->
<div class="row row-sm d-none" id="div_organizacion">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header d-flex-header-table">
                <div class="div-1-tables-header">
                    <h3 class="card-title mt-2">Organización</h3>
                </div>
                <div class="div-2-tables-header">
                    <button class="btn btn-primary back_to_menu">&times;</button>
                </div>
            </div>
            <div class="card-body" style="margin-top: -18px;">
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
                            <option value="1">Empresa</option>
                            <option value="0">Persona Natural</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Razon Social</label>
                        <input class="form-control" id="nombre_organizacion" placeholder="Razon Social" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Tipo Documento</label>
                        <select id="tipo_doc_organizacion" class="form-select">
                            <option value="">Seleccione un opción</option>
                            <option value="1">Registro Civil</option>
                            <option value="2">Tarjeta de identidad</option>
                            <option value="3">Cédula de ciudadanía</option>
                            <option value="4">Tarjeta de extranjería</option>
                            <option value="5">NIT</option>
                            <option value="6">Pasaporte</option>
                            <option value="7">Documento de identificación extranjero</option>
                            <option value="8">NUIP</option>
                            <option value="9">No obligado a registrarse en RUT PN</option>
                            <option value="10">Permiso especial de permanencia PEP</option>
                            <option value="11">Sin identificación del exterior o para uso definido por la DIAN
                            </option>
                            <option value="12">NIT de otro país/ Sin identificación del exterior (43 medios
                                magnéticos)</option>
                            <option value="13">Salvoconducto de permanencia</option>
                        </select>
                    </div>
                    <div class="col-lg mg-t-10 mg-lg-t-0">
                        <label for="">Documento</label>
                        <input class="form-control" id="documento_organizacion" placeholder="Documento" type="text">
                    </div>
                </div>
                <br>
                <div class="row row-sm">
                    <div class="col-lg">
                        <label for="">Ciudad</label>
                        <select id="ciudad_organizacion" class="form-select">
                            <option value="">Seleccione un opción</option>
                            <option value="1">Medellín</option>
                            <option value="2">Bogotá</option>
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
                            <option value="1">002 - Responble de IVA</option>
                            <option value="2">003 - No Responsable de IVA</option>
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
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade show p-3 active" id="one_detail">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">Actividad Económica</label>
                                                <input class="form-control" id="actividades_tribu_organizacion"
                                                    placeholder="Nombre" type="text">
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
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion2"
                                                type="button">Actualizar Información</button>
                                        </div>
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
                                                    <option value="1">Registro Civil</option>
                                                    <option value="2">Tarjeta de identidad</option>
                                                    <option value="3">Cédula de ciudadanía</option>
                                                    <option value="4">Tarjeta de extranjería</option>
                                                    <option value="5">NIT</option>
                                                    <option value="6">Pasaporte</option>
                                                    <option value="7">Documento de identificación extranjero
                                                    </option>
                                                    <option value="8">NUIP</option>
                                                    <option value="9">No obligado a registrarse en RUT PN</option>
                                                    <option value="10">Permiso especial de permanencia PEP</option>
                                                    <option value="11">Sin identificación del exterior o para uso
                                                        definido por la DIAN
                                                    </option>
                                                    <option value="12">NIT de otro país/ Sin identificación del
                                                        exterior (43 medios
                                                        magnéticos)</option>
                                                    <option value="13">Salvoconducto de permanencia</option>
                                                </select>
                                            </div>
                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label for="">Número Documento</label>
                                                <input class="form-control" id="documento_repre_organizacion"
                                                    placeholder="Número Documento" type="text">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label for="">¿Tienes socios en la empresa?</label>
                                                <select id="socios_repre_organizacion" class="form-select">
                                                    <option value="">Seleccione un opción</option>
                                                    <option value="1">Sí</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn ripple btn-primary" id="btnModificarOrganizacion3"
                                                type="button">Actualizar Información</button>
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
</div>
