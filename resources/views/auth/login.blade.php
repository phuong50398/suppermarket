@extends('layouts.blank')

@section('content')
<div class="login">
    <div class="main-agileits">
        <div class="form-w3agile">
            <h3>Đăng nhập</h3>
            <form action="{{ route('login') }}" method="post">
                @csrf
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="key">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input  id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email">
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input  id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  placeholder="Mật khẩu">
                    <div class="clearfix"></div>
                </div>
                <input type="submit" value="Đăng nhập">
            </form>
        </div>
        <div class="forg">
            @if (Route::has('password.request'))
                <a class="forg-left" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif
            <a href="register" class="forg-right">Đăng ký</a>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

@endsection
