@extends('sources-dashboard')

@section('title')

<title>LearnX | Miembros unidos al curso</title>

@endsection

@section('content')

    @livewire('curso-presencial-miembros',['id' => Route::current()->parameter('id')])

@endsection