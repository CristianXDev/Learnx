@section('title', __('ClassroomPublic'))
<div>

    <div class="mt-5 mb-3 text-center">
        <h2>Aulas publicas</h2>

        <div class="input-group input-group-merge">
           <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input type="text" wire:model="search" class="form-control" placeholder="Buscar aula...">
        </div>
    </div>

    <div class="row">
        @forelse ($classrooms as $classroom)  <!-- Ahora la variable $classrooms está disponible -->
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ Storage::url($classroom->foto) }}" class="card-img-top h-50" alt="{{ $classroom->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $classroom->nombre }}</h5>
                    <span class="badge bg-label-primary my-1">{{ $classroom->materia->nombre }}</span>
                    <p class="card-text">{{ Str::limit($classroom->descripcion, 150, '...') }}</p>
                    <a href="{{ route('classroom-join',['codigo' => $classroom->codigo_acceso ]) }}" class="btn btn-primary">¡Unirme a esta aula!</a>
                </div>
            </div>
        </div>

        @empty

        <div class="text-center mt-5">
            <h4>No hay aulas.</h4>
        </div>

        @endforelse
    </div>
</div>