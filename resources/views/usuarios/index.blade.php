@extends('layouts.app')
@section('content')
<div class="container justify-content-center">
<h2>Lista de Usuarios <a href="{{ route('usuarios.create') }}"><button type="button" class="btn btn-success float-right">Agregar Usuario</button></a></h2>
@if($search)
<h4>
  @if(count($users) == 0)
  <div class="alert alert-danger" role="alert">No se encontraron resultados para '{{$search}}' </div>
  @else
    <div class="alert alert-primary" role="alert">Los resultados para la búsqueda '{{ $search }}'</div>
  @endif
  
</h4>
@endif
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">Rol</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>@foreach($user->tieneRol() as $rol)
              {{$rol}}
            @endforeach</td>
            <td class="justify-content-center">
            
              <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="justify-content-center">
                <a href="{{ route('usuarios.show',$user->id) }}"><button type="button" class="btn btn-info">Ver</button></a>
                <a href="{{ route('usuarios.edit',$user->id) }}"><button type="button" class="btn btn-primary">Editar</button></a>
                @if (Auth::user()->id === $user->id)
                @else
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary">Eliminar</button>
                @endif
              </form>
            </td>
        </tr>
    @endforeach
  </tbody>  
</table>
{{ $users->links() }}
</div>

@endsection