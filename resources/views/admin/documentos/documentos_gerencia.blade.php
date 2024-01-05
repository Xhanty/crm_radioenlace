@extends('layouts.menu')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
    <div class="main-container container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Documentos Gerencia</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Documentos Gerencia</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div id="fm" style="height: 750px; width: 100%"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection
