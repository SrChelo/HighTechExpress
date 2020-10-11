@extends('layouts.app')
@section('content')
<div class="container">
<form method="POST" action="{{url('/usuarios')}}">
@csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input id="name" type="text" name="name" value="" required="required" autocomplete="name" autofocus="autofocus" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input id="email" type="email" name="email" value="" required="required" autocomplete="email" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label for="rol" class="col-md-4 col-form-label text-md-right">Rol</label>
        <div class="col-md-6">
            <select name="rol" id="rol" class="form-control ">
                <option selected disabled>Chose an option</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input id="password" type="password" name="password" required="required" autocomplete="new-password" class="form-control ">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
</form>

</div>
@endsection