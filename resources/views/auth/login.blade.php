@extends('layouts.app')

@section('content')
    <style>
        .page-signin-style:before {
            background: linear-gradient(45deg, rgb(65, 65, 65), #DA251D) !important;
        }
    </style>
    @if (session('user'))
        <script>
            window.location = "{{ route('home') }}";
        </script>
    @endif
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
                <div class="my-auto authentication-pages">
                    <div>
                        <img src="{{ asset('assets/img/brand/logo.png') }}" class=" m-0 mb-4" alt="logo">
                    </div>
                </div>
            </div>
            <div class="sign-up-body wd-md-50p">
                <div class="main-signin-header">
                    <h2>CRM | Radio Enlace</h2>
                    <h4>Por favor inicie sesión para continuar</h4>
                    <form>
                        @csrf
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input class="form-control" placeholder="Ingrese su correo electrónico" type="email"
                                id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input class="form-control" placeholder="Ingrese su contraseña" type="password" id="password"
                                name="password">
                        </div>
                        <button type="button" id="btn_login" class="btn btn-primary btn-block">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).keyup(function(event) {
            if (event.which === 13) {
                $("#btn_login").click();
            }
        });
    </script>
@endsection
