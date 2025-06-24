@section('title', __('Videos Cursos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="d-flex justify-content-start">
							<img src="{{ asset('static/assets/img/others/video.gif') }}" width="44" height="44">
							<h4 class="mt-2">Listado De Videos</h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div class="w-25 input-group input-group-merge">
							<span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>

							<input type="text" wire:model='keyWord' class="form-control" placeholder="Buscar video..." aria-label="Search..." aria-describedby="basic-addon-search31" name="search" id="search"/>
						</div>
						<div class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i>  Agregar video +
						</div>
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.videos-cursos.modals')
					<div class="table-responsive">
						<table class="table table table-striped table-sm">
							<thead class="thead">
							<tr> 
								<th>Video</th>
								<th>Titulo</th>
								<th>Vistas</th>
								<th>Like</th>
								<th>Dislike</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse($videosCursos as $row)
							<tr>
								<td>
									<img src="{{ asset('static/assets/img/others/videollamada.gif') }}" class="avatar avatar-xs pull-up rounded-circle" data-bs-toggle="modal" data-bs-target="#videoModal" data-bs-placement="top" wire:click="edit({{$row->id}})">
									</td>
									<td>{{ $row->titulo }}</td>
									<td>{{ $row->vistas }}</td>
									<td>{{ $row->likes_count }}</td>
									<td>{{ $row->dislikes_count }}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Acciones
											</a>
											<ul class="dropdown-menu">
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Videos Curso id {{$row->id}}? \nDeleted Videos Cursos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i>  Borrar </a></li>  
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
						<div class="float-end">{{-- $videosCursos->links() --}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>