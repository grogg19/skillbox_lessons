@extends('layout.main')

@section('title', 'Создать новую задачу')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой задачи
    </h3>
    @include('partials.errors')
    <form method="post" action="{{ route('tasks.store') }}">
        @csrf
        @include('tasks.partials.form')
    </form>
@endsection
