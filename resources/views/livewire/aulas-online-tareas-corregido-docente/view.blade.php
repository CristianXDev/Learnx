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
						<div class="w-50 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar aulas..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
					</div>
				</div>
				
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Foto</th>
									<th>Nombre</th>
									<th>Materia</th>
									<th>Tareas</th>
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
									<td>{{ $row->tareas_count }}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="{{ route('tareas-docente-corregido',['id'=>$row->id]) }}"><i class='bx bx-list-ul'></i> Listado de tareas</a></li>
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