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
                    <form role="form" action=" {{ route('storeUser') }}" method="POST">
                        @csrf
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label id="username" for="username">Username</label>
                                    <input type="username" id="username" name="username" class="form-control"
                                        id="username" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label id="firstname" for="firstname">Firstname</label>
                                    <input type="text" name="firstname" class="form-control" id="firstname"
                                        placeholder="Firstname" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname"
                                        placeholder="Lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" id="country"
                                        placeholder="Country" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label id="city" for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="City"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                        placeholder="Address" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="postal">Postal</label>
                                    <input type="text" name="postal" class="form-control" id="postal"
                                        placeholder="Postal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2 justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="role">Select Role</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->id }} - {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info btn-sm">Submit</button>
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