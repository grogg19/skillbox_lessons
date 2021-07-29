@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Задачи
    </h3>
    @if (count($tasks) > 0)
    @foreach($tasks as $task)
        @include('tasks.item')
    @endforeach
    @else
    <div class="blog-post">
        <h2>Список задач пуст</h2>
    </div>
    @endif
@endsection
