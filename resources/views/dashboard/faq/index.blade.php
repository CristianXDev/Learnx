@extends('sources-dashboard')

@section('title')

<title>LearnX | Ayuda</title>

@endsection


@section('content')

<div class="container-fluid">

  <div class="row">

   <!--VIDEO #1-->
   <div class="col-md-6 text-center mb-4">
    <div class="card h-100">
      <h4 class="text-muted mt-4">Inicio</h4>
      <div class="card-body p-0 ratio ratio-16x9">
        <video class="w-100 h-100" controls>
          <source src="{{ asset('static/assets/img/faq/index.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
          </video>
        </div>
      </div>
    </div>

<!--VIDEO #2-->
<div class="col-md-6 text-center mb-4">
  <div class="card h-100">
    <h4 class="text-muted mt-4">Login / Registro</h4>
    <div class="card-body p-0 ratio ratio-16x9">
      <video class="w-100 h-100" controls>
        <source src="{{ asset('static/assets/img/faq/inicio.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
        </video>
      </div>
    </div>
  </div>

<!--VIDEO #3-->
<div class="col-md-6 text-center mb-4">
  <div class="card h-100">
    <h4 class="text-muted mt-4">Aulas</h4>
    <div class="card-body p-0 ratio ratio-16x9">
      <video class="w-100 h-100" controls>
        <source src="{{ asset('static/assets/img/faq/aulas.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
        </video>
      </div>
    </div>
  </div>

<!--VIDEO #4-->
<div class="col-md-6 text-center mb-4">
  <div class="card h-100">
    <h4 class="text-muted mt-4">Tareas</h4>
    <div class="card-body p-0 ratio ratio-16x9">
      <video class="w-100 h-100" controls>
        <source src="{{ asset('static/assets/img/faq/tareas.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
        </video>
      </div>
    </div>
  </div>

<!--VIDEO #5-->
<div class="col-md-6 text-center mb-4">
  <div class="card h-100">
    <h4 class="text-muted mt-4">Examenes</h4>
    <div class="card-body p-0 ratio ratio-16x9">
      <video class="w-100 h-100" controls>
        <source src="{{ asset('static/assets/img/faq/examenes.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
        </video>
      </div>
    </div>
  </div>

<!--VIDEO #6-->
<div class="col-md-6 text-center mb-4">
  <div class="card h-100">
    <h4 class="text-muted mt-4">Cursos</h4>
    <div class="card-body p-0 ratio ratio-16x9">
      <video class="w-100 h-100" controls>
        <source src="{{ asset('static/assets/img/faq/cursos.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
        </video>
      </div>
    </div>
  </div>

  @if(Auth::User()->rol == 1)

  <!--VIDEO #7-->
  <div class="col-md-6 text-center mb-4">
    <div class="card h-100">
      <h4 class="text-muted mt-4">Administrador</h4>
      <div class="card-body p-0 ratio ratio-16x9">
        <video class="w-100 h-100" controls>
          <source src="{{ asset('static/assets/img/faq/admin.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
          </video>
        </div>
      </div>
    </div>
  </div>
  </div>

  @endif

@endsection