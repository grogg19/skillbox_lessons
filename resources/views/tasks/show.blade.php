@extends('layout.main')

@section('title', 'Задача | ' . $task->title )

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Детальная страница статьи
    </h3>
    <h1>{{ $task->title }}</h1>

    @include('tags.list', ['tags' => $task->tags])

    <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>

    {{ $task->body }}

    @can('update', $task)
    @if($task->steps->isNotEmpty())
    <ul class="list-group mt-3">
        @foreach($task->steps as $step)
            <li class="list-group-item">
                <form method="post" action="/completed-steps/{{ $step->id }}">
                    @csrf
                    @if($step->completed)
                        @method('delete')
                    @endif
                    <div class="form-check">
                        <label class="form-check-label {{ $step->completed ? 'completed' : '' }}">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="completed"
                                onclick="this.form.submit()"
                                {{ $step->completed ? 'checked' : '' }}
                            />
                            {{ $step->description }}
                        </label>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
    @endif
    @include('partials.errors')
    <form class="card card-body my-4 pt-0" method="post" action="{{ route('task.step.store', ['task' => $task]) }}">
        @csrf
        <div class="form-group">
            <label for="description"></label>
            <input type="text"
                   class="form-control"
                   placeholder="Шаг"
                   value="{{ old('description') }}"
                   name="description"
                   id="description"
            />
        </div>
        <button type="submit" class="btn btn-primary">Добавить </button>
    </form>
    @endcan
    <div class="my-4">
        @can('update', $task)
        <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">Изменить <i class="fas fa-edit"></i></a>
        @endcan
    </div>
@endsection
