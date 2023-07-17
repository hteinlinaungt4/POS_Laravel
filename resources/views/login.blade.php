@extends('layouts.master')
@section('content')
<div class="login-form">
    <form action="{{ route('login') }}" method="post">
        @csrf
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
            <label>Password</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{url('registerpage')}}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
