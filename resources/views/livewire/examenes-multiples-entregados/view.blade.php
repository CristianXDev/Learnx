@section('title', __('Examenes Multiples Entregados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de respuestas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-50">
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar respuesta">
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.examenes-multiples-entregados.modals')
					<div class="table-responsive">
						<table class="table table-stripped table-sm">
							<thead class="thead">
								<tr> 
									<th>Pregunta</th>
									<th>Respuesta</th>
									<th>Estatus</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>
								@forelse($examenesMultiplesEntregados as $row)
								<tr>
									<td>{{ $row->pregunta }}</td>
									<td>{{ $row->respuesta_1 }}</td>
									<td>
										@if($row->estatus=='correcto')
										<span class="badge bg-label-success me-1">Correcto</span>
										@elseif($row->estatus=='incorrecto')
										<span class="badge bg-label-danger me-1">Incorrecto</span>
										@else
										<span class="badge bg-label-warning me-1">Pendiente</span>
										@endif
									</td>

									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-check'></i> / <i class='bx bx-x' ></i> Corregir</a></li>
											</ul>
										</div>								
									</tr>
									@empty
									<tr>
										<td class="text-center" colspan="100%">No data Found </td>
									</tr>
									@endforelse
								</tbody>
							</table>						
							<div class="float-end">{{ $examenesMultiplesEntregados->links() }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>