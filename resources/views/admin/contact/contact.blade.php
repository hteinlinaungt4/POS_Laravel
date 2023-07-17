@extends('admin.layout.master')
@section('title','Contact Us')
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
                            <h2 class="title-1">Contact List</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    @if ( count($contacts)!= 0)
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($contacts as $contact)
                           <tr class="tr-shadow">
                            <td>{{ $contact->name }}</td>
                            <td>
                                {{ $contact->email }}
                            </td>
                            <td>
                                {{ $contact->message }}
                            </td>
                            <td>{{ $contact->created_at->format('d-F-y') }}</td>

                        </tr>
                           @endforeach
                            <tr class="spacer"></tr>

                        </tbody>
                    </table>
                    @else
                        <h1 class=" text-muted text-center fs-3 my-5">There is no Contact here</h1>
                    @endif
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
