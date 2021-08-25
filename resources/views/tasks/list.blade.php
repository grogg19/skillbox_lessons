@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Задачи
    </h3>
    @if ($tasks->isNotEmpty())
        @each('tasks.item', $tasks, 'task')

        <div class="blog-post">
            {{ $tasks->links() }}
        </div>
    @else
    <div class="blog-post">
        <h2>Список задач пуст</h2>
    </div>
    @endif
@endsection
