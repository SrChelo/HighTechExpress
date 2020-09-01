@extends('layouts.app')
@section('content')
<div class="container">
<h3>Editar Usuario: {{$user->name}}</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('usuarios.update',$user->id) }}">
@method('PATCH')
@csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input id="name" type="text" name="name" value="{{ $user->name }}" required="required" autocomplete="name" autofocus="autofocus" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input id="email" type="email" name="email" value="{{ $user->email }}" required="required" autocomplete="email" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label for="rol" class="col-md-4 col-form-label text-md-right">Rol</label>
        <div class="col-md-6">
            <select name="rol" id="rol" class="form-control ">
                @if(!$role->id)
                    <option selected disabled>Chose an option</option>
                @endif
                @foreach($roles as $rol)
                    @if($rol->id == $role->id)
                        <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                    @else
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endif
                @endforeach                
            </select>
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('usuarios.index') }}" ><button type="button" class="btn btn-danger">Cancelar</button></a>
        </div>
    </div>
</form>

</div>
@endsection