@extends('admin.layout.master')
@section('title', 'Account Edit')
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
                                <h3 class="text-center title-2">Account Detail Edit Page</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <form action="{{ route('account#update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-4 offset-4">
                                        <div class="col-6 offset-3">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('/storage/404.jpeg') }}" alt="John Doe" />
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="John Doe" />
                                            @endif
                                        </div>
                                        <input type="file" class="form-control mt-3" name="image">
                                    </div>
                                    <div class="col-8 offset-1 fw-bold mx-auto">
                                        <div class="mb-4">
                                            <div class="form-group my-3">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value=" {{ old('name', Auth::user()->name) }}">
                                            </div>

                                        </div>
                                        <div class="mb-4">
                                            <label for="">Email</label>
                                            <input type="text" name="email" class="form-control"
                                                value=" {{ old('name', Auth::user()->email) }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value=" {{ old('name', Auth::user()->phone) }}">
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Address</label>
                                            <textarea name="address" class="form-control" rows="5">{{ old('name', Auth::user()->address) }}</textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Role</label>
                                            <input type="input" class="form-control" value=" {{ Auth::user()->role }}"
                                                disabled>
                                        </div>
                                        <button class="btn btn-primary w-100">Edit Profile</button>
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
