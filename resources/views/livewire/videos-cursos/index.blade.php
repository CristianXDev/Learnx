@extends('sources-dashboard')

@section('title')

<title>LearnX | videos</title>

@endsection

@section('content')

    @livewire('videos-cursos',['id' => Route::current()->parameter('id')])

@endsection
