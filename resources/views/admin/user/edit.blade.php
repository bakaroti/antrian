@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profile {{ $datas->username }} | ID : {{ $datas->id }}</p>
                        <div class="d-flex ms-auto me-4">
                            <form action="{{ route('deleteUser', ['id' => $datas->id ])}}" method="POST" class="me-2">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                            <a href="{{ URL::Previous() }}"><button class="btn btn-info btn-sm"
                                    type="button">Back</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('updateUser', ['id' => $datas->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Username</label>
                                    <input id="username" name="username" class="form-control" type="text"
                                        value="{{ $datas->username }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        value="{{ $datas->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input id="firstname" name="firstname" class="form-control" type="text"
                                        value="{{ $datas->firstname }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <input id="lastname" name="lastname" class="form-control" type="text"
                                        value="{{ $datas->lastname }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Role Account</label>
                                    <input id="lastname" name="lastname" class="form-control" type="text"
                                        value="{{ $datas->role }}" disabled>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Role Account</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role_id">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id === $datas->role_id) selected
                                            @endif>
                                            {{ $role->id }} - {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Address</label>
                                    <input id="address" name="address" class="form-control" type="text"
                                        value="{{ $datas->address }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">City</label>
                                    <input id="city" name="city" class="form-control" type="text"
                                        value="{{ $datas->city }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Country</label>
                                    <input id="country" name="country" class="form-control" type="text"
                                        value="{{ $datas->country }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Postal code</label>
                                    <input id="postal" name="postal" class="form-control" type="text"
                                        value="{{ $datas->postal }}">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div>
                            <button class="btn btn-info btn-sm" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection