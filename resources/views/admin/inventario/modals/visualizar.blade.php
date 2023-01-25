<div class="modal  fade" id="modalVisualizar">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" id="title_prodc_view">Ver Producto</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img id="imagen_view" src="{{ asset('images/productos/noimagen.png') }}"
                        style="width: 150px; height: 150px;" loading="lazy">
                </div>
                <br>

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                                <div class="div-1-tables-header">
                                    <h3 class="card-title mt-2">Lista de Seriales</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t"
                                        id="tbl_seriales_view">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">Serial</th>
                                                <th class="border-bottom-0">Ubicación</th>
                                                <th class="border-bottom-0">Disponible</th>
                                                <th class="border-bottom-0">Status</th>
                                                <th class="border-bottom-0">Acciones</th>
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
                <!-- End Row -->
            </div>
        </div>
    </div>
</div>
