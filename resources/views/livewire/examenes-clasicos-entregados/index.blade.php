@extends('sources-dashboard')

@section('title')

<title>LearnX | Corrección de respuesta</title>

@endsection

@section('content')

    @livewire('examenes-clasicos-entregados',['id' => Route::current()->parameter('id')])

@endsection