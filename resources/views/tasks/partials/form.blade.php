<div class="form-group">
    <label for="title">Название задачи:</label>
    <input type="text" class="form-control data-source-slugify" id="title" name="title" placeholder="Введите название задачи" value="{{ old('title', $task->title ?? '') }}" />
</div>
<div class="form-group">
    <label for="body">Описание задачи:</label>
    <textarea class="form-control" id="body" rows="3" name="body">{{ old('body', $task->body ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Теги:</label>
    <input type="text"
           class="form-control"
           id="tags"
           name="tags"
           placeholder="Теги"
           @if (isset($task))
           value="{{ old('tags', $task->tags->pluck('name'))->implode(',') }}" />
           @else
           value="{{ old('tags')}}" />
           @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
