@extends('sources-chat-classroom')

@section('title')

<title>LearnX | Aulas</title>

@endsection

@section('content')

    @livewire('chats-classrooms',['code' => Route::current()->parameter('code')])

@endsection