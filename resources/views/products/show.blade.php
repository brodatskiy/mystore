@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex p-3">
                        <div class="mr-3">
                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary">
                                Edit
                            </a>
                        </div>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">

                            <tr>
                                <td>ID</td>
                                <td>{{ $product->id }}</td>
                            </tr>

                            <tr>
                                <td>Title</td>
                                <td>{{ $product->title }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <td>Content</td>
                                <td>{{ $product->content }}</td>
                            </tr>
                            <tr>
                                <td>Preview image</td>

                                <td><img class="w-25 h-25" src="{{ asset('storage/' . $product->preview_image) }}" alt="123"> </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <td>Count</td>
                                <td>{{ $product->count }}</td>
                            </tr>
                            <tr>
                                <td>Is published</td>
                                <td>{{ $product->is_published ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>{{ $product->category->title }}</td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>
                                    @foreach($tags as $tag)
                                    <span class="badge badge-primary">{{ $tag->title }}</span>
                                    @endforeach
                                </td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->

</section>
<!-- /.content -->
@endsection
