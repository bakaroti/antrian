@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex">
                        <h6>Create User</h6>
                        <a href="{{ URL::Previous() }}" class=" ms-auto me-4"><button class="btn btn-info btn-sm"
                                type="button">Back</button></a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form role="form" action=" {{ route('storeAdmin') }}" method="POST">
                        @csrf
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label id="username" for="username">Username</label>
                                    <input type="username" id="username" name="username" class="form-control"
                                        id="username" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <label id="name" for="name">Name</label>
                                    <input type="name" id="name" name="name" class="form-control" id="name"
                                        placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6 text-center justify-content-center mx-auto">

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info btn-lg">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>

@endsection

@section('require')
@include('admin/user/script')
@endsection