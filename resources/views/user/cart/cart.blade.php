@extends('user.layout.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $c)
                        <tr>
                            <input type="hidden" value="{{ Auth::user()->id }}" id="userid">
                            <input type="hidden" value="{{ $c->product_id }}" id="productid">
                            <input type="hidden" id="price" value="{{ $c->product_price }}">

                            <td class="align-middle"><img src="{{ asset('storage/'.$c->product_image) }}" alt="" style="width: 50px;" class=" img-thumbnail me-3 ">{{ $c->product_name }}
                                <input type="hidden" value="{{ $c->id}}" class="id">
                            </td>
                            <td class="align-middle">{{ $c->product_price }} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $c->product_price * $c->qty }} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="summary">{{ $totalprice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="delivery">{{ $totalprice + 3000 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 order">Proceed To Checkout</button>
                        <div class="mt-3">
                            <button class="btn btn-block  bg-danger text-white font-weight-bold my-3 py-3" id="clear">Clear Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
            $nodeparent = $(this).parents("tr");
            $price = $nodeparent.find('#price').val();
            $qty = Number($nodeparent.find('#qty').val());
            $total = $price * $qty;
            $nodeparent.find('#total').html(`${$total}`+' Kyats');
            total();
            });
            $('.btn-minus').click(function (){
                $nodeparent = $(this).parents("tr");
                $price = $nodeparent.find('#price').val();
                $qty = Number($nodeparent.find('#qty').val());
                $total = $price * $qty;
                $nodeparent.find('#total').html(`${$total}`+' Kyats');
                total();
            });

            $('.remove').click(function(){
                $node=$(this).parents('tr');
                $id=$node.find('.id').val();
                $.ajax({
                    type:'get',
                    url : 'http://127.0.0.1:8000/user/ajax/removecart',
                    data:{ id : $id },
                    datatype:'json',
                })
                $node.remove();

                total();


            })
            function total(){
                $summary = 0;
                $('.table tr').each(function(index,row){
                    $summary += Number($(row).find('#total').text().replace("Kyats",""));
                })
                $('#summary').html(`${$summary}`);
                $('#delivery').html(`${$summary + 3000}`)

            }

            $('.order').click(function(){
                $data=[];
                $random=Math.floor(Math.random() * 1000000) + 1;
                $('.table tbody tr').each(function(index,row){
                    $data.push({
                        'userid' : $(row).find('#userid').val(),
                        'productid' :$(row).find('#productid').val(),
                        'qty' :$(row).find('#qty').val(),
                        'total' : Number($(row).find('#total').text().replace('Kyats','')),
                        'ordercode' : 'POS'+$random,
                    });

                });

                   $.ajax({
                    type : 'get',
                    data : Object.assign({},$data),
                    url : 'http://127.0.0.1:8000/user/ajax/order',
                    datatype: 'json',
                    success : function(response){
                        if(response.message == 'success'){
                            window.location.href="http://127.0.0.1:8000/user/homePage";
                        }
                    }
                   })


            });

            $('#clear').click(function(){
                $('.table tbody tr').remove();
                $.ajax({
                    type:'get',
                    url : 'http://127.0.0.1:8000/user/ajax/clearcart',
                    datatype:'json',
                })
                total();
            })
        })
    </script>
@endsection
