@foreach ($tags as $tag)
    <div class="fs-6">
        <span class="badge bg-light text-dark">{{$tag->title}}</span>
    </div>
@endforeach
