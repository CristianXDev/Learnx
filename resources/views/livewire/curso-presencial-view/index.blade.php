@extends('sources-dashboard')

@section('title')

<title>LearnX | Curso presencial</title>

@endsection

@section('content')

    @livewire('curso-presencial-view',['id' => Route::current()->parameter('id')])

@endsection