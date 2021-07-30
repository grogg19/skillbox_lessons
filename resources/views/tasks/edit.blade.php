@extends('layout.main')

@section('title', 'Редактирование задачи')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Редактирование задачи
    </h3>
    @include('partials.errors')
    <form method="post" action="{{ route('tasks.update', ['task' => $task->id]) }}">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="title">Название задачи:</label>
            <input type="text" class="form-control data-source-slugify" id="title" name="title" placeholder="Введите название задачи" value="{{ old('title', $task->title) }}" />
        </div>
        <div class="form-group">
            <label for="excerpt">Описание задачи:</label>
            <textarea class="form-control" id="body" rows="3" name="body">{{ old('body', $task->body) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">Теги:</label>
            <input type="text"
                   class="form-control"
                   id="tags"
                   name="tags"
                   placeholder="Теги"
                   value="{{ old('tags', $task->tags->pluck('name'))->implode(',') }}" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
    <form method="post" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
        @csrf
        @method('delete')
        <div class="form-group">
            <a class="btn btn-primary" href="{{ route('page.main') }}">К списку задач</a>
            <button type="submit" class="btn btn-dark"><i class="fas fa-trash-alt"></i></button>
        </div>
    </form>
@endsection
