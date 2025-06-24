@section('title', __('ClassroomPublic'))
<div>

    <div class="my-5 text-center">
        <h2>Cursos disponibles</h2>

        <div class="row">
            <div class="w-50 input-group input-group-merge">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" wire:model="search" class="form-control" placeholder="Buscar aula...">
            </div>

            <div class="w-50 input-group input-group-merge">
                <label class="input-group-text" for="inputGroupSelect01">Categorias</label>
                <select wire:model="search" class="form-select" id="inputGroupSelect01">
                    <option value="">Seleccione una categoria</option>

                    @forelse($categorias as $categoria)

                     <option value="{{ $categoria->nombre }}"> {{ $categoria->nombre }}</option>

                    @empty

                    <option value="">No hay categorias</option>
                    
                    @endforelse

                </select>
            </div>
        </div>

    </div>

    <div class="row">
        @forelse ($cursos as $row)  <!-- Ahora la variable $classrooms está disponible -->
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ Storage::url($row->image) }}" class="card-img-top" alt="{{ $row->nombre }}" style="height: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $row->nombre }}</h5>
                    <div>
                        <span class="badge bg-label-primary my-1">{{ $row->categoria->nombre }}</span>
                        @if($row->tipo=='premium')
                        <span class="badge bg-label-secondary me-1">Premium</span>
                        @else
                        <span class="badge bg-label-warning me-1">Gratis</span>
                        @endif
                    </div>
                    <div>
                        @if($row->tipo=='premium')
                        <span class="badge bg-label-info me-1">Precio: {{$row->precio}}$</span>
                        @endif
                    </div>
                    <div class="mb-2">
  @php
                                        $promedioCalificacion = $row->calificacionCurso->first()->promedio_calificacion ?? 0;
                                        $promedioCalificacionRedondeado = round($promedioCalificacion);
                                      @endphp

                                       @if($promedioCalificacion > 0)
                                          @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $promedioCalificacionRedondeado)
                                                    <i class="bx bxs-star text-warning"></i>
                                                @else
                                                    <i class="bx bx-star"></i>
                                                @endif
                                           @endfor
                                        @else
                                           
                                        @for ($i = 0; $i < 5; $i++)
                                        
                                        <i class="bx bxs-star text-secondary"></i>
                                        @endfor

                                        @endif
                    </div>

                    <p class="card-text">{{ Str::limit($row->descripcion, 150, '...') }}</p>

                    @if(auth()->user()->inscripcionesCursos()->where('curso_id', $row->id )->exists())

                    <a href="{{ route('cursos-view',['id' => $row->id ]) }}" class="btn btn-secondary">Ver curso (Ya estas inscrito)</a>

                    @else

                    <a href="{{ route('cursos-view',['id' => $row->id ]) }}" class="btn btn-primary">Ver curso</a>

                    @endif
                </div>
            </div>
        </div>

        @empty

        <div class="text-center mt-5">
            <h4>No hay cursos online.</h4>
        </div>

        @endforelse
    </div>
</div>