<div class="blog-post">
    <h2 class="blog-post-title">{{ $task->title }}</h2>

    @include('tags.list', ['tags' => $task->tags])

    <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>
    <p>{{ $task->body }}</p>
    <a href="{{ route('tasks.show', ['task' => $task->id]) }}">Посмотреть задачу</a>
</div>
