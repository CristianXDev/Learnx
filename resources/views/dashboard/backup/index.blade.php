@extends('sources-dashboard')

@section('title')

<title>LearnX | Respaldo</title>

@endsection

@section('content')

<div class="d-flex justify-content-center">

<!--BACKUP-->
<div class="col-md-4 mx-3">
  <div class="card">
    <div class="card-body text-center">
      <h3>Realizar Respaldo</h3>

      <!--IMG-->
      <img src="{{ asset('static/assets/img/others/servidor.gif') }}" class="img-fluid p-3">

      <form action="{{ route('backup-create') }}" method="GET" class="mt-3">
        <button type="submit" class="btn btn-primary">Crear Respaldo</button>
      </form>
    </div>
  </div>
</div>

<div class="col-md-4 mx-3">
  <div class="card">
    <div class="card-body text-center">
      <h3>Cargar Respaldo</h3>

      <!--IMG-->
      <img src="{{ asset('static/assets/img/others/recuperacion.gif') }}" class="img-fluid p-3">

      <form action="{{ route('backup-update') }}" method="GET" class="mt-3">
        <button type="submit" class="btn btn-primary">Cargar Información</button>
      </form>
    </div>
  </div>
</div>

</div>


@endsection