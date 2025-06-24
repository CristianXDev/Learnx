@section('title', __('Examenes Clasicos Entregados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
							<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/respuesta.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado De Respuestas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-50 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar Respuesta..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.examenes-clasicos-entregados.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<!--<th>Examenen</th>-->
									<th>Pregunta</th>
									<th>Respuesta</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($examenesClasicosEntregados as $row)
								<tr>
									<!--<td>{{-- $row->examenesEntregado->nombre  --}}</td>-->
									<td>{{ $row->examenesClasico->pregunta }}</td>
									<td>{{ $row->respuesta }}</td>
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
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No data Found </td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $examenesClasicosEntregados->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>