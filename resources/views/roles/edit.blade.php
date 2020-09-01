@extends('layouts.app')
@section('content')
<div class="container">
<form method="POST" action="{{ route('roles.update',$role->id) }}">
@method('PATCH')
@csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input id="name" type="text" name="name" value="{{ $role->name }}" required="required" autocomplete="name" autofocus="autofocus" class="form-control ">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="{{ route('roles.index') }}" ><button type="button" class="btn btn-danger">Cancelar</button></a>
        </div>
    </div>
</form>

</div>
@endsection