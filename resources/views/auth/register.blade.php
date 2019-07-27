@extends('layouts.master')

@section('content')
@include('shared.menu')
<div class="login">
    <div class="main-agileits">
        <div class="form-w3agile form1">
            <h3>Register</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="key">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Họ tên" >

                    {{-- <input  type="text" value="Username" name="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" required=""> --}}
                    <div class="clearfix"></div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="key">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Email" >
                    <div class="clearfix"></div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder="Mật khẩu" >
                    <div class="clearfix"></div>
                </div>
                <div class="key">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu" >
                    <div class="clearfix"></div>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>

    </div>
</div>

@endsection
