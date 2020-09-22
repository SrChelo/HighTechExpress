@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('dist/img/') }}/{{ $tipo->nombre }}.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$tipo->nombre}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Peso máximo: {{$tipo->maxweigth}} Kg</li>
                <li class="list-group-item">Tamaño Máximo: {{$tipo->maxdim}} m³</li>
            </ul>
        </div>
    </div>
        <div class="col">
        <form action="/envio" method="POST">
        @csrf
            <div class="form-group row">
                <label for="wight">Weight</label>
                <input type="number" class="form-control" name="weight" id="weight" value="{{$tipo->minweight}}" min="{{$tipo->minweight}}" max="{{$tipo->maxweight}}" step="1" autocomplete="false" aria-describedby="weightHelp" required >
                <small id="weightHelp" class="form-text text-muted">The weight are in kilograms</small>
            </div>
            <div class="form-group row">
                <label for="dim">Dimension</label>
                <input type="number" class="form-control" name="dim" id="dim" value="{{$tipo->mindim}}" min="{{$tipo->mindim}}" max="{{$tipo->maxdim}}" step="0.1" aria-describedby="dimHelp" autocomplete="false" required >
                <small id="dimtHelp" class="form-text text-muted">The dimensions are in m³</small>
            </div>
            <div class="form-group row">
                <label for="placeA">Out Place</label>
                <textarea class="form-control" name="placeA" id="placeA" rows="3"></textarea>
            </div>
            <div class="form-group row">
                <label for="placeB">Arrival Place</label>
                <textarea class="form-control" name="placeB" id="placeB" rows="3"></textarea>
            </div>
            <div class="form-group row">
                <label for="desc">Description</label>
                <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
            </div>
            <input type="hidden" name="tipo" id="tipo" value="{{ $tipo->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>

</div>
@endsection