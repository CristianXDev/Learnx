<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nueva aula</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" wire:submit.prevent="store">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto del aula</label>
                            <input wire:model="foto" class="form-control" type="file" id="formFile">
                            @error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label for="materia_id">Materia</label>
                        <select wire:model="materia_id" class="form-control" id="materia_id">
                            <option value="">Seleccione una materia</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                            @endforeach
                        </select>
                        @error('materia_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Tipo de aula</small>
                        <div class="form-check form-check-inline mt-3">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="publico" />
                            <label class="form-check-label" for="inlineRadio1">Publica</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="privado" />
                            <label class="form-check-label" for="inlineRadio2">Privada</label>
                        </div>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="max_estudiantes">Cantidad de estudiantes permitidos</label>
                        <input wire:model="max_estudiantes" type="number" min="1" max="99" class="form-control" id="max_estudiantes" placeholder="Max Estudiantes">@error('max_estudiantes') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Actualizar Aula</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" wire:submit.prevent="update">
             <input type="hidden" wire:model="selected_id">

             <div class="form-group">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto del aula</label>
                    <input wire:model="foto" class="form-control" type="file" id="formFile">
                    @error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre"> @error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
            </div>
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
            </div>
            <div class="form-group">
                <label for="materia_id">Materia</label>
                <select wire:model="materia_id" class="form-control" id="materia_id">
                    <option value="">Seleccione una materia</option>
                    @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                @error('materia_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md mb-3">
                <small class="text-light fw-medium d-block">Tipo de aula</small>
                <div class="form-check form-check-inline mt-3">
                    <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="publico" />
                    <label class="form-check-label" for="inlineRadio1">Publica</label>
                </div>
                <div class="form-check form-check-inline">
                    <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="privado" />
                    <label class="form-check-label" for="inlineRadio2">Privada</label>
                </div>
                @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="max_estudiantes">Cantidad de estudiantes permitidos</label>
                <input wire:model="max_estudiantes" type="number" min="1" max="99" class="form-control" id="max_estudiantes" placeholder="Max Estudiantes">@error('max_estudiantes') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" wire:click.prevent="update()" class="btn btn-primary">Actualizar</button>
    </div>
</div>
</div>
</div>

<!-- Estatus Modal -->
<div wire:ignore.self class="modal fade" id="estatusDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Aula</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">

                    <div class="form-group">
                        <label for="estatus">Estatus</label>
                        <select wire:model="estatus" class="form-control" id="estatus">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        @error('estatus')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="updateEstatus()" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>