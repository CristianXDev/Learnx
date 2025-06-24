<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body text-center">
            <h4>Analisar imagen</h4>
            <img src="{{ asset('static/assets/img/others/analisis.gif') }}" width="150" height="150" class="img-fluid">
            <a href="#" data-bs-toggle="modal" data-bs-target="#fotoDataModal" class="btn btn-primary mt-4" wire:click="openModal()">Probar Herramienta</a>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="fotoDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="{{ $showModal }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Analisar imagen</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="gemini_photo">
                    <div class="form-group mb-3">
                        <label for="photo">Subir una foto</label>
                        <input wire:model="photo" type="file" class="form-control" id="photo">@error('photo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="interpretacion">Interpretación de la imagen</label>
                        <textarea wire:model="interpretacion" class="form-control" id="interpretacion" placeholder="Interpretación de la imagen..." rows="10" disabled></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click="gemini_photo()" class="btn btn-primary">Analisar</button>
            </div>
        </div>
    </div>
</div>

