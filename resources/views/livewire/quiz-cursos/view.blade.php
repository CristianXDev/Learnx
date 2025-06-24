@section('title', __('Quiz Cursos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/quiz.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado de preguntas del quizz</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar pregunta..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">Agregar pregunta +
						</div>
					</div>
				</div>

				<div class="card-body">
					@include('livewire.quiz-cursos.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Pregunta</th>
									<th>Respuesta 1</th>
									<th>Respuesta 2</th>
									<th>Respuesta 3</th>
									<th>Respuesta 4</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($quizCursos as $row)
								<tr>
									<td>{{ $row->pregunta }}</td>
									<td>{{ $row->respuesta_1 }}</td>
									<td>{{ $row->respuesta_2 }}</td>
									<td> @if($row->respuesta_3) {{ $row->respuesta_3 }} @else <i class='bx bx-x text-danger'></i> @endif
									<td> @if($row->respuesta_4) {{ $row->respuesta_4 }} @else <i class='bx bx-x text-danger'></i> @endif
									<td width="90">
											<div class="dropdown">
												<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
													Acciones
												</a>
												<ul class="dropdown-menu">
													<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="bx bx-pencil"></i> Editar </a></li>
													<li><a class="dropdown-item" onclick="confirm('Confirm Delete Modulos Curso id {{$row->id}}? \nDeleted Modulos Cursos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="bx bx-trash"></i> Borrar </a></li>
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
								<div class="float-end">{{ $quizCursos->links() }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>