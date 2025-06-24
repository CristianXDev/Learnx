@extends('sources-dashboard')

@section('title')

<title>LearnX | Examenes</title>

@endsection

@section('content')

    @livewire('examenes-multiples',['id' => Route::current()->parameter('id')])

@endsection