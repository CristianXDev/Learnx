@section('title', __('Examenes Multiples'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de preguntas</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar pregunta">
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar pregunta +
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.examenes-multiples.modals')
				<div class="table-responsive">
					<table class="table table-stripped table-sm">
						<thead class="thead">
							<tr class="text-center"> 
								<th>Pregunta</th>
								<th>Respuesta N°1</th>
								<th>Respuesta N°2</th>
								<th>Respuesta N°3</th>
								<th>Respuesta N°4</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse($examenesMultiples as $row)
							<tr class="text-center">
								<td>{{ $row->pregunta }}</td>
								<td>{{ $row->respuesta_1 }}</td>
								<td>{{ $row->respuesta_2 }}</td>
								<td> @if($row->respuesta_3) {{ $row->respuesta_3 }} @else <i class='bx bx-x text-danger'></i> @endif
								</td>
								<td> @if($row->respuesta_4) {{ $row->respuesta_4 }} @else <i class='bx bx-x text-danger'></i> @endif
								</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bx bx-pencil"></i> Editar </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Examenes Multiple id {{$row->id}}? \nDeleted Examenes Multiples cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bx bx-trash"></i> Borrar </a></li>  
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
					<div class="float-end">{{ $examenesMultiples->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>