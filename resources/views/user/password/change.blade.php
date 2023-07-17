@extends('user.layout.master')
@section('content')
    <div class="col-6 offset-3 ">
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
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('userpassword#change') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group mb-3 ">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" value="" name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old password ..">
                                @error('oldpassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" value="" name="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password ..">
                                @error('newpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="cc-payment" class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament" value="" name="comfirmpassword" type="password" class="form-control @error('comfirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Comfirm password ..">
                                @error('comfirmpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100 my-3">
                                    <span id="payment-button-amount">Change Password</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    </div>
@endsection
