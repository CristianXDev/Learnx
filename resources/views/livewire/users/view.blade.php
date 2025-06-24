@section('title', __('Users'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/user.gif') }}" width="48" height="48">
							<h4 class="mt-2 mx-2">Listado de usuarios</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="input-group input-group-merge w-50">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search-alt"></i></span>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar usuario..." />
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.users.modals')					
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Foto</th> 
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Cédula</th>
									<th>Correo</th>
									<th>Estatus</th>
									<th>Rol</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($users as $row)
								<td>
									<li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up list-unstyled" title="Foto usuario"><img src="{{ $row->image ? Storage::url($row->image) : asset('static/assets/img/avatars/8.png') }}" alt="foto usuario" class="rounded-circle">
									</li>
								</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->lastName }}</td>
								<td>{{ $row->cedula }}</td>
								<td>{{ $row->email }}</td>
								<td>
									@if($row->estatus=='activo')
									<span class="badge bg-label-success me-1">Activo</span>

									@elseif($row->estatus=='pendiente')
									<span class="badge bg-label-warning me-1">Pendiente</span>

									@else
									<span class="badge bg-label-danger me-1">Inactivo</span>
									@endif
								</td>

								<td>
									@if($row->rol== 1)
									<span class="badge bg-label-secondary me-1">Administrador</span>

									@elseif($row->rol== 3)
									<span class="badge bg-label-primary me-1">Docente</span>

									@else
									<span class="badge bg-label-info me-1">Estudiante</span>
									@endif
								</td>

								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bx bx-cog"></i> Gestionar usuario</a>
											</li> 
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
					<div class="float-end">{{ $users->links() }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>