<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Agregar nuevo video</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" wire:submit.prevent="store">
                    <div class="form-group mb-3">
                        <label for="video">Seleccione un video</label>
                        <input wire:model="video" type="file" class="form-control" id="video" placeholder="Video">@error('video') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="titulo">Titulo</label>
                        <input wire:model="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo">@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
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
                <h5 class="modal-title" id="updateModalLabel">Actualizar video</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" wire:submit.prevent="update">
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group mb-3">
                        <label for="video">Seleccione un video</label>
                        <input wire:model="video" type="file" class="form-control" id="video" placeholder="Video">@error('video') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="titulo">Titulo</label>
                        <input wire:model="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo">@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiNombre()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Titulo Con Gemini IA</strong></button>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button type="button" wire:click.prevent="geminiDescripcion()" class="btn btn-primary mt-3" style="height:40px;"><strong><i class='bx bx-bulb'></i> Mejorar Descripción Con Gemini IA</strong></button>
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

<!--VIDEO MODAL-->
<div wire:ignore.self class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="videoModalLabel">{{ $titulo }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video controls width="100%" id="videoPlayer">
                    <source src="{{ Storage::url($video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

 <!--Cambiar el video-->
 <script type="text/javascript">

    document.addEventListener('video-updated', () => {
        document.getElementById('videoPlayer').load();
    });

 </script>
