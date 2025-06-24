@section('title', __('Cursos'))

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/curso.gif') }}" width="50" height="50">
							<h4 class="mt-2">Listado De Cursos</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar curso..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i> Agregar curso +
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.cursos.modals')
					<div class="table-responsive">
						<table class="table table-striped table-sm">
							<thead class="thead">
								<tr> 
									<th>Foto</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Precio</th>
									<th>Estatus</th>
									<th>Calificacion</th>
									<th>Categoria</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse($cursos as $row)
								<tr>
									<td>
										<img src="{{ Storage::url($row->image) }}" alt="foto aula" class="avatar avatar-xs pull-up rounded-circle">
									</td>
									<td>{{ $row->nombre }}</td>
									<td>
										@if($row->tipo=='premium')
										<span class="badge bg-label-secondary me-1">Premium</span>
										@else
										<span class="badge bg-label-warning me-1">Gratis</span>
										@endif
									</td>
									<td>{{ $row->precio }}$</td>
									<td>
										@if($row->estatus=='activo')
										<span class="badge bg-label-primary me-1">Activo</span>
										@else
										<span class="badge bg-label-warning me-1">Inactivo</span>
										@endif
									</td>
									<td>
									  @php
							            $promedioCalificacion = $row->calificacionCurso->first()->promedio_calificacion ?? 0;
							            $promedioCalificacionRedondeado = round($promedioCalificacion);
							          @endphp

									   @if($promedioCalificacion > 0)
									      @for ($i = 0; $i < 5; $i++)
									            @if ($i < $promedioCalificacionRedondeado)
									                <i class="bx bxs-star text-warning"></i>
									            @else
									                <i class="bx bx-star"></i>
									            @endif
									       @endfor
									    @else
									       
									    @for ($i = 0; $i < 5; $i++)
									    
									    <i class="bx bxs-star text-secondary"></i>
									    @endfor

									    @endif
									</td>

									<td><span class="badge bg-label-success me-1">{{ $row->categoria->nombre }}</span></td>
									<td width="90" height="100">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a href="{{ route('curso-online-miembros',['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-group'></i> Miembros unidos</a></li>
												<li><a href="{{ route('modulos_cursos',['id' => $row->id]) }}" class="dropdown-item"><i class='bx bx-package'></i>  Agregar modulo </a></li>
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Curso id {{$row->id}}? \nDeleted Cursos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a></li>  
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
						<div class="float-end">{{ $cursos->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>