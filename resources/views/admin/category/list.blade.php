@extends('admin.layout.master')
@section('title','Category List')
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
                            <h2 class="title-1">Category List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createpage')}}">
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
                                Total:  <span class="fs-5">{{ $categories->total() }}</span>
                            </div>
                           </div>
                        </div>
                        <div class="col-6">
                                <form class="form-header float-end" action="" method="get">
                                    <input class="au-input au-input--sm" type="text" name="search" placeholder="Search for datas &amp; reports..."  value="{{ request('search') }}"/>
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>

                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    @if ($categories->total() != 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CATEGORY NAME</th>
                                <th>CREATED DATE</th>
                                <th class="float-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                           <tr class="tr-shadow">
                            <td>{{ $category->id }}</td>
                            <td>
                                <span class="block-email">{{ $category->name }}</span>
                            </td>
                            <td>{{ $category->created_at->format('d-F-y') }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <a href="{{route('category#editpage',$category->id)}}">
                                            <i class="zmdi zmdi-edit "></i>
                                        </a>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <a href="{{ route('category#delete',$category->id) }}">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                           @endforeach
                            <tr class="spacer"></tr>

                        </tbody>
                    </table>
                    @else
                        <h1 class=" text-muted text-center fs-3 my-5">There is no Category here</h1>
                    @endif
                    {{ $categories->appends(request()->query())->links()}}
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
