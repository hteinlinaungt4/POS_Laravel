@extends('user.layout.master')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5 offset-3">
                <h2 class="section-title position-relative text-uppercase mb-4"><span class="bg-secondary pr-3">Contact
                        Us</span></h2>
                <div class="contact-form bg-light p-30">
                    <form  novalidate="novalidate" method="POST"
                        action="{{ route('user#contactcreate') }}">
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name"
                                name="name" value="{{ old('name',Auth::user()->name)}}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="control-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Your Email"
                                name="email" value="{{ old('email',Auth::user()->email )}}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="control-group mb-3">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Your Phone"  value="{{ old('phone',Auth::user()->phone)}}"/>
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="control-group mb-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="8" id="message" placeholder="Message" name="message">{{ old('message')}}</textarea>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
