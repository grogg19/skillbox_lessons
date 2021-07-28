@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Задачи
    </h3>
    @if (empty($tasks))
    @foreach($tasks as $task)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $task->title }}</h2>
            <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>
            <p>{{ $task->body }}</p>
            <a href="{{ route('task.show', ['slug' => $task->id]) }}">Читать задачу</a>
        </div>
    @endforeach
    @else
    <div class="blog-post">
        <h2>Список задач пуст</h2>
    </div>
    @endif
@endsection
