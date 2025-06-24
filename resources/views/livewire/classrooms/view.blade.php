@section('title', __('Classrooms'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/owl.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado de aulas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar aulas..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i> Agregar aula +
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.classrooms.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Foto</th>
									<th>Nombre</th>
									<th>Materia</th>
									<th>Codigo</th>
									<th>Estatus</th>
									<th>Tipo</th>
									<th>Estudiantes</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($classrooms as $row)
								<tr> 
									<td>
										<img src="{{ Storage::url($row->foto) }}" alt="foto aula" class="avatar avatar-xs pull-up rounded-circle">
										</li>
									</td>

									<td>{{ $row->nombre }}</td>
									<td>{{ $row->materia->nombre }}</td>
									<td>#{{ $row->codigo_acceso }}</td>
									<td>
										@if($row->estatus == 'activo')
										<span class="badge bg-label-primary me-1">Activo</span>
										@else
										<span class="badge bg-label-warning me-1">Inactivo</span>
										@endif
									</td>
									<td>
										@if($row->tipo=='publico')
										<span class="badge bg-label-success me-1">Publico</span>
										@else
										<span class="badge bg-label-info me-1">Privado</span>
										@endif
									</td>

									<td><i class="bx bx-user"></i> {{ $row->max_estudiantes }}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Classroom id {{$row->id}}? \nDeleted Classrooms cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a></li>
												<li><a data-bs-toggle="modal" data-bs-target="#estatusDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-check-square'></i> Estatus</a></li> 

												<li><a class="dropdown-item" wire:click="changeCode({{$row->id}})"><i class='bx bx-rotate-right'></i> Generar nuevo código</a></li> 
											</ul>
										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center h5 pd-3" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $classrooms->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('script')

<script type="module">
	const addModal = new bootstrap.Modal('#estatusDataModal');
	window.addEventListener('closeModal', () => {
		addModal.hide();
	})
</script>

@endsection