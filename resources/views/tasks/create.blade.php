@extends('layout.main')

@section('title', 'Создать новую задачу')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Добавление новой задачи
    </h3>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('task.save') }}">
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
