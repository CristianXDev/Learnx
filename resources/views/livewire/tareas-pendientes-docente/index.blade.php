@extends('sources-dashboard')

@section('title')

<title>LearnX | Tareas</title>

@endsection

@section('content')

    @livewire('tareas-pendientes-docente',['id' => Route::current()->parameter('id')])

@endsection