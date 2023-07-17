@extends('admin.layout.master')
@section('title', 'Order List')
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
                                <h2 class="title-1">Order List</h2>
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
                                        Total: <span class="fs-5">{{ count($order) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <form class="form-header float-end" action="{{ route('order#statusfilter') }}" method="get">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <select class="form-select" id="inputGroupSelect02" name="status">
                                            <option value="">All</option>
                                            <option value="0" @if( request('status') == "0")  selected @endif >Pending...</option>
                                            <option value="1" @if( request('status') == "1")  selected @endif>Success...</option>
                                            <option value="2" @if( request('status') == "2")  selected @endif>Reject...</option>
                                        </select>
                                        <button class="input-group-text" for="inputGroupSelect02">Choose Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive table-responsive-data2 mt-3">
                            <table class="table-data2 table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                    @foreach ($order as $o)
                                        <tr class="tr-shadow">
                                            <td>{{ $o->user_id }}
                                                <input type="hidden" value="{{ $o->id }}" class="orderid">
                                            </td>
                                            <td>{{ $o->username }}</td>
                                            <td>{{ $o->created_at->format('d/F/Y') }}</td>
                                            <td><a href="{{ route('order#detail',$o->orderCode)}}">{{ $o->orderCode }}</a></td>
                                            <td>{{ $o->total_price }}</td>
                                            <td class="col-2">
                                                <select name="" id="" class="form-control status">

                                                    <option value="0"
                                                        @if ($o->status == 0) selected @endif>Pending...
                                                    </option>
                                                    <option value="1"
                                                        @if ($o->status == 1) selected @endif>Success...
                                                    </option>
                                                    <option value="2"
                                                        @if ($o->status == 2) selected @endif>Reject...</option>
                                                </select>
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
            $(document).ready(function() {
                $('#status').change(function() {
                    $status = $('#status').val();
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/status',
                        datatype: 'json',
                        data: {
                            data: $status,
                        },
                        success: function(response) {
                            $list = "";
                            for (let i = 0; i < response.length; i++) {
                                if (response[i].status == 0) {
                                   $statusmsg = `
                                <select name="" id="" class="form-control status">
                                    <option value="0" selected >Pending...</option>
                                    <option value="1" >Success...</option>
                                    <option value="2" >Reject...</option>
                                </select>
                                  `
                                }else if(response[i].status == 1){
                                    $statusmsg = `
                                <select name="" id="" class="form-control status">
                                    <option value="0" >Pending...</option>
                                    <option value="1" selected>Success...</option>
                                    <option value="2" >Reject...</option>
                                </select>
                                  `
                                }else if(response[i].status == 2){
                                   $statusmsg = `
                                <select name="" id="" class="form-control stauts">
                                    <option value="0" >Pending...</option>
                                    <option value="1" >Success...</option>
                                    <option value="2" selected>Reject...</option>
                                </select>
                                  `;
                                }

                                let date = new Date(response[i].created_at);
                                $months = ['January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November',
                                    'December'
                                ];
                                $list += `{
                            <tr class="tr-shadow">
                                    <td>${response[i].user_id}</td>
                                    <td>${response[i].username}</td>
                                    <td>${date.getDate()+'/'+ $months[date.getMonth()] +'/'+date.getFullYear()}</td>
                                    <td>${response[i].orderCode}</td>
                                    <td>${response[i].total_price}</td>
                                    <td class="col-2">
                                        ${$statusmsg}
                                    </td>
                                </tr>

                        }`;

                            }
                            $('#data').html($list);

                        }

                    })
                })
                $('.status').change(function(){
                    $parent=$(this).parents("tr");
                    $id=$parent.find('.orderid').val();
                    $status=$parent.find('.status').val();
                    $data={
                        'id' : $id,
                        'status' : $status,
                    }
                $.ajax({
                    type : 'get',
                    datatype : 'json',
                    url : 'http://127.0.0.1:8000/ajax/statusupdate',
                    data : $data,
                })
                })
            })
        </script>
    @endsection
