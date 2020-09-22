@extends('layouts.app')
@section('content')
    @switch($role)
      @case('Administrador')
        <div class="jumbotron bg-dark jumbotron-fluid ">
      @break
      @case('Repartidor')
        <div class="jumbotron bg-info jumbotron-fluid">
      @break
      @case('Cliente')
        <div class="jumbotron jumbotron-fluid">
      @break
      @case('Moderador')
        <div class="jumbotron bg-primary jumbotron-fluid">
      @break

    @endswitch
    <div class="container">
    <h1 class="display-4">{{ $user->name }}</h1>
    <h5>{{ $role }}</h5>
    <p class="lead">{{ $user->email }}</p>
  </div>
</div>

@endsection