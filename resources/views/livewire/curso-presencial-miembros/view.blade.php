@section('title', __('Aulas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>Listado de miembros unido a este curso</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-50">
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar aulas...">
						</div>
					</div>
				</div>
				
				<div class="card-body">
					
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Foto</th> 
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Rol</th>
									<th>Fecha de ingreso</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($miembros as $row)
								<tr>
									<td>
										<li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up list-unstyled" title="Foto usuario"><img src="{{ $row->user->image ? Storage::url($row->user->image) : asset('static/assets/img/avatars/8.png') }}" alt="foto usuario" class="rounded-circle">
										</li>
									</td>
									<td>{{ $row->user->name }}</td>
									<td>{{ $row->user->lastName }}</td>
									<td>{{ $row->user->email }}</td>
									<td>
										@if($row->user->rol== 1)
										<span class="badge bg-label-secondary me-1">Administrador</span>

										@elseif($row->user->rol== 3)
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
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Classroom id {{$row->id}}? \nDeleted Classrooms cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->user->id}})"><i class='bx bx-x'></i> Expulsar</a></li>
											</ul>
										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<!--<div class="float-end">{{-- $miembros->links() --}}</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>