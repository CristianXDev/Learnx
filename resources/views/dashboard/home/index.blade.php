@extends('sources-dashboard')

@section('title')

<title>LearnX | Panel De Control</title>

@endsection


@section('content')

<div class="col-lg-12 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">¡Bienvenido de nuevo {{Auth::User()->name }}! 🎉</h5>
          <p class="mb-4">
            Recuerda revisar todas las funciones, encontrarás todo lo que necesitas para seguir aprendiendo y creciendo. 📚
          </p>
        </div>
      </div>
      <div class="col-sm-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img
          src="{{ asset('static/assets/img/illustrations/man-with-laptop-light.png')}}"
          height="140"
          alt="View Badge User"
          data-app-dark-img="illustrations/man-with-laptop-dark.png"
          data-app-light-img="illustrations/man-with-laptop-light.png"
          />
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-4 mb-4">
  <div class="card">
    <div class="card-body text-center">
      <h4>Analizador de imagen</h4>
      <img src="{{ asset('static/assets/img/others/analisis.gif') }}" width="150" height="150" class="img-fluid">
      <a href="#" data-bs-toggle="modal" data-bs-target="#fotoDataModal" class="btn btn-primary mt-4">Probar Herramienta</a>
    </div>
  </div>
</div>

<!--Foto transcripcion livewire-->
@livewire('foto-transcripcion-ia')

@endsection