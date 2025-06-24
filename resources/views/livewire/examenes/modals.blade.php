<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear un nuevo examen</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form wire:submit.prevent="store">
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control mb-3" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control mb-3" id="descripcion" placeholder="Descripcion"></textarea> @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mb-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
                    </div>

                    <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Tipo de examen</small>
                        <div class="form-check form-check-inline mt-3">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="clasico" />
                            <label class="form-check-label" for="inlineRadio1">Preguntas clasicas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="multiple" />
                            <label class="form-check-label" for="inlineRadio2">Preguntas multiples</label>
                        </div>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_inicio">Fecha de inicio del examen</label>
                        <input wire:model="fecha_inicio" type="date" class="form-control" id="fecha_inicio" placeholder="Fecha Inicio">@error('fecha_inicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_fin">Fecha de cierre del examen</label>
                        <input wire:model="fecha_fin" type="date" class="form-control" id="fecha_fin" placeholder="Fecha Fin">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="lim_tiempo">Limite de tiempo</label>
                        <input wire:model="lim_tiempo" type="number" min="5" max="60" class="form-control" id="lim_tiempo" placeholder="Cantidad de tiempo (se mide en minutos)">@error('lim_tiempo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="materia_id">Materia</label>
                        <select wire:model="materia_id" class="form-control" id="materia_id">
                            <option value="">Seleccione una materia</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                            @endforeach
                        </select>
                        @error('materia_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="submateria_id">Tema</label>
                        <select wire:model="submateria_id" class="form-control" id="submateria_id">
                            <option value="">Seleccione un tema</option>
                            @foreach($submaterias as $submateria)
                            <option value="{{ $submateria->id }}">{{ $submateria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('submateria_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Actualizar examen</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
					<input type="hidden" wire:model="selected_id">
                                      <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea> @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md mb-3">
                        <small class="text-light fw-medium d-block">Tipo de examen</small>
                        <div class="form-check form-check-inline mt-3">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="clasico" />
                            <label class="form-check-label" for="inlineRadio1">Preguntas clasicas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input wire:model="tipo" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="multiple" />
                            <label class="form-check-label" for="inlineRadio2">Preguntas multiples</label>
                        </div>
                        @error('tipo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_inicio">Fecha de inicio del examen</label>
                        <input wire:model="fecha_inicio" type="date" class="form-control" id="fecha_inicio" placeholder="Fecha Inicio">@error('fecha_inicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_fin">Fecha de cierre del examen</label>
                        <input wire:model="fecha_fin" type="date" class="form-control" id="fecha_fin" placeholder="Fecha Fin">@error('fecha_fin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="lim_tiempo">Limite de tiempo</label>
                        <input wire:model="lim_tiempo" type="number" min="5" max="60" class="form-control" id="lim_tiempo" placeholder="Cantidad de tiempo (se mide en minutos)">@error('lim_tiempo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="materia_id">Materia</label>
                        <select wire:model="materia_id" class="form-control" id="materia_id">
                            <option value="">Seleccione una materia</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                            @endforeach
                        </select>
                        @error('materia_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="submateria_id">Submateria</label>
                        <select wire:model="submateria_id" class="form-control" id="submateria_id">
                            <option value="">Seleccione una submateria</option>
                            @foreach($submaterias as $submateria)
                            <option value="{{ $submateria->id }}">{{ $submateria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('submateria_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
