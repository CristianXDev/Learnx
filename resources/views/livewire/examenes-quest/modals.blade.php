<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear pregunta</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="form-group mb-3">
                        <label for="pregunta">Pregunta</label>
                        <div class="input-group">
                            <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror

                            <label for="photo" class="btn btn-outline-primary"><i class='bx bx-image-alt'></i><i class='bx bx-loader'></i></label>
                            <input id="photo" wire:model="photo" type="file" class="d-none" wire:change="gemini_photo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="respuesta">Respuesta</label>
                        <input wire:model="respuesta" type="text" class="form-control" id="respuesta" placeholder="Respuesta">@error('respuesta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">

                <div>
                   <button type="button" wire:click.prevent="gemini()" class="btn btn-primary"><strong><i class='bx bx-planet mt-n1'></i> Gemini IA</strong></button>
               </div>
               <div>
                   <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                   <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
               </div>

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
                <form wire:submit.prevent="update">
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group mb-3">
                        <label for="pregunta">Pregunta</label>
                        <input wire:model="pregunta" type="text" class="form-control" id="pregunta" placeholder="Pregunta">@error('pregunta') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="respuesta">Respuesta</label>
                        <input wire:model="respuesta" type="text" class="form-control" id="respuesta" placeholder="Respuesta">@error('respuesta') <span class="error text-danger">{{ $message }}</span> @enderror
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


<!-- Preguntas Gemini Modal -->
<div wire:ignore.self class="modal fade" id="gemini_multiple" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="gemini_multiple" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gemini_multiple">Generar preguntas con Gemini IA</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group mb-3">
                        <label for="Tema">Tema</label>
                        <input wire:model="prompt" type="text" class="form-control" id="Tema" placeholder="La tematica que deben tener las preguntas...">@error('Tema') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="numeroPreguntas">Cantidad de preguntas</label>
                        <input wire:model="numeroPreguntas" type="number" min="1" max="20" class="form-control" id="numeroPreguntas" placeholder="Cantidad de preguntas a generar...">@error('numeroPreguntas') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="gemini_multiple()" class="btn btn-primary">Generar</button>
            </div>
        </div>
    </div>
</div>