<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar comentario</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        
                        <label for="comentario">Comentario</label>

                        <textarea wire:model="comentario_update" type="text" class="form-control" id="comentario" placeholder="Comentario"></textarea>@error('comentario_update') <span class="error text-danger">{{ $message }}</span> @enderror

                        {{-- El comentario es ofensivo --}}
                        @if (session()->has('comentario-error-modal'))
                        <div wire:poll.4s class="btn btn-sm btn-danger mt-2" style="margin-top:0px; margin-bottom:0px;"> {{ session('comentario-error-modal') }} </div>
                        @endif
                        {{-- End alerta de comentario --}}

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="updateComentario()" class="btn btn-primary">Actualizar</button>
            </div>
       </div>
    </div>
</div>
