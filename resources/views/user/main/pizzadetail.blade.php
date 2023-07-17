@extends('user.layout.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100 img-thumbnail object-cover" src="{{ asset('storage/' . $pizza->image) }}"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" id="userid">
            <input type="hidden" value="{{ $pizza->id }}" id="pizzaid">
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-eye fs-5 text-black"></small>
                            <small class="fs-5 text-bold text-black">{{ $pizza->view_count +1 }}</small>
                        </div>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} Kyats</h3>
                    <p class="mb-4">{{ Str::words($pizza->description, 10, '...') }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" min="1" class="form-control bg-secondary border-0 text-center" value="1"  id="count">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="cart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzas as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <div class="" style="height: 350px;">
                                    <img class="img-fluid w-100 h-100" src="{{ asset('storage/' . $p->image) }}"
                                        alt="" style="object-fit:cover">
                                </div>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5>
                                    <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/viewcount',
                datatype : 'json',
                data : {
                    'pizzaid' : $('#pizzaid').val(),
                },
            })




            $('#cart').click(function(){
                $data={
                    'count' : $('#count').val(),
                    'pizzaid' : $('#pizzaid').val(),
                    'userid' : $('#userid').val(),
                }
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/cart',
                datatype : 'json',
                data : $data,
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href="http://127.0.0.1:8000/user/homePage";
                    }
                }


                })
            })
        })
    </script>
@endsection
