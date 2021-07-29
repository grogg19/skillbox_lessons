@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())
    <div class="mb-2">
        @foreach($tags as $tag)
            <a href="#" class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif