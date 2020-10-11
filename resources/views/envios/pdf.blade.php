<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>High Tech Express</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/chart.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('ICON.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<br><br>
<center><h1>Reporte de Envios</h1></center>
<br><br>
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
      <th scope="col">Creation Date</th>
      <th scope="col">Status</th>      
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
            <td>{{$envio->created_at}}</td>
            <td>{{$envio->state}}</td>
            </tr>
    @endforeach
  </tbody>  
</table>
</div>
</body>
</html>