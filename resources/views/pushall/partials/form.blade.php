<div class="form-group">
    <label for="inputTitle">Заголовок сообщения:</label>
    <input type="text" class="form-control data-source-slugify" id="inputTitle" name="title" placeholder="Введите заголовок" value="{{ old('title') }}" />
</div>
<div class="form-group">
    <label for="inputText">Текст сообщения:</label>
    <textarea class="form-control" id="inputText" rows="3" name="text">{{ old('text') }}</textarea>
</div>
<div class="form-group mb-5">
    <button type="submit" class="btn btn-primary">Отправить</button>
</div>
