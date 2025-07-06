@extends('sources-dashboard')

@section('title')

<title>LearnX | API</title>

@endsection

@section('content')

<div class="container-fluid mb-3">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/curso.gif') }}" width="50" height="50">
							<h4 class="mt-2">Cursos Virtuales</h4>
						</div>

						<a href="{{ route('api-rest') }}" target="_blank" class="btn btn-primary"><i class="bx bx-rocket"></i> Desplegar</a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Estudiante</th>
									<th>Curso</th>
								</tr>
							</thead>
							<tbody>
								@forelse($cursos_online as $row)
								<tr>
									<td>{{ $row->user->name }} {{ $row->user->lastName }}</td>
									<td>{{ $row->curso->nombre }}</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/aula.gif') }}" width="50" height="50">
							<h4 class="mt-2">Cursos Presenciales</h4>
						</div>

						<a href="{{ route('api-rest') }}" target="_blank" class="btn btn-primary"><i class="bx bx-rocket"></i> Desplegar</a>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Estudiante</th>
									<th>Curso</th>
								</tr>
							</thead>
							<tbody>
								@forelse($curso_presencial as $row)
								<tr>
									<td>{{ $row->user->name }} {{ $row->user->lastName }}</td>
									<td>{{ $row->cursoPresencial->nombre }}</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection