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
                            <h2 class="title-1">Admin Accounts List</h2>
                        </div>
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
                                Total:  <span class="fs-5"> {{ $admin->total() }}</span>
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
                <div class="table-responsive table-responsive-data2 mt-3">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    @if ( $a->image == null)
                                        <img src="{{ asset('/storage/404.jpeg') }}" alt="" class="img-thumbnail border-0">
                                    @else
                                        <img src="{{ asset('storage/'.$a->image) }}" alt="" class="img-thumbnail border-0">
                                    @endif
                                </td>
                                <td>
                                    {{$a ->name}}
                                </td>
                                <td>
                                    {{ $a->email }}
                                </td>
                                <td>
                                    {{ $a->phone }}
                                </td>
                                <td>
                                    {{ $a->address }}
                                    <input type="text" value="{{ $a->id }}" id="userid">
                                </td>
                                @if ($a->id !== Auth::user()->id)
                                <td>
                                    <div class="table-data-feature">
                                        <select name="" id="" class="form-control me-3 status">
                                            <option value="admin" @if($a->role == "admin") selected @endif>Admin</option>
                                            <option value="user" @if($a->role == "user") selected @endif>User</option>
                                        </select>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="{{ route('admin#delete',$a->id) }}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </button>
                                    </div>
                                </td>
                                @else
                                <td></td>
                                @endif

                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach




                        </tbody>
                    </table>
                {{ $admin->appends(request()->query())->links() }}



                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.status').change(function(){
            $status=$(this).val();
            $parent=$(this).parents('tr');
            $id=$parent.find('#userid').val();
            $data={
                'userid' : $id,
                'role' : $status,
            }
            $.ajax({
                type : 'get',
                datatype : 'json',
                data :$data,
                url : 'http://127.0.0.1:8000/admin/ajaxadminrolechange',
                success : function(response){
                        if(response.message == 'success'){
                            window.location.href = "http://127.0.0.1:8000/admin/list";
                        }
                    }


            })
        })
    })
</script>

@endsection
