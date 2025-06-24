<div class="container-fluid">


    @if($classroom_id !== 0)
    <!--TAREAS-->
    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="text-center">
                        <h4><strong>Tareas del aula</strong></h4>

                        <img src="{{ asset('static/assets/img/classroom-join/tarea.gif') }} " class="img-fluid rounded w-50">

                        <a href="#" class="btn btn-primary w-100 mt-4" data-bs-toggle="modal" data-bs-target="#tareaModal"><i class='bx bx-list-ul'></i> Ver lista de tareas</a>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
         <div class="container-fluid mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <img src="{{ asset('static/assets/img/classroom-join/alumno.gif') }}" class="img-fluid rounded w-100" style="height:200px;">
                        </div>

                        <div>
                            <h5>¿Quieres saber quienes son tus compañeros?</h5>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#estudianteModal" class="btn btn-primary"><i class='bx bx-list-ul'></i> Listado de miembros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    @endif



<div class="row">
    <div class="col-lg-4">

     <div class="card mt-2">
        <div class="card-header d-flex justify-content-center">
            <a href="{{ route('dashboard') }}" class="app-brand-link">
                <span >
                    <img src="{{ asset('static/assets/img/favicon/favicon.ico') }}" class="app-brand-logo demo" width="32" height="32">
                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2">Learnx</span>
            </a>


        </div>
        <div class="card-body">

          <li class="menu-header small text-uppercase my-3 text-center"><span class="menu-header-text"><strong>- Aulas -</strong></span></li>

          @if(count($classroomUsers) > 0)
          @foreach ($classroomUsers as $row)
          <a href="{{ route('classroom_home',['code' => $row->classroom->codigo_acceso]) }}"> 
              <div class="d-flex btn btn-light mb-3">
                <div class="">
                  <img src="{{ Storage::url($row->classroom->foto) }}" alt="foto usuario" class="rounded-circle" width="64" height="64">
              </div>

              <div class="mx-2" style="margin-top:13px;">
                  <strong >{{ $row->classroom->nombre }}</strong>

                  <p class="text-muted">{{  Str::limit($row->classroom->descripcion, 40, '...') }}</p>
              </div>
          </div>
      </a>
      @endforeach
      @else
      <div class="chat-message text-center">
        <strong>No estas unido a ningun aula</strong>
    </div>
    @endif

</div>

</div>

</div>


<div class="col-md-8">
    <div class="container-fluid mt-2">

        <!--Modal chat--> 
        @include('livewire.chats-classrooms.modals')

        <!--Modal tarea-->
     

        @if($classroom_id !== 0)

        <div class="card">

            <div class="card-header p-0 mb-3 text-center">
               <img src="{{ Storage::url($classroom->first()->foto) }}" height="200" class="w-100 rounded">
           </div>

           @if(count($classroomUsers) > 0)

           <div class="card-body" style="height: 400px; overflow-y: auto;">

            @if($chatsClassrooms->isEmpty())

            <div class="chat-message text-center mt-5">

                <h4>¡Se el primero en enviar un mensaje!</h4>
                <img src="{{ asset('static/assets/img/classroom-join/pencil.gif') }}" class="img-fluid" width="128" height="128">

            </div>

            @else

            @php
            $lastUserId = null;
            @endphp

            @foreach($chatsClassrooms as $row)

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

@endif




</div>

@else

<div class="card">
    <div class="card-body chat-body" style="height: 400px; overflow-y: auto;">

        <div clasS="col-md-12 text-center py-3">
           <h3><strong>¡Abre un aula para poder comenzar a charlar con tus compañeros!</strong></h3>


           <img src="{{ asset('static/assets/img/classroom-join/bg-9.png') }}" class="img-fluid mt-3">
       </div>

   </div>
</div>
@endif
</div>
</div>