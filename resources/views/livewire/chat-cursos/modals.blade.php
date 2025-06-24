<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Chats Classroom</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="classroom_id"></label>
                        <input wire:model="classroom_id" type="text" class="form-control" id="classroom_id" placeholder="Classroom Id">@error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="usuario_id"></label>
                        <input wire:model="usuario_id" type="text" class="form-control" id="usuario_id" placeholder="Usuario Id">@error('usuario_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="mensaje"></label>
                        <input wire:model="mensaje" type="text" class="form-control" id="mensaje" placeholder="Mensaje">@error('mensaje') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="documento"></label>
                        <input wire:model="documento" type="text" class="form-control" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Actualizar mensaje</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
               <input type="hidden" wire:model="selected_id">

               <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <input wire:model="mensaje" type="text" class="form-control" id="mensaje" placeholder="Mensaje">@error('mensaje') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" wire:click.prevent="update()" class="btn btn-primary">Guardar</button>
    </div>
</div>
</div>
</div>

<!-- Tarea modal -->
<div wire:ignore.self class="modal fade" id="tareaModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel"><strong>Tareas del aula</strong></h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


            @forelse($tareas as $row)

            <div class="w-100 mb-5">
                <div class="card">

                   <div class="card-body px-4">
                    <div class="row">

                        <div class="col-md-4">
                            <img src="{{ asset('static/assets/img/classroom-join/tarea2.jpg') }}" class="img-fluid rounded w-100" style="height:200px;">
                        </div>

                        <div class="col-md-8">

                            <div class="d-flex justify-content-between pt-3">

                                <h5><strong>{{$row->nombre}}</strong></h5>

                                <h5>Entrega: {{ \Carbon\Carbon::parse($row->fecha_entrega)->format('d-m-Y') }}</h5>
                            </div>

                            <p>{{$row->descripcion}}</p>

                            @if($row->documento != null)

                            <a href="{{ Storage::url($row->documento) }}" class="btn btn-primary" target="_blank"><i class='bx bx-file-blank'></i> Descargar documento</a>

                            @endif

                            <a href="#" class="btn btn-success" wire:click="updateTareaId({{$row->id}})" data-bs-toggle="modal" data-bs-target="#entregarTareaDataModal">
                                <i class='bx bx-book-bookmark'></i> Entregar tarea
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        @empty
        <tr>
            <td class="text-center py-3 h5" colspan="100%">No se encontraron datos.</td>
        </tr>
        @endforelse



    </div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </div>
</div>
</div>
</div>


<!-- Estudiantes modal -->
<div wire:ignore.self class="modal fade" id="estudianteModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel"><strong>Miembros del aula</strong></h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="table-responsive">
                <table class="table table table-striped table-sm">
                    <thead class="thead">
                        <tr> 
                            <th>Foto</th> 
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $row)
                        <tr>
                            <td>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up list-unstyled" title="Foto usuario"><img src="{{ $row->user->image ? Storage::url($row->user->image) : asset('static/assets/img/avatars/8.png') }}" alt="foto usuario" class="rounded-circle">
                                </li>
                            </td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->user->lastName }}</td>
                            <td>
                                @if($row->user->rol== 1)
                                <span class="badge bg-label-secondary me-1">Administrador</span>

                                @elseif($row->user->rol== 3)
                                <span class="badge bg-label-primary me-1">Docente</span>

                                @else
                                <span class="badge bg-label-info me-1">Estudiante</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center py-3 h5" colspan="100%">No se encontraron miembros.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>

<!-- Entregar tarea modal -->
<div wire:ignore.self class="modal fade" id="entregarTareaDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Entregar tarea</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
                <form>
                    
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input wire:model="documento" type="file" class="form-control" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="storeTarea()" class="btn btn-primary">Entregar</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.addEventListener('closeModal', () => {
        // Obtén el modal actual abierto
        let modal = document.querySelector('.modal.show');
        if (modal) {
            // Cierra el modal utilizando el método `hide` de Bootstrap
            modal.hide();
        }
    });

  window.addEventListener('tareaSubida', function() {
               $('#entregarTareaDataModal').modal('hide'); // Cerrar el modal 
           });
    
</script>

