@section('title', __('ClassroomPublic'))

<div class="container-fluid mt-4">
    <div class="row">

        <!--Contenedor del video-->
        <div class="col-md-8">
            <div class="video-player">

                <!---Validar contenido del curso-->
                @if(!$curso == null && $curso->modulosCursos->first()->videosCursos->isNotEmpty())              
                <!--VIDEO-->
                <video width="100%" height="auto" controls id="videoPlayer" class="rounded" key="{{ $video_src }}">
                 <source src="{{ Storage::url($video_src) }}" type="video/mp4">
                     Your browser does not support the video tag.
                 </video>

                <!--VIDEO DATA-->
                <h3 class="mt-3 fw-bold">{{ $titulo }}</h3>

                <!--SWITCH-->

                <!--Si el usuario esta inscrito-->
                @if($inscrito)

                <div>

                    @if(session()->has('message'))
                   
                    <div wire:poll.8s class="alert alert-success alert-dismissible" role="alert">
                        <h4 class="alert-heading d-flex align-items-center gap-1"><span class="alert-icon rounded"><i class='bx bx-check-circle'></i></span>¡Se ha guardado el progreso!</h4>
                        <hr>
                        <p class="mb-0">Tu progreso en el curso se ha guardado, si te gusta mucho este video no olvides darle like y dejar un comentario para apoyar a la plataforma y a los docentes.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>

                    @endif

                    @if(session()->has('alert'))
                   
                    <div wire:poll.8s class="alert alert-warning alert-dismissible" role="alert">
                        <h4 class="alert-heading d-flex align-items-center gap-1"><span class="alert-icon rounded"><i class='bx bx-bell'></i></span>¡Haz borrado el progreso!</h4>
                        <hr>
                        <p class="mb-0">El progreso de este video se ha eliminado, si es un error, puedes cambiar el estatus más tarde, no te preocupes. </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>

                    @endif

                    @if(session()->has('info'))

                    <div wire:poll.8s class="alert alert-primary alert-dismissible" role="alert">
                        <h4 class="alert-heading d-flex align-items-center gap-1"><span class="alert-icon rounded"><i class="icon-base bx bx-coffee"></i></span>Haz apoyado a este creador :)</h4>
                        <hr>
                        <p class="mb-0"> {{ session('info') }} </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>

                    @endif

                    <!-- SWITCH -->
                    <div class="col form-check form-switch">
                        <form>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" wire:model="completado" wire:click="toggleCompleto({{ $videoIdSave }})" {{ $completado ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Marcar unidad como completada</label>
                        </form>
                    </div>

                    <!--LIKE / DISLIKE-->
                    <div class="col my-4">
                        <div class="d-inline-flex align-items-center gap-2">
                            <button wire:model="like" wire:click="toggleLike({{ $videoIdSave }})" class="btn {{ $likeValidate ? 'btn-primary' : 'btn-light' }} d-flex align-items-center gap-2" >
                                <i class="bx bx-like"></i>
                                <span class="fw-semibold">{{ $likesTotal }}</span>
                            </button>
                            <button wire:model="dislike" wire:click="toggleDislike({{ $videoIdSave }})" class="btn {{ $dislikeValidate ? 'btn-primary' : 'btn-light' }} d-flex align-items-center gap-2" >
                                <i class="bx bx-dislike"></i>
                                <span class="fw-semibold">{{ $dislikesTotal }}</span>
                            </button>
                        </div>
                    </div>

                </div>

                @endif

                <!--END SWITCH-->

                <!--DESCRIPCIÓN-->
                <div class="accordion-item card" wire:click="toggleComentario()">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionWithIcon-2" aria-expanded="false">
                            <i class='bx bx-detail me-2'></i>
                            <span class="fw-bold">Descripción del video</span>
                        </button>
                    </h2>
                    <div id="accordionWithIcon-2" class="accordion-collapse collapse {{ $comentarioActive ? 'show' : '' }}" >
                        <div class="accordion-body">
                             <p class="card-text justify-text" id="videoDescription">
                              {!! nl2br(e($descripcion)) !!}</p>
                        </div>
                    </div>
                </div>

                @else

                <div>
                    <h1>Este curso no tiene videos asociados.</h1>
                    <a href="{{ route('cursos-public') }}" class="btn btn-primary">REGRESAR</a>
                </div>

                @endif



                <!--Si el curso es invalido / No tiene información-->
                @if(!$curso == null && $curso->modulosCursos->first()->videosCursos->isNotEmpty())  

                <!--Divisor-->
                <hr class="my-4">
                <!--End divisor-->

                <!--Comentarios-->

                <!--Caja de comentarios-->
                <div>

                    <!--Titulo del contenedor de los cursos-->
                    <div class="d-flex">
                        <h3 class="fw-bold">Comentarios sobre el curso</h3>
                    </div>

                    <!--Si el usuario esta inscrito-->
                    @if($inscrito)

                    <!-- Área de nuevo comentario -->
                    <div class="d-flex gap-2 mb-4">
                        <img src="{{ Auth::User()->image ? Storage::url(Auth::User()->image) : asset('static/assets/img/avatars/8.png') }}" class="rounded-circle" alt="Avatar" width="40" height="40">
                        <div class="flex-grow-1">
                            <form wire:submit.prevent="store">
                                <textarea wire:model="comentario" type="text" class="form-control" placeholder="Añade un comentario..." rows="3"></textarea>
                                @error('comentario') <span class="error text-danger">{{ $message }}</span> @enderror

                                {{-- El comentario es ofensivo --}}
                                @if (session()->has('comentario-error'))
                                <div wire:poll.4s class="btn btn-sm btn-danger mt-2" style="margin-top:0px; margin-bottom:0px;"> {{ session('comentario-error') }} </div>
                                @endif
                                {{-- End alerta de comentario --}}

                                
                            </form>

                            <button type="button" wire:click.prevent="storeComentario()" class="btn btn-primary w-25 mt-2"><i class='bx bx-paper-plane'></i> Enviar</button>

                        </div>
                    </div>

                    @endif

                    <!--Modal de los comentarios-->
                    @include('livewire.comentarios-cursos.modals')
                    <!--End comentarios modal-->

                    <!-- Comentarios existentes -->
                    <div class="comments-section mt-5">

                        <!-- Primer comentario -->

                        @forelse($comentarios as $comentario)

                        <div class="d-flex gap-2 mb-4">
                            <img src="{{ $comentario->user->image ? Storage::url($comentario->user->image) : asset('static/assets/img/avatars/8.png') }}" class="rounded-circle" alt="Avatar" width="40" height="40">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="fw-bold">{{ $comentario->user->name }} {{ $comentario->user->lastName }}</span>
                                        <span class="text-muted ms-2">{{ \Carbon\Carbon::parse($comentario->created_at)->format('d-m-Y') }}</span>
                                    </div>

                                    <!--Verificar si el usuario que puso el comentario es el mismo que el actual-->
                                    @if($comentario->user->id == Auth::user()->id)

                                    <button class="btn btn-link text-muted p-0">

                                        <div class="dropdown">
                                            <a href="#" class="text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="editComentario({{$comentario->id}})"><i class='bx bx-pencil'></i> Editar </a></li>
                                                <li><a class="dropdown-item" onclick="confirm('Confirm Delete Categoria id {{$comentario->id}}? \nDeleted Categorias cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroyComentario({{$comentario->id}})"><i class='bx bx-trash'></i> Borrar </a></li>  
                                            </ul>
                                        </div>                              

                                    </button>

                                    @endif
                                    <!--Fin de la verificación-->

                                </div>

                                <!--Cometario-->
                                <p>{{ $comentario->comentario }}</p>
                                <!--End comentario-->

                            </div>
                        </div>

                        @empty

                        <!--Si el usuario esta inscrito-->
                        @if($inscrito)

                        <!--Si no hay comentarios sobre el curso-->
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h4>¡No hay comentarios, sé el primero en comentar!</h4>
                                    <img src="{{ asset('static/assets/img/others/redaccion.gif') }}" class="img-fluid w-25">

                                </div>
                            </div>
                        </div>
                        <!--End empty-->

                        @else
                        <!-- Si el usuairo no está inscrito-->

                        <!--Si no hay comentarios sobre el curso-->
                        <div class="text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h4>¡No hay comentarios, inscribete para dejar una reseña!</h4>
                                    <img src="{{ asset('static/assets/img/others/redaccion.gif') }}" class="img-fluid w-25">

                                </div>
                            </div>
                        </div>


                        <!--Finalizar validación de Si el usuario esta inscrito-->
                        @endif

                        @endforelse

                    </div>


                    <!--Paginación de los comentarios-->
                    <div class="d-flex">{{ $comentarios->links() }}</div>
                    <!--End paginación-->

                </div>
                <!--End caja de comentarios-->

                <!--Finalizar validación del curso para saber si es invalido / No tiene información-->
                @endif
                <!--Comentarios-->

            </div>
        </div>
        <!--End Contenedor de video-->







        <!--Contenedor del listado de videos-->
        <div class="col-md-4">
            <div class="videos-list">

            @if (!$curso == null && $curso->modulosCursos->first()->videosCursos->isNotEmpty())

                    <!--Si el usuario está inscrito en el curso actual-->
                    @if($inscrito)

                    <!-- Listado de videos--> 
                    <div class="card">

                        <!--TITULO DEL CONTENEDOR-->
                        <div class="text-center mt-4">
                            <h4 class="my-3 fw-bold">Videos del Curso</h4>

                            <div class="mt-3 px-4">

                                <span class="text-muted">Progreso en el curso {{ $porcentaje }}%</span>
                                <div class="progress" style="height: 20px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{$porcentaje}}% ;" aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100">{{$porcentaje}}%</div>
                              </div>
                          </div>

                        </div>

                        @if ($curso->modulosCursos->isNotEmpty())

                        <div class="card-body"> 

@foreach($curso->modulosCursos as $modulo)
    @if($loop->iteration == 2)
      @if(auth()->user()->QuizCursoEntregado()->where('modulo_id', $modulo->id)->where('estatus', 'aprobado')->exists())
            <!-- Si existe el quiz, muestra el módulo normal -->
            <div class="accordion mb-3" id="accordionExample" wire:ignore>
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                            Módulo: {{ $modulo->titulo }}
                        </button>
                    </h2>
                    <div id="accordionOne" class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <!-- Listado de videos -->
                                @forelse ($modulo->videosCursos as $video)
                                    <li class="list-group-item ms-n3">
                                        <a href="#" class="text-muted" wire:click="toggleVideo({{ $video->id }})">
                                            <i class='bx bx-circle'></i> {{ $video->titulo }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="list-group-item ms-n3">
                                        <a href="#" class="text-muted">No hay videos por el momento.<i class='bx bx-circle'></i></a>
                                    </li>
                                @endforelse
                                <!-- Fin del listado de videos -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Si no existe el quiz, muestra el botón de desbloquear -->
            <div class="text-center py-4">
                <a href="{{ route('quiz-join',['id'=>$modulo->id]) }}" class="btn btn-primary" target="_blank"><i class="bx bx-lock"></i> Desbloquear módulo</a>
            </div>
        @endif
    @else
        <!-- Módulos normales (no son la segunda iteración) -->
        <div class="accordion mb-3" id="accordionExample" wire:ignore>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">
                        Módulo: {{ $modulo->titulo }}
                    </button>
                </h2>
                <div id="accordionOne" class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush">
                            <!-- Listado de videos -->
                            @forelse ($modulo->videosCursos as $video)
                                <li class="list-group-item ms-n3">
                                    <a href="#" class="text-muted" wire:click="toggleVideo({{ $video->id }})">
                                        <i class='bx bx-circle'></i> {{ $video->titulo }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item ms-n3">
                                    <a href="#" class="text-muted">No hay videos por el momento.<i class='bx bx-circle'></i></a>
                                </li>
                            @endforelse
                            <!-- Fin del listado de videos -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach









                        </div>
                    </div>

                    @endif

                    <!--Si el curso es premium-->
                    @elseif($curso->tipo == 'premium')

                    <h3 class="mb-3">Videos del Curso</h3>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>Importante</h4>
                            <p><strong>Necesitas comprar en este curso para acceder al contenido.</strong></p>

                            <img src="{{ asset('static/assets/img/others/compra.gif') }}" class="img-fluid img-thumbnail rounded" alt="Responsive image">

                            <div class="mt-4 text-center">
                                <a href="{{ route('confirm-pay', [Route::current()->parameter('id')]) }}" class="btn btn-primary">Comprar curso</a>
                            </div>
                        </div>
                    </div>

                    <!--Si el curso es gratis-->
                    @else

                    <h3 class="mb-3">Videos del Curso</h3>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>Importante</h4>
                            <p><strong>Necesitas inscribirte en este curso para acceder al contenido.</strong></p>

                            <img src="{{ asset('static/assets/img/others/inscrito.gif') }}" class="img-fluid img-thumbnail rounded" alt="Responsive image">

                            <div class="mt-4 text-center">
                                <a href="{{ route('curso-registration', ['id' => $curso->id]) }}" class="btn btn-primary">Inscribirme en este curso</a>
                            </div>
                        </div>
                    </div>

                    @endif

                    <!--No hay datos en el curso-->
                    @endif

                    <!---Validar contenido del curso-->
                    @if(!$curso == null && $curso->modulosCursos->first()->videosCursos->isNotEmpty())          

                    <!--Si el usuario esta inscrito-->
                    @if($inscrito)

                    <!--Valoración-->
                    <div class="col-md-12 mt-4">
                        <div class="card">

                            <!--Modal de calificación-->
                            @include('livewire.cursos-view.modals')
                            <!--End modal -->

                            <div class="container py-5">
                                <h3 class="text-center text-jutify fw-bold">Calificación del Curso</h3>

                                <div class="row justify-content-center">

                                    <div class="col-12">

                                        @if($promedioCalificacion == 0)

                                        <h3 class="fw-bold text-center">
                                            <small>Sin estrellas</small>
                                        </h3>

                                        @else

                                        <h3 class="fw-bold text-center"> {{ $promedioCalificacion }} <small>Estrellas</small></h3>

                                        @endif

                                        <div class="d-flex align-items-center justify-content-center mt-3">

                                            <h2 class="fw-bold">

                                                <small>

                                                    @if($promedioCalificacion == 0)

                                                    <span class="text-secondary">★★★★★</span>

                                                    @else

                                                        @for ($i = 0; $i < $promedioCalificacion; $i++)

                                                        <span class="text-warning">★</span>

                                                        @endfor

                                                    @endif

                                                </small>
                                            </h2>

                                        </div>

                                        <div class="text-center mb-3">
                                            <span class="text-muted fw-bold">(Reviews: {{ $totalCalificaciones }})</span>
                                        </div>

                                        <!--Cargamos el conteo de estrellas-->
                                        @for ($i = 5; $i >= 1; $i--)

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="me-4 d-flex w-25">

                                                    <strong class="me-2">{{ $i }} </strong>

                                                    @for ($j = $i; $j >= 1; $j--)
                                                        <small class="text-warning">★</small>
                                                    @endfor

                                                </span>

                                                <div class="progress flex-grow-1">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $porcentajesEstrellas[$i]  }}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="{{ $porcentajesEstrellas[$i]  }}"></div>
                                                </div>
                                                <span class="ms-2 text-muted">({{ $estrellas[$i] ?? 0}})</span>
                                            </div>
                                        </div>

                                        @endfor
                                        <!--End conteo de estrellas-->
                           

                                    </div>

                                    <!-- Verificamos si el usuario ya valoró el curso -->
                                    @if(!$calificado)

                                    <button class="btn btn-sm btn-warning mt-4" data-bs-toggle="modal" data-bs-target="#calificacionDataModal">Valorar Curso ★</button>

                                    @endif
                                    <!--Fin validación de calificación-->

                                    @if(session()->has('calification'))

                                    <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('calification') }} </div>

                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <!--End Valoración-->


                </div>
            </div>
             <!--End contendor de listado -->
         </div>
     </div>

     <!--Cambiar el video-->
     <script type="text/javascript">
    
        document.addEventListener('video-updated', () => {
            document.getElementById('videoPlayer').load();
        });

     </script>
