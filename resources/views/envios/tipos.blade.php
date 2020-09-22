@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Selecciona un tipo de envío</h1>
    <div class="row d-flex justify-content-around">
    @foreach($tipos as $tipo)
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('dist/img/') }}/{{ $tipo->nombre }}.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$tipo->nombre}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Peso máximo: {{$tipo->maxweight}} Kg</li>
                <li class="list-group-item">Tamaño Máximo: {{$tipo->maxdim}} m³</li>
            </ul>
            <div class="list-group list-group-flush">
                <a href="{{ route('envio.show',$tipo->id) }}" class="list-group-item active">Comenzar</a>
            </div>
        </div>
@endforeach
</div>
</div>
@endsection