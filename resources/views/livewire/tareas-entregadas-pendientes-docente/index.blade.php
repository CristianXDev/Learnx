@extends('sources-dashboard')

@section('title')

<title>LearnX | Tareas Etregadas</title>

@endsection

@section('content')

    @livewire('tareas-entregadas-pendientes-docente',['id' => Route::current()->parameter('id')])

@endsection