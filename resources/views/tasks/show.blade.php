@extends('layout.main')

@section('title', 'Задача | ' . $task->title )

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Детальная страница статьи
    </h3>
    <h1>{{ $task->title }}</h1>
    <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>
    {{ $task->body }}

    @if($task->steps->isNotEmpty())
    <ul class="list-group mt-3">
        @foreach($task->steps as $step)
            <li class="list-group-item">{{ $step->description }}</li>
        @endforeach
    </ul>
    @endif
    <div class="mt-4">
        <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">Изменить <i class="fas fa-edit"></i></a>
    </div>
@endsection
