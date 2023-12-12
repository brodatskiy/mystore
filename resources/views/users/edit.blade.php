@extends('layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User</h1>
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


            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="form-group">
                    <input type="text" value="{{ $user->name ?? old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Type user name">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{ $user->email ?? old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Type user email">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="text" value="{{$user->surname ?? old('surname') }}" name="surname" class="form-control" placeholder="Type user surname">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$user->patronymic ?? old('patronymic') }}" name="patronymic" class="form-control" placeholder="Type user patronymic">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$user->age ?? old('age') }}" name="age" class="form-control" placeholder="Type user age">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$user->address ?? old('address') }}" name="address" class="form-control" placeholder="Type user address">
                </div>

                <div class="form-group">
                    <select class="form-control select2 @error('gender') ? is-invalid : is-valid @enderror" name="gender">
                        <option disabled selected>Gender</option>
                        <option value="1" @selected(old('gender', $user->gender) == 1) >Мужской
                        </option>
                        <option value="2" @selected(old('gender', $user->gender) == 2) >Женский
                        </option>
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
                        <option @selected(old('role', $user->role) == $id) value="{{ $id }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Edit">
                </div>
            </form>
        </div>
    </div>

    <!-- /.row -->

</section>
<!-- /.content -->
@endsection
