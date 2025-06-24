@section('title', __('Tareas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/tarea.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado de tareas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar tarea..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i>Agregar tarea +
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.tareas.modals')
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Nombre</th>
									<th>Descripcion</th>
									<th>Documento</th>
									<th>Aula</th>
									<th>Fecha Entrega</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($tareas as $row)
								<tr>
									<td>{{ Str::limit($row->nombre, 150, '...') }}</td>
									<td>{{ Str::limit($row->descripcion, 150, '...') }}</td>
									<td>

										@if($row->documento != null)

										<a class="text-primary" href="{{Storage::url($row->documento)}}" target="_blank"><i class='bx bx-file'></i></a>

										@else

										<p class="text-muted"><i class='bx bx-file'></i><i class='bx bx-x text-danger'></i></p>

										@endif

									</td>
									<td>{{ $row->classroom->nombre }}</td>
									<td>{{ \Carbon\Carbon::parse($row->fecha_entrega)->format('d-m-Y') }}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Materia id {{$row->id}}? \nDeleted Materias cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a></li>  
											</ul>
										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center h5 py-3" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $tareas->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>