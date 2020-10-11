@extends('layouts.app')
@section('content')
<div class="container justify-content-center">
<form method="POST" action="{{ route('updateProfile',$user->id) }}" enctype="multipart/form-data" autocomplete="off">
@csrf
@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <strong>{{ $message }}</strong>
    </div>
@endif
    <div class="row">
        <div class="col-4">
            <div class="row justify-content-center">
                <img src="{{asset('storage/images/'.$user->avatar)}}" id="image" alt="..." class="img-fluid img-thumbnail rounded-circle rounded-sm
                @switch($role)
                    @case('Administrador')
                        border-dark
                    @break
                    @case('Repartidor')
                        border-info
                    @break
                @endswitch" width="250px">
            </div>
            <br>
            <div class="form-row">
                <div class="col">
                    <input type="file" name="file" id="file" accept="image/jpeg,image/jpg,image/png" class="form-control">
                </div>
            </div>
            <br>
            <div class="form-row justify-content-center">
                <div class="form-group">
                    <a href="" class="btn btn-primary btn-lg">Cancelar</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-lg">Guardar Cambios</button>
                </div>
            </div>
        </div>
        <div class="col">
            @switch($role)
                @case('Administrador')
                    <div class="p-3 mb-2 bg-dark text-white ">
                @break
                @case('Repartidor')
                    <div class="p-3 mb-2 bg-info text-white">
                @break
                @case('Cliente')
                    <div class="p-3 mb-2 bg-success">
                @break
            @endswitch
            {{ $role }}
            </div>
            <h4>Datos Personales:</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" autocomplete="off" value="{{ $user->name }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo" autocomplete="off" value="{{ $user->email }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="newPass">Nueva Contraseña</label>
                    <input type="password" name="newPass" id="newPass" class="form-control" placeholder="Nueva Contraseña" autocomplete="off" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="RnewPass">Repetir Nueva Contraseña</label>
                    <input type="password" name="RnewPass" id="RnewPass" class="form-control" placeholder="Repetir Nueva Contraseña" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Antigua Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Antigua Contraseña" autocomplete="off" required>
                </div>
            </div>
            <input type="hidden" name="imag" id="imag">
        </div>
    </div>
</form>
<!-- <form method="POST" action="{{ route('home') }}" enctype="multipart/form-data">
@csrf
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <strong>{{ $message }}</strong>
    </div>
@endif
    <div class="form-group row">
        <label for="file" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input id="file" type="file" name="file" value="" required="required" autocomplete="file" autofocus="autofocus" class="form-control ">
        </div>
    </div>
    <input type="submit" value="Enviar">
</form>
</div> -->
@endsection
@section('scripts')
<script src="{{ asset('js/image.js') }}"></script>
@endsection
