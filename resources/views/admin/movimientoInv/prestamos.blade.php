@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Movimientos Inventario</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Prestamos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/movimiento_inv/prestamos.js') }}"></script>
@endsection