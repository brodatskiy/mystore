@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
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
            <form action="{{ route('users.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') ? is-invalid : is-valid @enderror" placeholder="Type user name">

                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Type user email">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ old('surname') }}" name="surname" class="form-control @error('surname') is-invalid @enderror" placeholder="Type user surname">
                </div>
                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ old('patronymic') }}" name="patronymic" class="form-control @error('patronymic') is-invalid @enderror" placeholder="Type user patronymic">
                </div>
                @error('patronymic')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ old('age') }}" name="age" class="form-control @error('age') is-invalid @enderror" placeholder="Type user age">
                </div>
                @error('age')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ old('address') }}" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Type user address">
                </div>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option disabled selected>Gender</option>
                        <option {{ old('gender') == 1 ? 'selected' : ''}} value="1">Мужской</option>
                        <option {{ old('gender') == 2 ? 'selected' : ''}} value="2">Женский</option>
                    </select>
                </div>
                @error('gender')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control select2 @error('role') ? is-invalid : is-valid @enderror" style="width: 100%;">
                        <option selected disabled>Choose role</option>
                        @foreach($roles as $id => $role)
                        <option @selected(old('role') == $id) value="{{ $id }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

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
