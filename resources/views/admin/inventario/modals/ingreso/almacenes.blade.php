<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    ALMACENES
                </div>
                <p class="mg-b-10"></p>
                <div class="row">
                    <!-- col -->
                    <div class="col-auto mt-4 mt-lg-0">
                        <ul id="tree1">
                            @foreach ($almacenes as $key => $almacen)
                                <li><a href="javascript:void(0);">{{ $almacen->nombre }}</a>
                                    @if (count($almacen->almacenes) > 0)
                                        <ul>
                                            @foreach ($almacen->almacenes as $sub2)
                                                <li style="cursor: pointer">{{ $sub2->nombre }}
                                                    &nbsp;
                                                    <a href="javascript:void(0);" class="btn_AlmacenIngreso"
                                                        data-id="{{ $sub2->id }}" title="Seleccionar">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    @if (count($sub2->almacenes) > 0)
                                                        <ul>
                                                            @foreach ($sub2->almacenes as $sub3)
                                                                <li style="cursor: pointer">{{ $sub3->nombre }}
                                                                    &nbsp;
                                                                    <a href="javascript:void(0);"
                                                                        class="btn_AlmacenIngreso"
                                                                        data-id="{{ $sub3->id }}"
                                                                        title="Seleccionar">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                    @if (count($sub3->almacenes) > 0)
                                                                        <ul>
                                                                            @foreach ($sub3->almacenes as $sub4)
                                                                                <li style="cursor: pointer">
                                                                                    {{ $sub4->nombre }}
                                                                                    &nbsp;
                                                                                    <a href="javascript:void(0);"
                                                                                        class="btn_AlmacenIngreso"
                                                                                        data-id="{{ $sub4->id }}"
                                                                                        title="Seleccionar">
                                                                                        <i class="fa fa-check"></i>
                                                                                    </a>
                                                                                    @if (count($sub4->almacenes) > 0)
                                                                                        <ul>
                                                                                            @foreach ($sub4->almacenes as $sub5)
                                                                                                <li
                                                                                                    style="cursor: pointer">
                                                                                                    {{ $sub5->nombre }}
                                                                                                    &nbsp;
                                                                                                    <a href="javascript:void(0);"
                                                                                                        class="btn_AlmacenIngreso"
                                                                                                        data-id="{{ $sub5->id }}"
                                                                                                        title="Seleccionar">
                                                                                                        <i
                                                                                                            class="fa fa-check"></i>
                                                                                                    </a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    @endif
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
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
