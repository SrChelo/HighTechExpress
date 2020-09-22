@extends('layouts.app')

@section('content')
<div class="container">
        <h2>Bienvenido {{$user->name}}</h2>
        @can('Cliente')
            <a href="{{ route('envio.create') }}" class="btn btn-success">Solicita un envío</a>
        @endcan
        @can('Repartidor')
        
        @endcan
        @can('Administrador')
        
        @endcan
</div>
@endsection
