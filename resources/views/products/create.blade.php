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

            <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <input type="text" value="{{ old('title') }}" name="title" class="form-control @error('title') ? is-invalid : is-valid @enderror" placeholder="Type product title">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input type="text" value="{{ old('description') }}" name="description" class="form-control @error('description') ? is-invalid : is-valid @enderror" placeholder="Type product description">
                </div>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <textarea name="content" class="form-control @error('content') ? is-invalid : is-valid @enderror" cols="30" rows="3" placeholder="Type product content">{{ old('content') }}</textarea>
                </div>
                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input type="text" value="{{ old('price') }}" name="price" class="form-control @error('price') ? is-invalid : is-valid @enderror" placeholder="Price">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <input type="text" value="{{ old('count') }}" name="count" class="form-control @error('count') ? is-invalid : is-valid @enderror" placeholder="Count">
                </div>
                @error('count')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="preview_image" type="file" class="custom-file-input @error('preview_image') ? is-invalid : is-valid @enderror" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                @error('preview_image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <select name="category_id" class="form-control select2 @error('category_id') ? is-invalid : is-valid @enderror" style="width: 100%;">
                        <option selected disabled>Choose category</option>
                        @foreach($categories as $category)
                        <option @selected(old('category_id')==$category->id) value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Select a tags" style="width: 100%;">
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', [])))>{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add">
                </div>

            </form>

        </div>
    </div>

    <!-- /.row -->

</section>
<!-- /.content -->
@endsection
