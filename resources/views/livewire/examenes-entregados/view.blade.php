@section('title', __('Examenes Entregados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/examen-pendiente.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado de examenes entregados</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-50 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar examen..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.examenes-entregados.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Estudiante</th>
									<th>Examen</th>
									<th>Calificacion</th>
									<th>Fecha Entrega</th>
									<!--<th>Tiempo Entrega</th>-->
									<th>Estatus</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($examenesEntregados as $row)
								<tr>
									<td>{{ $row->user->name }} {{$row->user->lastName}}</td>
									<td>{{ $row->examene->nombre }}</td>
									<td>{{ $row->calificacion }}/100</td>
									<td>{{ $row->fecha_entrega }}</td>
									<!--<td>{{-- $row->tiempo_entrega --}}</td>-->
									<td> 
										@if($row->estatus=='corregido')
										<span class="badge bg-label-success me-1">Corregido</span>
										@elseif($row->estatus=='pendiente')
										<span class="badge bg-label-warning me-1">Pediente</span>
										@else
										<span class="badge bg-label-danger me-1">Rechazado</span>
										@endif
									</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>

											<ul class="dropdown-menu">

												@if( $row->examene->tipo == 'clasico')

												<li><a  href="{{ route('examenes-correction', ['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-file'></i></i> Corregir preguntas </a></li>

												@else

												<li><a  href="{{ route('examenes-correction-multiple', ['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-file'></i></i> Corregir preguntas </a></li>


												@endif


												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-select-multiple'></i></i> Estatus </a></li>
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
						<div class="float-end">{{ $examenesEntregados->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>