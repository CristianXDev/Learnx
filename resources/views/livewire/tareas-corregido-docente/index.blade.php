@extends('sources-dashboard')

@section('title')

<title>LearnX | Tareas</title>

@endsection

@section('content')

    @livewire('tareas-corregido-docente',['id' => Route::current()->parameter('id')])

@endsection