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
        @include('tasks.partials.form')
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
