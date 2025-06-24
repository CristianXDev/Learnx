@extends('sources-dashboard')


@section('title')

<title>LearnX | Configuración del perfil</title>

@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<h5 class="card-header">Detalles del perfil</h5>
			<!-- Account -->
			<div class="card-body">

				<form method="POST" action="{{ route('profile_photo') }}" enctype="multipart/form-data">

					<div class="d-flex align-items-start align-items-sm-center gap-4">
						<img
						src="{{ Auth::User()->image ? Storage::url(Auth::User()->image) : asset('static/assets/img/avatars/8.png') }}"
						alt="user-avatar"
						class="d-block rounded"
						height="100"
						width="100"
						id="uploadedAvatar"
						/>
						<div class="button-wrapper">

							<label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
								<span class="d-none d-sm-block">Seleccionar foto</span>
								<i class="bx bx-upload d-block d-sm-none"></i>
								<input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="image"/>
							</label>
							<button type="submit" class="btn btn-success account-image-reset mb-4">
								<i class="bx bx-reset d-block d-sm-none"></i>
								<span class="d-none d-sm-block">Actualizar</span>
							</button>

							<p class="text-muted mb-0">Permitido formatos JPG, GIF o PNG. De maximo 800kb</p>

							@csrf

							<input type="hidden" name="id" value="{{ Auth::User()->id }}">

						</div>
					</form>
				</div>
			</div>
			<hr class="my-0" />
			<div class="card-body">
				<div id="formAccountSettings">

					<form method="POST" action="{{ route('profile_update') }}">

						<div class="col-md-12">
							<h3 class=" py-3">Mi información</h3>
						</div>

						<div class="row">
							<div class="mb-3 col-md-6">
								<label for="firstName" class="form-label">Primer nombre</label>
								<input
								class="form-control"
								type="text"
								id="firstName"
								name="name"
								value="{{ Auth::User()->name }}"
								autofocus
								placeholder="Nombre..."
								/>
							</div>
							<div class="mb-3 col-md-6">
								<label for="lastName" class="form-label">Apellido</label>
								<input class="form-control" type="text" name="lastname" id="lastName" value="{{ Auth::User()->lastName }}" placeholder="Apellido..." />
							</div>
							<div class="mb-3 col-md-6">
								<label for="number" class="form-label">Cédula</label>
								<input
								class="form-control"
								type="text"
								value="{{ Auth::User()->cedula }}"
								disabled
								/>
							</div>
							<div class="mb-3 col-md-6">
								<label for="email" class="form-label">Correo Electronico</label>
								<input
								class="form-control"
								type="email"
								id="email"
								name="email"
								value="{{ Auth::User()->email }}"
								placeholder="john.doe@example.com"
								/>
							</div>
							<div class="mb-3 col-md-6">
							</div>

							<div class="mt-2">
								<input type="submit" class="btn btn-primary me-2" value="Guardar Cambios">
								<a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancelar</a>
							</div>

							<input type="hidden" name="id" value="{{ Auth::User()->id }}">

							@csrf

						</form>

						<div class="col-md-12 text-center">

							<form method="POST" action="{{ route('profile_update_password') }}">
								<hr>
								<h3 class=" py-3">Cambio de Contraseña</h3>
							</div>

							<div class="mb-3 col-md-6">
								<label for="address" class="form-label">Contraseña actual</label>
								<input type="password" class="form-control" id="address" name="current_password" placeholder="********" />
							</div>
							<div class="mb-3 col-md-6">
								<label for="address" class="form-label">Contraseña nueva</label>
								<input type="password" class="form-control" id="address" name="new_password" placeholder="********" />
							</div>
						</div>
						<div class="mt-2">
							<button type="submit" class="btn btn-primary me-2">Cambiar contraseña</button>
						</div>

						@csrf

						<input type="hidden" name="id" value="{{ Auth::User()->id }}">

					</form>
				</div>
			</div>
			<!-- /Account -->
		</div>
	</div>
</div>
<!-- / Content -->

@endsection