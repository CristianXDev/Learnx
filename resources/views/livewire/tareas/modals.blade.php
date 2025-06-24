<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear tarea</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control mb-3" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="documento">Documento (Opcional)</label>
                        <input wire:model="documento" type="file" class="form-control" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="classroom_id">Aula</label>
                        <select wire:model="classroom_id" class="form-control" id="classroom_id">
                            <option value="">Seleccione un aula</option>
                            @foreach($classrooms as $row)
                            <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                            @endforeach
                        </select>
                        @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_entrega">Fecha entrega</label>
                        <input wire:model="fecha_entrega" type="date" class="form-control" id="fecha_entrega" placeholder="Fecha Entrega">@error('fecha_entrega') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actulaizar Tarea</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="documento">Documento (Opcional)</label>
                        <input wire:model="documento" type="file" class="form-control" id="documento" placeholder="Documento">@error('documento') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="classroom_id">Aula</label>
                        <select wire:model="classroom_id" class="form-control" id="classroom_id">
                            <option value="">Seleccione un aula</option>
                            @foreach($classrooms as $row)
                            <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                            @endforeach
                        </select>
                        @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_entrega">Fecha entrega</label>
                        <input wire:model="fecha_entrega" type="date" class="form-control" id="fecha_entrega" placeholder="Fecha Entrega">@error('fecha_entrega') <span class="error text-danger">{{ $message }}</span> @enderror
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
