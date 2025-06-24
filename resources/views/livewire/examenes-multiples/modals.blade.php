<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nueva pregunta</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-3">
                        <label for="pregunta">Pregunta</label>
                        <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_1">Primera respuesta (Ingresar aquí la respuesta correcta)</label>
                        <input wire:model="respuesta_1" type="text" class="form-control" id="respuesta_1" placeholder="Respuesta correcta....">@error('respuesta_1') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_2">Segunda respuesta</label>
                        <input wire:model="respuesta_2" type="text" class="form-control" id="respuesta_2" placeholder="Respuesta alternativa...">@error('respuesta_2') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_3">Tercera respuesta (Opcional)</label>
                        <input wire:model="respuesta_3" type="text" class="form-control" id="respuesta_3" placeholder="Respuesta alternativa">@error('respuesta_3') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="respuesta_4">Cuarta resuesta (Opcional)</label>
                        <input wire:model="respuesta_4" type="text" class="form-control" id="respuesta_4" placeholder="Respuesta alternativa">@error('respuesta_4') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Actualizar pregunta</h5>
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
                <label for="respuesta_1">Primera respuesta (Ingresar aquí la respuesta correcta)</label>
                <input wire:model="respuesta_1" type="text" class="form-control" id="respuesta_1" placeholder="Respuesta correcta....">@error('respuesta_1') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="respuesta_2">Segunda respuesta</label>
                <input wire:model="respuesta_2" type="text" class="form-control" id="respuesta_2" placeholder="Respuesta alternativa...">@error('respuesta_2') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="respuesta_3">Tercera respuesta (Opcional)</label>
                <input wire:model="respuesta_3" type="text" class="form-control" id="respuesta_3" placeholder="Respuesta alternativa">@error('respuesta_3') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="respuesta_4">Cuarta resuesta (Opcional)</label>
                <input wire:model="respuesta_4" type="text" class="form-control" id="respuesta_4" placeholder="Respuesta alternativa">@error('respuesta_4') <span class="error text-danger">{{ $message }}</span> @enderror
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
