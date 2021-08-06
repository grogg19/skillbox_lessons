@component('mail::message')
# Создана новая задача: {{ $task->title }}

{{ $task->body }}

@component('mail::button', ['url' => route('tasks.show', $task)])
Посмотреть задачу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
