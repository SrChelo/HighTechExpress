@extends('layouts.app')
@section('content')
    <table class="table table-hover">
  <thead>
    <tr class="bg-dark">
      <th scope="col">ID</th>
      <th scope="col">Tipo</th>
      <th scope="col">Weight</th>
      <th scope="col">Dimension</th>
      <th scope="col">Out Date</th>
      <th scope="col">Arrival Date</th>
      <th scope="col">Out Place</th>
      <th scope="col">Arrival Place</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
      <th scope="col"></th>
      @can('Administrador')
      <th scope="col"></th>
      @endcan
    </tr>
  </thead>
  <tbody>
    @foreach($envios as $envio)
        <tr>
            <th scope="row">{{$envio->id}}</th>
            <td>{{$envio->nombre}}</td>
            <td>{{$envio->weight}}</td>
            <td>{{$envio->dimen}}</td>
            <td>{{$envio->date_a}}</td>
            <td>{{$envio->date_b}}</td>
            <td>{{$envio->place_a}}</td>
            <td>{{$envio->place_b}}</td>
            <td>{{$envio->description}}</td>
            @switch($envio->state)
            @case('En Espera')
            <td class="bg-info">
            @break
            @case('Denegado')
            <td class="bg-danger">
            @break
            @case('En Camino')
            <td class="bg-warning">
            @break
            @case('Reprogramado')
            <td class="bg-primary">
            @break
            @case('Terminado')
            <td class="bg-success">
            @break
            @endswitch{{$envio->state}}
            </td>
            <td class="">
            <form action="{{ route('end', $envio->id) }}" method="POST" class="justify-content-center">
                @csrf
                <button type="submit" class="btn btn-secondary">Finalizar</button>
              </form>
            </td>
            <td class="">
            <form action="{{ route('rep', $envio->id) }}" method="POST" class="justify-content-center">
                @csrf
                <button type="submit" class="btn btn-secondary">Reprogramar</button>
              </form>
            </td>
            </tr>
    @endforeach
  </tbody>  
</table>
@endsection