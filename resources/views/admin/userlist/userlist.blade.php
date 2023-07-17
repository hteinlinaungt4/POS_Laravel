@extends('admin.layout.master')
@section('title','Users Lists')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <span class="fs-3 float-end fw-bold">Total: {{ count($users) }}</span>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User Account Lists</h2>
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
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    @if ( $user->image == null)
                                        <img src="{{ asset('/storage/404.jpeg') }}" alt="" class="img-thumbnail border-0">
                                    @else
                                        <img src="{{ asset('storage/'.$user->image) }}" alt="" class="img-thumbnail border-0">
                                    @endif
                                </td>
                                <td>
                                    <input type="text" id="userid" value="{{ $user->id }}">
                                    {{$user ->name}}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                                <td>
                                    {{ $user->address }}
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <select name="" class="form-control status me-3">
                                            <option value="admin" @if($user->role == 'admin') selected  @endif>Admin</option>
                                            <option value="user"  @if($user->role == 'user') selected  @endif>User</option>
                                        </select>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="{{ route('user#delete',$user->id) }}">
                                                <i class="zmdi zmdi-delete"></i>
                                            </a>
                                        </button>
                                    </div>
                                </td>
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
@section('script')
    <script>
        $(document).ready(function(){
            $('.status').change(function(){
                $role=$(this).val();
                $node=$(this).parents("tr");
                $id=$node.find('#userid').val();
                $data={
                    'userid' : $id,
                    'role' : $role,
                }
                $.ajax({
                    type : 'get',
                    datatype: 'json',
                    url :'http://127.0.0.1:8000/admin/ajaxrolechange',
                    data : $data,
                    success : function(response){
                        if(response.message == 'success'){
                            window.location.href = "http://127.0.0.1:8000/admin/userlist";
                        }
                    }

                })
            })
        })
    </script>
@endsection
