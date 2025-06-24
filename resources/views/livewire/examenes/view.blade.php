@section('title', __('Examenes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/examen.gif') }}" width="44" height="44">
							<h4 class="mt-2">Listado De Examenes</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="input-group input-group-merge w-25">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search-alt"></i></span>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar examen..." />
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i>  Agregar examen +
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.examenes.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Inicio</th>
									<th>Entrega</th>
									<th>Duración</th>
									<th>Estatus</th>
									<th>Materia</th>
									<th>Tema</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($examenes as $row)
								<tr>
									<td>{{ $row->nombre }}</td>
									<td>
										@if($row->tipo=='clasico')
										<span class="badge bg-label-success me-1">Clasico</span>
										@else
										<span class="badge bg-label-info me-1">Multiple</span>
										@endif
									</td>
									<td>{{ \Carbon\Carbon::parse($row->fecha_inicio)->format('d-m-Y') }}</td>
									<td>{{ \Carbon\Carbon::parse($row->fecha_fin)->format('d-m-Y') }}</td>
									<td>{{ $row->lim_tiempo }}m</td>
									<td>
										@if($row->estatus=='activo')
										<span class="badge bg-label-primary me-1">Activo</span>
										@else

										<span class="badge bg-label-warning me-1">Inactivo</span>

										@endif
									</td>
									<td>{{ $row->materia->nombre }}</td>
									<td>{{ $row->submateria->nombre }}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>

											<ul class="dropdown-menu">

												@if($row->tipo=='clasico')

												<li><a href="{{ route('examen-quest', ['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-book'></i>Añadir Pregunta</a></li>

												@else

												<li><a href="{{ route('examen-quest-multi', ['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-book'></i>Añadir Pregunta</a></li>
												
												@endif

												<li><a href="{{ route('examen-join', ['id' => $row->id]) }}" class="dropdown-item" target="_blank"><i class='bx bx-link-alt'></i>Ir al examen</a></li>

												<li>
													<a href="#" 
														class="dropdown-item"
														 onclick="copyUrl('{{ route('examen-join', ['id' => $row->id]) }}'); showMessage();">
														<i class='bx bx-copy'></i> Copiar URL
													</a>
												</li>

												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>

												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Examene id {{$row->id}}? \nDeleted Examenes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a></li>

											</ul>

										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center py-3 h5" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $examenes->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	    function copyUrl(url) {
	        navigator.clipboard.writeText(url).then(function() {
	            // Optional: Show success message
	            console.log('URL copied to clipboard!');
	        }, function(err) {
	            console.error('Failed to copy: ', err);
	        });
	    }

	    function showMessage() {
	        // Show your custom message (e.g., using an alert or a div)
	        alert('URL Copiada!');
	    }
	</script>

</div>