@extends('sources-dashboard')

@section('title')

<title>LearnX | Modulos cursos</title>

@endsection

@section('content')

    @livewire('modulos-cursos',['id' => Route::current()->parameter('id')])

@endsection