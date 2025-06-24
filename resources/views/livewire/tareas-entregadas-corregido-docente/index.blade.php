@extends('sources-dashboard')

@section('title')

<title>LearnX | Tareas Etregadas</title>

@endsection

@section('content')

    @livewire('tareas-entregadas-corregido-docente',['id' => Route::current()->parameter('id')])

@endsection