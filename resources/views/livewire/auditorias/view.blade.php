@section('title', __('Auditorias'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/eye.gif') }}" width="44" height="44">
							<h4 class="mt-2">Listado de auditorias</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif

						<div class="input-group input-group-merge w-50">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search-alt"></i></span>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar registro" />
						</div>

					</div>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Usuario</th>
									<th>Rol</th>
									<th>Descripcion</th>
									<th>Fecha Accion</th>
								</tr>
							</thead>
							<tbody>
								@forelse($auditorias as $row)
								<tr>
									<td>{{ $row->user->name }} {{ $row->user->lastName }}</td>
									<td>
										@if($row->user->rol== 1)
										<span class="badge bg-label-secondary me-1">Administrador</span>

										@elseif($row->user->rol== 3)
										<span class="badge bg-label-primary me-1">Docente</span>

										@else
										<span class="badge bg-label-info me-1">Estudiante</span>
										@endif
									</td>
									<td>{{ $row->descripcion }}</td>
									<td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No se encontraron datos.</td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $auditorias->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>