@extends('sources-errors')

@section('title')

<title>LearnX | Preparate para realizar el quiz para desbloquear el siguiente modulo</title>

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <!--INFO CONTAINER-->
        <div class="col-lg-4 mt-3">

            <div class="card">

                <img src="{{ Storage::url($curso->image) }}" class="card-img-top" alt="foto clasroom" style="height:20rem">

                <div class="card-body chat-body text-center py-3">

                    <h5 class="card-title mx-5"><strong>{{ $curso->nombre }}</strong></h5>

                    <div class="my-3">
                        <span class="">Tipo:</span>
                        @if($curso->tipo=='premium')
                        <span class="badge bg-label-secondary me-1">Premium</span>
                        @else
                        <span class="badge bg-label-warning me-1">Gratis</span>
                        @endif
                        <span class="">| Categoria:</span>
                         <span class="badge bg-label-primary me-1">{{ $curso->categoria->nombre }}</span>
                    </div>

                    <div class="my-3">
                        <span class=""><strong>Modulo:</strong></span>
                        <span class="text-muted mx-1">{{ $modulo->titulo }}</span>
                    </div>

                    <div class="w-100">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item" style="box-shadow: none;">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><strong>Descripción del curso</strong>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p class="card-text text-justify">{{ $curso->descripcion }}</p>
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
                    <form method="post" action="{{ route('quiz-submit',['id' => Route::current()->parameter('id')]) }}">

                        <!--Cargar preguntas multiples-->
                        @forelse($preguntas as $row)

                        <div class="my-5 d-flex flex-column align-items-start">

                            <!--Pregunta-->   
                            <div>                        
                                <label class="text-start h5"><strong>Pregunta N°{{ $loop->iteration }}:</strong>   {{ $row->pregunta }}</label>
                            </div>


                                <!--Respuestas aleatorias-->
                                @php
                                $respuestas = collect([$row->respuesta_1, $row->respuesta_2, $row->respuesta_3, $row->respuesta_4])->shuffle();
                                @endphp

                                @if(isset($respuestas) && $respuestas->isNotEmpty())
                                <div class="col-md">
                                    @foreach ($respuestas as $respuesta)
                                    @if($respuesta != '')
                                    <div class="d-flex mt-2 mb-4">
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

                              <hr>

                        @empty

                            <div class="text-center mt-4">
                                <td>No hay ninguna pregunta asignada a este quiz :(</td>
                            </div>

                        @endforelse


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

