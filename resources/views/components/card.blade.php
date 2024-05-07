<div class="d-flex flex-row ">
    @foreach ($products as $product)
    <a href="{{route('platform.products.view', $product->id)}}">
        <div class="card mx-1" style="width: 6rem;">
            <img src='{{$product->preview_image}}' class="card-img-top" alt="{{$product->title}}">
            <div class="" style="height: 2rem;">
            <h6 class="p-1">{{$product->title}}</h6>
            </div>
        </div>
    </a>
    @endforeach
</div>
