@extends('layouts.app')
@section('content')
<div class="container justify-content-center">
<h2>Lista de Roles <a href="{{ route('roles.create') }}"><button type="button" class="btn btn-success float-right">Agregar Role</button></a></h2>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($roles as $rol)
        <tr>
            <th scope="row">{{$rol->id}}</th>
            <td>{{$rol->name}}</td>
            <td class="justify-content-center">
              <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" class="justify-content-center">
                <a href="{{ route('roles.edit',$rol->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Eliminar</button>
              </form>
            </td>
        </tr>
    @endforeach
  </tbody>  
</table>
</div>

@endsection