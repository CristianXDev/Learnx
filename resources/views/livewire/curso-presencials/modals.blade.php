<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nuevo curso</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group mb-3">
                        <label for="image">Foto del curso</label>
                        <input wire:model="image" type="file" class="form-control" id="image" placeholder="Image">@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control mb-3" id="nombre" placeholder="Nombre del curso...">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_ini">Fecha de inicio del curso</label>
                        <input wire:model="fecha_ini" type="date" class="form-control" id="fecha_ini" placeholder="Fecha de inicio...">@error('fecha_ini') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_fin">Fecha de finalización del curso</label>
                        <input wire:model="fecha_fin" type="date" class="form-control" id="fecha_fin" placeholder="Fecha de finalización...">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="estudiantes_max">Cantidad maxima de estudiantes</label>
                        <input wire:model="estudiantes_max" type="number" min="0" max="30" class="form-control" id="estudiantes_max" placeholder="Estudiantes maximo">@error('estudiantes_max') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="categoria_id">Categoria del curso</label>
                        <select wire:model="categoria_id" class="form-control" id="categoria_id">
                            <option value="">Seleccione una categoria</option>
                            @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
            <h5 class="modal-title" id="updateModalLabel">Update Curso Presencial</h5>
            <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
             <input type="hidden" wire:model="selected_id">

             <div class="form-group mb-3">
                <label for="image">Foto del curso</label>
                <input wire:model="image" type="file" class="form-control" id="image" placeholder="Image">@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input wire:model="nombre" type="text" class="form-control mb-3" id="nombre" placeholder="Nombre del curso...">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea wire:model="descripcion" type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="fecha_ini">Fecha de inicio del curso</label>
                <input wire:model="fecha_ini" type="date" class="form-control" id="fecha_ini" placeholder="Fecha de inicio...">@error('fecha_ini') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="fecha_fin">Fecha de finalización del curso</label>
                <input wire:model="fecha_fin" type="date" class="form-control" id="fecha_fin" placeholder="Fecha de finalización...">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="estudiantes_max">Cantidad maxima de estudiantes</label>
                <input wire:model="estudiantes_max" type="number" min="0" max="30" class="form-control" id="estudiantes_max" placeholder="Estudiantes maximo">@error('estudiantes_max') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label for="categoria_id">Categoria del curso</label>
                <select wire:model="categoria_id" class="form-control" id="categoria_id">
                    <option value="">Seleccione una categoria</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

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
        <button type="button" wire:click.prevent="update()" class="btn btn-primary">Actualizar</button>
    </div>
</div>
</div>
</div>
