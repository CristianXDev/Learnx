<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Examenes Entregado</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="estudiante_id"></label>
                        <input wire:model="estudiante_id" type="text" class="form-control" id="estudiante_id" placeholder="Estudiante Id">@error('estudiante_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="examen_id"></label>
                        <input wire:model="examen_id" type="text" class="form-control" id="examen_id" placeholder="Examen Id">@error('examen_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="calificacion"></label>
                        <input wire:model="calificacion" type="text" class="form-control" id="calificacion" placeholder="Calificacion">@error('calificacion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega"></label>
                        <input wire:model="fecha_entrega" type="text" class="form-control" id="fecha_entrega" placeholder="Fecha Entrega">@error('fecha_entrega') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tiempo_entrega"></label>
                        <input wire:model="tiempo_entrega" type="text" class="form-control" id="tiempo_entrega" placeholder="Tiempo Entrega">@error('tiempo_entrega') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="estatus"></label>
                        <input wire:model="estatus" type="text" class="form-control" id="estatus" placeholder="Estatus">@error('estatus') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Actualizar Examenes Entregado</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
             <input type="hidden" wire:model="selected_id">
             <div class="form-group">
                <label for="estatus">Estatus</label>
                <select wire:model="estatus" class="form-control" id="estatus">
                    <option value="corregido">Corregido</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="rechazado">Rechazado</option>
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
