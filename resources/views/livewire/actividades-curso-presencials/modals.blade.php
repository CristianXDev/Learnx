<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nueva actividad</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre de la actividad</label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre...">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="aula_id">Aula</label>
                        <select wire:model="aula_id" class="form-control" id="aula_id">
                            <option value="">Seleccione un aula</option>
                            @foreach($aulas as $row)
                            <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                            @endforeach
                        </select>
                        @error('aula_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_ini">Fecha y hora de inicio</label>
                        <input wire:model="fecha_ini" type="datetime-local"  class="form-control" id="fecha_ini" placeholder="Fecha Ini">@error('fecha_ini') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_fin">Fecha y hora de fin</label>
                        <input wire:model="fecha_fin" type="datetime-local" class="form-control" id="fecha_fin" placeholder="Fecha Fin">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Actualizar actividad</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
             <input type="hidden" wire:model="selected_id">
             <div class="form-group mb-3">
                <label for="nombre">Nombre de la actividad</label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre...">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="aula_id">Aula</label>
                <select wire:model="aula_id" class="form-control" id="aula_id">
                    <option value="">Seleccione un aula</option>
                    @foreach($aulas as $row)
                    <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                    @endforeach
                </select>
                @error('aula_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="fecha_ini">Fecha y hora de inicio</label>
                <input wire:model="fecha_ini" type="datetime-local"  class="form-control" id="fecha_ini" placeholder="Fecha Ini">@error('fecha_ini') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="fecha_fin">Fecha y hora de fin</label>
                <input wire:model="fecha_fin" type="datetime-local" class="form-control" id="fecha_fin" placeholder="Fecha Fin">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
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
