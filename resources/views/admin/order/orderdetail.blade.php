@extends('admin.layout.master')
@section('title', 'Order List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                        <button class="float-end"><a href="{{ route('order#listpage') }}" class="btn btn-sm fs-4"> << Back </a></button>
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order Detail List</h2>
                            </div>
                                <div class="card p-5 mt-3 shadow-sm opacity-75">
                                    <div class="card-title">
                                       <h3>Voucher</h3>
                                       <div class="text-warning mt-2">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            include delivery charge.
                                       </div>
                                       <hr>
                                    </div>
                                    <div class="card-body">
                                        <div class="fs-5">
                                            <i class="fa-solid fa-barcode me-5"></i>
                                            {{ $totalorder[0]->orderCode }}
                                        </div>
                                        <div class="fs-5">
                                            <i class="fa-solid fa-money-bill-1-wave me-5"></i>
                                            {{ $totalorder[0]->total_price }}
                                        </div>
                                        <div class="fs-5">
                                            <i class="fa-solid fa-clock-rotate-left me-5"></i>
                                            {{ $totalorder[0]->created_at->format('d/F/y') }}
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="table-responsive table-responsive-data2 mt-3">
                            <table class="table-data2 table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>User Name</th>
                                        <th>Order Code</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o)
                                    <tr class="tr-shadow ">
                                        <td>
                                            <img src="{{ asset('storage/'.$o->pimage)}}" alt="" class=" img-thumbnail border-0" style="height: 100px;">
                                            {{ $o->pname }}
                                        </td>
                                        <td>{{ $o->username }}</td>
                                        <td>{{ $o->orderCode }}</a></td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}</td>

                                        <td>{{ $o->created_at->format('d/F/Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->

    @endsection
