@extends('layouts.app')
@section('content')
@can('Administrador')
    @if($state ?? '')
      <a class="btn btn-primary" href="{{ route('pdf2',$state ?? '') }}">Export to PDF</a>
    @else
      <a class="btn btn-primary" href="{{ route('pdf1') }}">Export to PDF</a>
    @endif
@endcan
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
            <td class="bg-secondary">
            @break
            @case('Denegado')
            <td class="bg-danger">
            @break
            @case('En Camino')
              @can('Cliente')
                @if($envio->reparto != null)
                  <td class="bg-info">
                @else
                    <td class="bg-warning">
                @endif
              @else
              <td class="bg-warning">
              @endcan
            @break
            @case('Terminado')
            <td class="bg-success">
            @break
            @endswitch
            {{$envio->state}}
            </td>
            @can('Administrador')
            <td class="">
            
              <form action="{{ route('denegarAdd', $envio->id) }}" method="POST" class="justify-content-center">
                @csrf
                <button type="submit" class="btn btn-secondary">Denegar</button>
              </form>
            </td>
            <td class="">
            <form action="{{ route('aceptarAdd', $envio->id) }}" method="POST" class="justify-content-center">
                @csrf
                <button type="submit" class="btn btn-secondary">Aceptar</button>
              </form>
            </td>
            @endcan
            @can('Repartidor')
            @if($envio->state != 'Terminado')
            <td class="">
            <form action="{{ route('add', $envio->id) }}" method="POST" class="justify-content-center">
                @csrf
                <button type="submit" class="btn btn-secondary">Añadir al reparto</button>
              </form>
            </td>
            @endif
            @endcan
            </tr>
    @endforeach
  </tbody>  
</table>
@endsection