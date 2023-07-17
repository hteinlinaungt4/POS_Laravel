@extends('admin.layout.master')
@section('title', 'Admin Change')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Admin Account Change</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <form action="{{ route('admin#update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="number" value="{{ $admin->id }}" name="id" hidden>
                                    <div class="col-4 offset-4">
                                        <div class="col-6 offset-3">
                                            @if ($admin->image == null)
                                                <img src="{{ asset('storage/404.jpg') }}" alt=""
                                                    class="img-thumbnail ">
                                            @else
                                                <img src="{{ asset('storage/' . $admin->image) }}" alt=""
                                                    class="img-thumbnail">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-8 mx-auto mt-3">
                                        <form action="{{ route('admin#update') }}" method="POST">
                                            <input type="text" value="{{ $admin->id }}" hidden>
                                            <div class="form-group  mb-3">
                                                <label for="">Name</label>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $admin->name }}">
                                            </div>
                                            <div class="form-group  mb-3">
                                                <label for="">Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="admin"
                                                        @if ($admin->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user"
                                                        @if ($admin->role == 'user') selected @endif>User</option>
                                                </select>
                                            </div>

                                            <div class="form-group  mb-3">
                                                <label for="">Email</label>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $admin->email }}">
                                            </div>
                                            <div class="form-group  mb-3">
                                                <label for="">Phone</label>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $admin->phone }}">
                                            </div>
                                            <div class="form-group  mb-3">
                                                <label for="">Address</label>
                                                <textarea rows="5" class="form-control" disabled>{{ $admin->address }}</textarea>
                                            </div>
                                            <button class="btn btn-primary float-end">Change Role</button>
                                        </form>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
