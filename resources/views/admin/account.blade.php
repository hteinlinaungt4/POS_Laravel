@extends('admin.layout.master')
@section('title', 'Account Detail')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Detail</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('/storage/404.jpg') }}" alt="John Doe" />
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="John Doe" />
                                    @endif
                                </div>
                                <div class="col-8 offset-1 fw-bold">
                                    <div class="mb-4">
                                        <i class="zmdi zmdi-account fs-3 me-3"></i>{{ Str::upper(Auth::user()->name) }}
                                    </div>
                                    <div class="mb-4">
                                        <i class="zmdi zmdi-email fs-3 me-3"></i>{{ Auth::user()->email }}
                                    </div>
                                    <div class="mb-4">
                                        <i class="zmdi zmdi-phone fs-3 me-3"></i>{{ Str::upper(Auth::user()->phone) }}
                                    </div>
                                    <div class="mb-4">
                                        <i class="zmdi zmdi-gps fs-3 me-3"></i>{{ Auth::user()->address }}
                                    </div>
                                </div>
                                <a href="{{ route('account#edit') }}"><button class="btn btn-primary "> Edit Profile
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
