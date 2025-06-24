<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Examenes Multiples Entregado</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="examen_entregado_id"></label>
                        <input wire:model="examen_entregado_id" type="text" class="form-control" id="examen_entregado_id" placeholder="Examen Entregado Id">@error('examen_entregado_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="pregunta"></label>
                        <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="respuesta_1"></label>
                        <input wire:model="respuesta_1" type="text" class="form-control" id="respuesta_1" placeholder="Respuesta 1">@error('respuesta_1') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Corregir respuesta</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
               <input type="hidden" wire:model="selected_id">
               <div class="form-group">
                <label for="estatus">Estatus</label>
                <select wire:model="estatus" class="form-control" id="estatus">
                    <option value="correcto">Correcto</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="incorrecto">Incorrecto</option>
                </select>
                @error('estatus')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
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
