@section('title', __('ClassroomPublic'))
<div>

    <div class="container-fluid mt-4">
        <div class="row">

            @if ($inscrito)

                <div class="col-md-12">

            @else

               <div class="col-md-8">

            @endif

                @forelse($cursos as $curso)

                <div class="card mt-3">
                    <img src="{{ Storage::url($curso->image) }}" class="img-fluid img-thumbnail rounded" alt="Responsive image">
                    <div class="card-body">
                        <h3>{{$curso->nombre}}</h3>

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" style="box-shadow: none;">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Descripción del curso.
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="card-text justify-text">{{ $curso->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-stripped table-sm">
                                <thead class="thead">
                                    <tr>  
                                        <th>Actividad</th>
                                        <th>Aula</th>
                                        <th>De</th>
                                        <th>Hasta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($actividades as $row)
                                    <tr>
                                        <td>{{ $row->nombre }}</td>
                                        <td>{{ $row->aula->nombre }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->fecha_ini)->format('d-m-Y h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->fecha_fin)->format('d-m-Y h:i A') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">No se encontraron datos.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table> 



                            @if ($inscrito)


                            <!--HR-->
                            <hr class="my-5">

                            <!--Chat-->
                            <div class="col-md-12">

                              <!--Modal chat--> 
                              @include('livewire.curso-presencial-view.modals')

                              <div class="text-center">
                                <h2>- CHAT -</h2>
                            </div>

                            <div class="container-fluid mt-2">

                             <div class="card-body chat-body" style="height: 500px; overflow-y: auto;">

                                @if($chat->isEmpty())

                                <div class="chat-message text-center mt-5">

                                    <h4>¡Se el primero en enviar un mensaje!</h4>
                                    <img src="{{ asset('static/assets/img/classroom-join/pencil.gif') }}" class="img-fluid" width="128" height="128">

                                </div>

                                @else

                                @php
                                $lastUserId = null;
                                @endphp

                                @foreach($chat as $row)

                                @if($row->user->id != $lastUserId)
                                <div class="chat-message d-flex my-2">
                                    <div class="mx-2">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up list-unstyled" title="Foto usuario"><img src="{{ $row->user->image ? Storage::url($row->user->image) : asset('static/assets/img/avatars/8.png') }}" alt="foto usuario" class="rounded-circle">
                                        </li>
                                    </div>
                                    <div>
                                        <strong>

                                         {{ $row->user->name }} {{ $row->user->lastName }}  -

                                         <span class="text-primary">

                                            @if($row->user->rol== 1)
                                            <span class="badge bg-label-secondary me-1">Administrador <i class='bx bx-crown' style="font-size:15px;"></i></span>

                                            @elseif($row->user->rol== 3)
                                            <span class="badge bg-label-success me-1">Docente <i class='bx bx-glasses-alt' style="font-size:16px;"></i></span>

                                            @else
                                            <span class="badge bg-label-primary me-1">Estudiante <i class='bx bx-rocket' style="font-size:15px;"></i></span>
                                            @endif

                                        </span> 
                                    </strong>

                                    <div class="d-flex flex-row" style="margin-bottom:-10px;"> 
                                        <p class="text-muted p-2"> {{ $row->mensaje }} </p>

                                        @if(Auth::user()->id == $row->user->id)
                                        <div class="dropdown" style="margin-top:6px;">
                                            <a class="dropdown-toggle-split" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#:333;">
                                                <i class='bx bx-dots-vertical-rounded' style="font-size:18px;"></i>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="confirm('Confirm Delete Classroom id {{$row->id}}? \nDeleted Classrooms cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @else
                            <div class="chat-message" style="margin-top:-20px; padding-left:42px;">
                               <div class="d-flex flex-row"> 
                                <p class="text-muted p-2"> {{ $row->mensaje }} </p>

                                @if(Auth::user()->id == $row->user->id)
                                <div class="dropdown" style="margin-top:6px;">
                                    <a class="dropdown-toggle-split" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#:333;">
                                        <i class='bx bx-dots-vertical-rounded' style="font-size:18px;"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class='bx bx-pencil'></i> Editar </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" onclick="confirm('Confirm Delete Classroom id {{$row->id}}? \nDeleted Classrooms cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class='bx bx-trash'></i> Borrar </a>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @php

                        $lastUserId = $row->user->id;

                        @endphp

                        @endforeach

                        @endif
                    </div>



                    <div class="card-footer">
                        <form wire:submit.prevent="store">
                            <div class="input-group">
                                <input wire:model="mensaje" type="text" class="form-control mx-2" id="mensaje" placeholder="Mensaje">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"  wire:click.prevent="store()" id="button-addon2"><i class='bx bx-paper-plane'></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>







            </div>

        </div>


@endif
        <!--End Chat-->

                                      

                        </div>
                    </div>
                </div>

                @empty

                <div class="text-center">
                    <h2>El curso no existe</h2>
                </div>

                @endforelse  

            </div>

            @forelse($cursos as $curso)

                @if ($inscrito)

                @else

                <div class="col-md-4">

                    <div class="alert alert-info mt-3">
                        <h4>Importante</h4>
                        <p><strong>Necesitas inscribirte en este curso para acceder al contenido.</strong></p>

                        <img src="{{ asset('static/assets/img/others/inscrito.gif') }}" class="img-fluid img-thumbnail rounded" alt="Responsive image">

                        <div class="mt-4 text-center">
                            <a href="{{ route('curso-presencial-registration', ['id' => 1]) }}" class="btn btn-primary">Inscribirme en este curso</a>
                        </div>
                    </div>

                </div>


                @endif

            @empty
            @endforelse  

        </div>
    </div>
</div>

