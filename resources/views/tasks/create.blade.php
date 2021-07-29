@extends('layout.main')

@section('title', 'Создать новую задачу')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой задачи
    </h3>
    @include('partials.errors')
    <form method="post" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Название задачи:</label>
            <input type="text" class="form-control data-source-slugify" id="title" name="title" placeholder="Введите название задачи" value="{{ old('title') }}"/>
        </div>
        <div class="form-group">
            <label for="excerpt">Описание задачи:</label>
            <textarea class="form-control" id="body" rows="3" name="body">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
