@extends('admin.layout.master')
@section('title','Category Create')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Create Form</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" value="{{ old('pizzaName') }}" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza...">
                                @error('pizzaName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" id="" class="form-control @error('category') is-invalid @enderror" >
                                    <option value="">Choose Category</option>
                                    @foreach ($cat as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Description ...">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input type="number" value="{{ old('price')}}" name="price" class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100 my-3">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
