<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    ALMACENES DE LA EMPRESA
                </div>
                <p class="mg-b-10"></p>
                <div class="row">
                    <!-- col -->
                    <div class="col-auto mt-4 mt-lg-0">
                        <ul id="tree1">
                            @foreach ($almacenes_sede as $sede)
                                <li><a href="javascript:void(0);">{{ $sede->nombre }}</a>
                                    &nbsp;
                                    <a href="javascript:void(0);" class="btn_SelectAlmacen"
                                        data-nombre="{{ $sede->nombre }}"
                                        data-observaciones="{{ $sede->observaciones }}" data-nivel="1"
                                        data-id="{{ $sede->id }}" title="Seleccionar"><i
                                            class="fa fa-check"></i></a>
                                    @foreach ($sede->almacenes as $almacen)
                                        <ul>
                                            <li style="cursor: pointer;">
                                                {{ $almacen->nombre }}
                                                &nbsp;
                                                <a href="javascript:void(0);" class="btn_SelectAlmacen"
                                                    data-nombre="{{ $almacen->nombre }}" data-nivel="2"
                                                    data-observaciones="{{ $almacen->observaciones }}"
                                                    data-id="{{ $almacen->id }}" title="Seleccionar"><i
                                                        class="fa fa-check"></i></a>
                                                @if (count($almacen->estantes) > 0)
                                                    <ul>
                                                        @foreach ($almacen->estantes as $estante)
                                                            <li style="cursor: pointer;" data-bs-placement="right"
                                                                data-bs-toggle="tooltip-primary" title=""
                                                                data-bs-original-title="{{ $estante->observaciones }}">
                                                                {{ $estante->nombre }} &nbsp;
                                                                <a href="javascript:void(0);" class="btn_SelectAlmacen"
                                                                    data-nombre="{{ $estante->nombre }}"
                                                                    data-observaciones="{{ $estante->observaciones }}"
                                                                    data-nivel="3" data-id="{{ $estante->id }}"
                                                                    title="Seleccionar"><i class="fa fa-check"></i></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /col -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5 d-flex">
                    CLIENTES
                </div>
                <p class="mg-b-10"></p>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-auto mt-4 mt-lg-0">
                        <ul id="tree2">
                            @foreach ($clientes as $cliente)
                                <li><a href="javascript:void(0);">{{ $cliente->razon_social }}</a>
                                    @foreach ($cliente->almacenes as $almacen)
                                        <ul>
                                            <li style="cursor: pointer;">
                                                {{ $almacen->nombre }}
                                                &nbsp;
                                                <a href="javascript:void(0);"class="btn_SelectAlmacen_Cliente"
                                                    data-nombre="{{ $almacen->nombre }}" data-nivel="1"
                                                    data-observaciones="{{ $almacen->observaciones }}"
                                                    data-id="{{ $almacen->id }}" title="Seleccionar"><i
                                                        class="fa fa-check"></i></a>
                                                @if (count($almacen->estantes) > 0)
                                                    <ul>
                                                        @foreach ($almacen->estantes as $estante)
                                                            <li style="cursor: pointer;" data-bs-placement="right"
                                                                data-bs-toggle="tooltip-primary" title=""
                                                                data-bs-original-title="{{ $estante->observaciones }}">
                                                                {{ $estante->nombre }}
                                                                <a href="javascript:void(0);"class="btn_SelectAlmacen_Cliente"
                                                                    data-nombre="{{ $estante->nombre }}"
                                                                    data-observaciones="{{ $estante->observaciones }}"
                                                                    data-nivel="2" data-id="{{ $estante->id }}"
                                                                    title="Seleccionar"><i class="fa fa-check"></i></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /col -->
                </div>
            </div>
        </div>
    </div>
</div>
