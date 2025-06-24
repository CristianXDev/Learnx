@extends('sources-curso-pay')


@section('title')

<title>LearnX | Confirmar Pago</title>

@endsection

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">

		<!-- Contenedor Principal -->
		<div id="contenedor-principal" class="d-flex justify-content-center align-content-center mt-5">
			<div class="card p-4" style="width: 23rem;">
				<h5 class="my-3">¿Quieres comprar este curso?</h5>
				<img src="{{ Storage::url($curso->image) }}" class="card-img-top h-50" alt="foto clasroom">
				<div class="card-body">
					<h5 class="card-title">{{ $curso->nombre }}</h5>
					<span class="badge bg-label-primary my-1"></span>
					<p class="card-text">{{ Str::limit($curso->descripcion, 100, '...') }}</p>
					<a href="#" class="btn btn-primary" id="btn-confirmar">Sí, estoy seguro</a>
					<a href="{{ route('dashboard') }}" class="btn btn-secondary">Regresar</a>
				</div>
			</div>
		</div>

		<!-- Contenedor Secundario -->
		<div id="contenedor-secundario" class="d-none d-flex justify-content-center align-content-center mt-5">
			<div class="card p-4" style="width: 23rem;">
				<h5 class="my-3">Selecciona un procesador de pago</h5>
				<div class="card-body">
					<p>Elige tu procesador de pago preferido:</p>

					<div class="mt-2 d-flex align-items-center">
						<div class="w-50">
							<img src="{{ asset('static/assets/img/pay/paypal.png') }}" alt="paypal-logo" class="img-fluid img-thumbnail">
						</div>
						<div class="w-50 mx-3">
							<a href="{{ route('curso-paypal',['id' => $curso->id ]) }}" class="btn btn-primary">Comprar: {{ $curso->precio }}$</a>
						</div>
					</div>



					<button class="btn btn-secondary" id="btn-regresar-secundario">Regresar</button>
				</div>
			</div>
		</div>


		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				const btnConfirmar = document.getElementById('btn-confirmar');
				const contenedorPrincipal = document.getElementById('contenedor-principal');
				const contenedorSecundario = document.getElementById('contenedor-secundario');
				const btnRegresarSecundario = document.getElementById('btn-regresar-secundario');

  // Evento para mostrar el contenedor secundario
				btnConfirmar.addEventListener('click', function(event) {
    event.preventDefault(); // Evitar el comportamiento por defecto del enlace
    contenedorPrincipal.classList.add('d-none'); // Ocultar contenedor principal
    contenedorSecundario.classList.remove('d-none'); // Mostrar contenedor secundario
});

  // Evento para regresar al contenedor principal
				btnRegresarSecundario.addEventListener('click', function() {
    contenedorSecundario.classList.add('d-none'); // Ocultar contenedor secundario
    contenedorPrincipal.classList.remove('d-none'); // Volver a mostrar contenedor principal
});
			});

		</script>

	</div>
</div>
<!-- / Content -->

@endsection