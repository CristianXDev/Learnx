@extends('sources-dashboard')

@section('title')

<title>LearnX | Preguntas</title>

@endsection

@section('content')

    @livewire('examenes-quest',['id' => Route::current()->parameter('id')])

@endsection