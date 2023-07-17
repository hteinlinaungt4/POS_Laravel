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
                                <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="number" value="{{ $product->id }}" name="id" hidden>
                                    <div class="col-4 offset-4">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                        <input type="file"
                                            class="form-control my-3 @error('image') is-invalid @enderror " name="image">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-8 offset-1 fw-bold mx-auto">
                                        <div class="mb-4">
                                            <div class="form-group my-3">
                                                <label for="">Name</label>
                                                <input type="text" name="pizzaName" class="form-control @error('pizzaName') is-invalid @enderror" value=" {{ old('name', $product->name) }}">
                                                @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Description</label>
                                            <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
                                            @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="">Category</label>
                                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        @if ($cat->id == $product->category_id) selected @endif>
                                                        {{ $cat->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                             @enderror
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group my-3">
                                                <label for="">Price</label>
                                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $product->price) }}">
                                                    @error('category')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group my-3">
                                                <label for="">View Count</label>
                                                <input type="number" name="viewcount" class="form-control" readonly
                                                    value="{{ $product->view_count }}">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-group my-3">
                                                <label for="">Created at</label>
                                                <input type="text" name="" class="form-control" readonly
                                                    value="{{ $product->created_at }}">
                                            </div>
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
