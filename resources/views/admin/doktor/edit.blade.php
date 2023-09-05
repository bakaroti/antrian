@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profile {{ $datas->username }}</p>
                        <div class="d-flex ms-auto me-4">
                            <form action="{{ route('deleteDoktor', ['id' => $datas->id ])}}" method="POST" class="me-2">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                            <a href="{{ URL::Previous() }}"><button class="btn btn-info btn-sm"
                                    type="button">Back</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">Doktor Information</p>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('updateDoktor', ['id' => $datas->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Username</label>
                                    <input id="username" name="username" class="form-control" type="text"
                                        value="{{ $datas->user_id }} - {{ $datas->user->username }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        value="{{ $datas->poly_id }} - {{ $datas->poly->name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div>
                            <button class="btn btn-info btn-sm disabled" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>
@endsection