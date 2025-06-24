@extends('sources-errors')

@section('title')

<title>LearnX | Preparate para realizar el examen $examen->nombre </title>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <!--INFO CONTAINER-->
        <div class="col-lg-4 mt-3">

            <div class="card">

                <img src="{{ asset('static/assets/img/classroom-join/bg-3.png') }}" class="card-img-top h-50" alt="foto clasroom">

                <div class="card-body chat-body text-center py-3">

                    <h5 class="card-title mx-5"><strong>{{ $examen->nombre }}</strong></h5>

                    <div class="my-3">
                        <span class="">Tipo:</span>
                        @if($examen->tipo=='clasico')
                        <span class="badge bg-label-success mx-1">Clasico</span>
                        @else
                        <span class="badge bg-label-info mx-1">Multiple</span>
                        @endif
                        <span class="">| Duración:</span>
                        <span class="text-muted mx-1">{{ $examen->lim_tiempo }}m</span>
                    </div>

                    <div class="my-3">
                        <span class=""><strong>Materia:</strong></span>
                        <span class="text-muted mx-1">{{ $examen->materia->nombre}}</span>
                        <br>
                        <span class=""><strong>Tema:</strong></span>
                        <span class="text-muted mx-1">{{ $examen->submateria->nombre}}</span>
                    </div>

                    <div class="w-100">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" style="box-shadow: none;">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>Descripción de la actividad.</strong>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="card-text text-justify">{{ $examen->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Regresar</a>
                </div>
            </div>
        </div>
        <!--END INFO CONTAINER-->

        <!--CONTAINER-->
        <div class="col-lg-8 mt-3">
            <div class="card mx-3 p-4">
                <div class="text-center">
                    <h3 class="my-3"><strong>¡Preparate, un nuevo reto está a punto de comenzar!</strong></h3>
                    <img src="{{ asset('static/assets/img/classroom-join/bg_book.jpg') }}" class="card-img-top w-75" alt="foto clasroom">
                </div>
                <div class="card-body">
                    <span class="badge bg-label-primary my-1"></span>
                    <p class="card-text">¡Recuerda responder todas las preguntas y dar lo máximo!</p>
                    <hr>
                    <form method="post" action="{{ route('examen-submit',['id' => Route::current()->parameter('id')]) }}">

                        <!--Validar el tipo de examen-->
                        @if($examen->tipo=='clasico')

                            <!--Cargar preguntas clasicas-->
                           @forelse($preguntas as $row)

                            <div class="my-5 d-flex flex-column align-items-start">

                                <!--Pregunta-->   
                                <div>                        
                                    <label class="text-start h5"><strong>Pregunta N°{{ $loop->iteration }}:</strong>   {{ $row->pregunta }}</label>
                                </div>

                                <!--Respuesta-->
                                <div class="w-100">
                                    <input type="text" class="form-control mt-2" name="respuesta-{{ $loop->iteration }}" placeholder="Respuesta de la pregunta {{ $loop->iteration }}..." required>
                                </div>

                                <!-- ID pregunta-->
                                <input type="hidden" name="pregunta-{{ $loop->iteration }}" value="{{ $row->id }}">

                            </div>

                            <hr>

                            @empty

                            <div class="text-center mt-4">
                                <td>No hay ninguna pregunta asignada a este examen :(</td>
                            </div>

                            @endforelse


                        @else

                        <!--Cargar preguntas multiples-->
                        @forelse($preguntas as $row)

                            <div class="text-center my-5">

                                <!--Pregunta-->
                                <h4>Pregunta N°{{ $loop->iteration }}:   {{ $row->pregunta }}</h4>

                                <!--Respuestas aleatorias-->
                                @php
                                $respuestas = collect([$row->respuesta_1, $row->respuesta_2, $row->respuesta_3, $row->respuesta_4])->shuffle();
                                @endphp

                                @if(isset($respuestas) && $respuestas->isNotEmpty())
                                <div class="col-md">
                                    @foreach ($respuestas as $respuesta)
                                    @if($respuesta != '')
                                    <div class="d-flex ms-4 mb-4">
                                        <input class="form-check-input" type="radio" name="respuesta-{{ $row->id }}" id="inlineRadio-{{ $loop->iteration }}-{{ $loop->index }}" value="{{ $respuesta }}"/>
                                        <label class="form-check-label ms-2" for="inlineRadio-{{ $loop->iteration }}-{{ $loop->index }}">{{ $respuesta }}</label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>

                                @endif

                                <!-- ID pregunta-->
                                <input type="hidden" name="pregunta-{{ $loop->iteration }}" value="{{ $row->pregunta }}">
                            </div>

                        @empty

                            <div class="text-center mt-4">
                                <td>No hay ninguna pregunta asignada a este examen :(</td>
                            </div>

                        @endforelse


                        <!--End validación de tipo de examen-->
                        @endif


                        <!--Verificar si hay preguntas en el examen-->
                        @if($preguntas->isNotEmpty())

                        <div class="mt-5">
                            <button class="btn btn-primary">¡Enviar!</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar examen</a>
                        </div>

                        @endif
                        <!--Fin validación-->


                        @csrf

                    </form>
                </div>
            </div>
        </div>
        <!--END CONTAINER-->


    </div>
</div>

@endsection

