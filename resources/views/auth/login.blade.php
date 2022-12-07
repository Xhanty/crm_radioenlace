@extends('layouts.app')

@section('content')
    @if(session('user'))
        <script>
            window.location = "{{ route('home') }}";
        </script>
    @endif
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex">
            <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
                <div class="my-auto authentication-pages">
                    <div>
                        <img src="{{ asset('assets/img/brand/logo-white.png') }}" class=" m-0 mb-4" alt="logo">
                        <h5 class="mb-4">Responsive Modern Dashboard &amp; Admin Template</h5>
                        <p class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                            took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
            </div>
            <div class="sign-up-body wd-md-50p">
                <div class="main-signin-header">
                    <h2>Welcome back!</h2>
                    <h4>Please sign in to continue</h4>
                    <form>
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" placeholder="Ingrese su email" type="email" id="email"
                                name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
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