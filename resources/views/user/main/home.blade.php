@extends('user.layout.master')
@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3 bg-dark py-2 px-3 text-warning">
                        <a href="{{ route('userhome')}}"><label class="mt-2" for="price-all">All Category</label></a>
                        <span class="badge border font-weight-normal">{{ count($category) }}</span>
                    </div>
                    @foreach ($category as $cat)
                    <div class="d-flex align-items-center justify-content-between mb-2">
                       <a href="{{ route('user#catfilter',$cat->id)}}"> <label class="text-black" for="price-5">{{ $cat->name }}</label></a>
                        {{-- <span class="badge border font-weight-normal">168</span> --}}
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                       <div class="">
                            <a href="{{ route('User#cartPage')}}">
                                <button type="button" class="btn btn-primary position-relative">
                                <i class="fa fa-shopping-cart"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart)}}
                                    <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button>
                            </a>
                            <a href="{{ route('user#history')}}" class="ms-3">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($order) }}
                                    <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button>
                            </a>
                       </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sort" id="sortbtn" class="form-control">
                                    <option value="">Choose Sort</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($product) !=0)
                <div id="list" class="row">
                    @foreach ($product as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 img-thumbnail border-0" style="height: 350px; object-fit:cover;" src="{{ asset('storage/'.$p->image) }}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzalist',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price}}kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="d-flex justify-content-center align-content-center mt-5">
                        <h1 class="align-self-center mt-5 text-muted">Today have not pizza</h1>
                    </div>
                @endif
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        // $.ajax({
        //     type:'get',
        //     url:'http://127.0.0.1:8000/user/ajax/product',
        //     datatype:'json',
        //     success : function(response){
        //         console.log(response);
        //     }
        // })
        $('#sortbtn').change(function(){
            $eventoption=$('#sortbtn').val();
            if($eventoption == "asc"){
                $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/user/ajax/product',
                        datatype:'json',
                        data:{'status' : 'asc'},
                        success : function(response){
                          $list='';
                          for (let i = 0; i < response.length; i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 350px; object-fit:cover;" src="{{ asset('storage/${response[i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[i].price}kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                          }
                          $('#list').html($list);
                        }
                    })
            }else if($eventoption == "desc"){
                $.ajax({
                        type:'get',
                        url:'http://127.0.0.1:8000/user/ajax/product',
                        datatype:'json',
                        data:{'status' : 'desc'},
                        success : function(response){
                            $list='';
                          for (let i = 0; i < response.length; i++) {
                            $list +=
                            `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 350px; object-fit:cover;" src="{{ asset('storage/${response[i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[i].price}kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `

                          }
                          $('#list').html($list);
                        }
                    })
            }
        })
    })
</script>
@endsection
