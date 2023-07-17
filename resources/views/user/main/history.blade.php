@extends('user.layout.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td>{{ $o->created_at->format('F-d-Y') }}</td>
                            <td>{{ $o->orderCode }}</td>
                            <td>{{ $o->total_price }}</td>
                            <td>
                                    @if ($o->status == 0)
                                        <span class='text-warning'><i class="fa-solid fa-clock-rotate-left"></i>  Pending...</span>
                                    @elseif($o->status == 1)
                                        <span class='text-success'><i class="fa-solid fa-check"></i>  Success...</span>
                                    @elseif($o->status == 2)
                                        <span class='text-danger'><i class="fa-solid fa-triangle-exclamation"></i>  Reject...</span>
                                    @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
