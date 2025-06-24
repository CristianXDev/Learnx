<!-- Configuración Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Gestionar usuario</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group mb-3">
                        <label for="name">Nombre</label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nombre">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastName">Apellido</label>
                        <input wire:model="lastName" type="text" class="form-control" id="lastName" placeholder="Apellido">@error('lastName') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="cedula">Cedula</label>
                        <input wire:model="cedula" type="number" class="form-control" id="cedula" placeholder="Cédula">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="estatus">Estatus</label>
                        <select wire:model="estatus" type="text" class="form-control" id="estatus">
                            <option value="">Seleccione un estatus...</option>
                            <option value="activo">Activo</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        @error('estatus') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="rol">Rol</label>
                        <select wire:model="rol" type="text" class="form-control" id="rol" placeholder="Rol">
                            <option value="">Seleccione un rol...</option>
                            <option value="1">Administrador</option>
                            <option value="2">Estudiante</option>
                            <option value="3">Docente</option>
                        </select>
                        @error('rol') <span class="error text-danger">{{ $message }}</span> @enderror
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
