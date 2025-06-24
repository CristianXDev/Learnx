<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nuevo curso</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form enctype="multipart/form-data" wire:submit.prevent="store">
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
                    <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Tipo de curso</small>
                        <div class="form-check form-check-inline mt-3">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="gratis" />
                            <label class="form-check-label" for="inlineRadio1">Gratis</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="premium" />
                            <label class="form-check-label" for="inlineRadio2">Premium</label>
                        </div>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="precio">Precio <span class="text-muted">(opcional)</span> </label>
                        <input wire:model.defer="precio" type="number" min="0" class="form-control" id="precio" placeholder="Precio"  @if($tipo == 'gratis') readonly @endif> 
                        @error('precio') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Actualizar curso</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" wire:submit.prevent="update">
					<input type="hidden" wire:model="selected_id">

                    <div class="form-group mb-3">
                        <label for="image">Foto del curso</label>
                        <input wire:model="image" type="file" class="form-control" id="image" placeholder="Image">@error('image') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del curso...">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
                    </div>
                    <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Tipo de curso</small>
                        <div class="form-check form-check-inline mt-3">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="gratis" />
                            <label class="form-check-label" for="inlineRadio1">Gratis</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="premium" />
                            <label class="form-check-label" for="inlineRadio2">Premium</label>
                        </div>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="precio">Precio <span class="text-muted">(opcional)</span> </label>
                        <input wire:model.defer="precio" type="number" min="0" class="form-control" id="precio" placeholder="Precio"  @if($tipo == 'gratis') readonly @endif> 
                        @error('precio') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Actualizar</button>
            </div>
       </div>
    </div>
</div>
