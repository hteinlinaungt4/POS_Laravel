@extends('layouts.master')
@section('content')
<div class="login-form">
    <form action="{{ route('register') }}" method="post">
        @csrf

        @error('term')
            {{ $message }}
        @enderror

        <div class="form-group">
            <label>Username</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name')}}" name="name" placeholder="Username">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" placeholder="Email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="phone" name="phone" value="{{ old('phone')}}" placeholder="Phone">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"  rows="5" placeholder="Address">{{ old('address') }}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ url('loginpage') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection
