@extends('sources-errors')

@section('title')

<title>ERROR 404 - Pagina no encontrada | ¡Upps ha ocurrido un error!</title>

@endsection

@section('content')

    <!-- Error -->
        <h2 class="mb-2 mx-2">Página no encontrada :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 Revisa que la ruta a la que intentas ingresar sea correcta.</p>
        <a href="{{route('index')}}" class="btn btn-primary">Volver al inicio</a>
        <div class="mt-3">
          <img src="{{asset('static/assets/img/illustrations/page-misc-error-light.png')}}" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png"/>
        </div>
    <!-- /Error -->

@endsection

