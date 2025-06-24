<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Cargar pregunta</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-3">
                        <label for="pregunta">Pregunta</label>
                        <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_1">Respuesta (Correcta)</label>
                        <input wire:model="respuesta_1" type="text" class="form-control" id="respuesta_1" placeholder="Respuesta 1">@error('respuesta_1') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_2">Respuesta alternativa (Obligatorio)</label>
                        <input wire:model="respuesta_2" type="text" class="form-control" id="respuesta_2" placeholder="Respuesta 2">@error('respuesta_2') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_3">Respuesta alternativa (Opcional)</label>
                        <input wire:model="respuesta_3" type="text" class="form-control" id="respuesta_3" placeholder="Respuesta 3">@error('respuesta_3') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_4">Respuesta alternativa (Opcional)</label>
                        <input wire:model="respuesta_4" type="text" class="form-control" id="respuesta_4" placeholder="Respuesta 4">@error('respuesta_4') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
                <h5 class="modal-title" id="updateModalLabel">Update Quiz Curso</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">
                 <div class="form-group mb-3">
                        <label for="pregunta">Pregunta</label>
                        <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_1">Respuesta (Correcta)</label>
                        <input wire:model="respuesta_1" type="text" class="form-control" id="respuesta_1" placeholder="Respuesta 1">@error('respuesta_1') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_2">Respuesta alternativa (Obligatorio)</label>
                        <input wire:model="respuesta_2" type="text" class="form-control" id="respuesta_2" placeholder="Respuesta 2">@error('respuesta_2') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_3">Respuesta alternativa (Opcional)</label>
                        <input wire:model="respuesta_3" type="text" class="form-control" id="respuesta_3" placeholder="Respuesta 3">@error('respuesta_3') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_4">Respuesta alternativa (Opcional)</label>
                        <input wire:model="respuesta_4" type="text" class="form-control" id="respuesta_4" placeholder="Respuesta 4">@error('respuesta_4') <span class="error text-danger">{{ $message }}</span> @enderror
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
