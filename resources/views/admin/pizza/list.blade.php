@extends('admin.layout.master')
@section('title', 'Category List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createpage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        Searh Key:<span class="text-danger"> {{ request('search') }}</span>
                                    </div>
                                    <div class="col-2 bg-light offset-2">
                                        Total: <span class="fs-5">{{ $product->total() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <form class="form-header float-end" action="" method="get">
                                    <input class="au-input au-input--sm" type="text" name="search"
                                        placeholder="Search for datas &amp; reports..." value="{{ request('search') }}" />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    @if (session('deleteMsg'))
                    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                        {{ session('deleteMsg' )}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="table-responsive table-responsive-data2 mt-3">
                        @if ($product->total() != 0)
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>PRICE</th>
                                        <th>CATEGORY</th>
                                        <th>VIEW COUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $products)
                                        <tr class="tr-shadow">
                                            <td class="w-25">
                                                <img src="{{ asset('storage/' . $products->image) }}" alt=""
                                                    class="img-thumbnail w-75 border-0">
                                            </td>
                                            <td>{{ $products->name }}</td>
                                            <td>{{ $products->price }}</td>
                                            <td>{{ $products->category_name }}</td>
                                            <td>{{ $products->view_count }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <a href="{{ route('product#detail',$products->id) }}">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </a>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <a href="{{ route('product#edit',$products->id) }}">
                                                            <i class="zmdi zmdi-edit ">
                                                            </i>
                                                        </a>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <a href="{{ route('product#delete',$products->id) }}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                                {{ $product->appends(request()->query())->links() }}
                            </table>
                        @else
                             <h1 class=" text-muted text-center fs-3 my-5">There is no Category here</h1>
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection


