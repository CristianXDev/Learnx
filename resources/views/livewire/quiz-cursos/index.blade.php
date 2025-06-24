@extends('sources-dashboard')

@section('title')

<title>LearnX | Quizz Modulo</title>

@endsection

@section('content')

    @livewire('quiz-cursos',['id' => Route::current()->parameter('id')])

@endsection