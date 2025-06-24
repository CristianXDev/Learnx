<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="calificacionDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

            <div>
                <img src="{{ asset('static/assets/img/others/calificacion.gif') }}" class="img-fluid w-50">
            </div>

             <div class="container mt-2">
                <h2>Califica tu experiencia</h2>
                <div class="star-rating">
                    <button wire:click="calificacion(1)" class="btn btn-link p-0" data-rating="1" aria-label="1 estrella">
                        <i class="bx bxs-star fs-3"></i>
                    </button>
                    <button wire:click="calificacion(2)" class="btn btn-link p-0" data-rating="2" aria-label="2 estrellas">
                        <i class="bx bxs-star fs-3"></i>
                    </button>
                    <button wire:click="calificacion(3)" class="btn btn-link p-0" data-rating="3" aria-label="3 estrellas">
                        <i class="bx bxs-star fs-3"></i>
                    </button>
                    <button wire:click="calificacion(4)" class="btn btn-link p-0" data-rating="4" aria-label="4 estrellas">
                        <i class="bx bxs-star fs-3"></i>
                    </button>
                    <button wire:click="calificacion(5)" class="btn btn-link p-0" data-rating="5" aria-label="5 estrellas">
                        <i class="bx bxs-star fs-3"></i>
                    </button>
                </div>

                @error('calificacion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>

@section('script')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starRating = document.querySelector('.star-rating');
        const stars = starRating.querySelectorAll('button');
        const ratingValue = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                updateRating(rating);
            });

            star.addEventListener('mouseover', function() {
                const rating = this.getAttribute('data-rating');
                highlightStars(rating);
            });
        });

        starRating.addEventListener('mouseout', function() {
            const currentRating = ratingValue.textContent;
            highlightStars(currentRating);
        });

        function updateRating(rating) {
            ratingValue.textContent = rating;
            highlightStars(rating);
        }

        function highlightStars(rating) {
            stars.forEach(star => {
                const starRating = star.getAttribute('data-rating');
                if (starRating <= rating) {
                    star.querySelector('i').classList.add('active');
                } else {
                    star.querySelector('i').classList.remove('active');
                }
            });
        }
    });
</script>


<script type="module">
    const addModal = new bootstrap.Modal('#calificacionDataModal');
  window.addEventListener('closeModal', () => {
    addModal.hide();
})
</script>

@endsection