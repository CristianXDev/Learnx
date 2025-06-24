@extends('sources-classroom-join')

@section('title')

<title>LearnX | Aceptar invitación de ingreso</title>

@endsection

@section('content')

<div class="d-flex justify-content-center align-content-center mt-5">
    <div class="card p-4" style="width: 23rem;">
        <h5 class="my-3">¿Quieres unirte a esta aula?</h5>
        <img src="{{ Storage::url($classroom->foto) }}" class="card-img-top h-50" alt="foto clasroom">
        <div class="card-body">
            <h5 class="card-title">{{ $classroom->nombre }}</h5>
            <span class="badge bg-label-primary my-1"></span>
            <p class="card-text">{{ Str::limit($classroom->descripcion, 300, '...') }}</p>
            <a href="{{  route('classroom-accept',['codigo' => $classroom->codigo_acceso ]) }}" class="btn btn-primary">Sí, estoy seguro</a>
            <a href="{{ route('classroom_public') }}" class="btn btn-secondary">Regresar</a>
            
        </div>
    </div>
</div>

@endsection

