@extends('layout.main_small')

@section('title', 'Отправка сообщения')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Отправка сообщения через PushAll
    </h3>
    @include('partials.errors')
    <form method="post" action="{{ route('pushall.send') }}">
        @csrf
        @include('pushall.partials.form')
    </form>
@endsection
