@section('title', __('examenes-quest'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/pregunta.gif') }}" width="44" height="44">
							<h4 class="mt-2">Listado De Preguntas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar pregunta..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">Agregar pregunta +</div>

						<div class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#gemini_multiple">Preguntas por IA <i class="bx bx-planet mx-2"></i></div>
					</div>

				</div>
				
				<div class="card-body">
						@include('livewire.examenes-quest.modals')
				<div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead class="thead">
							<tr> 
								<td>No° pregunta</td> 
								<th>Pregunta</th>
								<th>Respuesta</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@forelse($examenesClasicos as $row)
							<tr>
								<td>#{{ $loop->iteration }}</td> 
								<td>{{ $row->pregunta }}</td>
								<td>{{ $row->respuesta }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Accciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Examenes Clasico id {{$row->id}}? \nDeleted Examenes Clasicos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a></li>  
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
					<div class="float-end">{{-- $examenesClasicos->links() --}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>