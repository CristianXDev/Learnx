@extends('sources-dashboard')

@section('title')

<title>LearnX | Actividades curso</title>

@endsection

@section('content')

    @livewire('actividades-curso-presencials',['id' => Route::current()->parameter('id')])

@endsection