@extends('layout.main')

@section('title', 'Задача | ' . $task->title )

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Детальная страница статьи
    </h3>
    <h1>{{ $task->title }}</h1>
    <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>
    {{ $task->body }}
    <div class="mt-4">
        <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">Изменить <i class="fas fa-edit"></i></a>
    </div>
@endsection
