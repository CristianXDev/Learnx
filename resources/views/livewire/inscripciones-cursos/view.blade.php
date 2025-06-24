@section('title', __('Inscripciones Cursos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/certificado.gif') }}" width="50" height="50">
							<h4 class="mt-2">Cursos Inscritos</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar curso..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Curso</th>
									<th>Videos completados</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($inscripcionesCursos as $row)
								<tr>
									<td>{{ $row->curso->nombre }}</td>

									<td>{{ $videosVistos }} / {{$row->videos_total_count}}</td>

									<td width="90" height="65">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">

												<form action="{{ route('certificado_pdf') }}" method="POST">
												<li>
													<button class="dropdown-item" href="#"><i class="bx bxs-file-pdf"></i>Descargar Certificado</button></li>

													<input type="hidden" name="curso_id" value="{{ $row->curso->id }}">

													@csrf
												</form>

												@if($videosVistos == $row->videos_total_count)
												<form action="{{ route('certificado_pdf') }}" method="POST">
												<li>
													<button class="dropdown-item" href="#"><i class="bx bxs-file-pdf"></i>Descargar Certificado</button></li>

													<input type="hidden" name="curso_id" value="{{ $row->curso->id }}">

													@csrf
												</form>
												@else
												<li><a class="dropdown-item">No puedes realizar ninguna acción</a></li>
												@endif
											</ul>
										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No data Found </td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $inscripcionesCursos->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>