@extends('layout.app')
@section('title', 'Hotel')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login-admin.css') }}">
@endsection
@section('content')
    <div class='bold-line'></div>
    <div class='container'>
        <div class='window'>
            <div class='overlay'></div>
            <div class='content'>
                <div class='welcome'>Admin Dashboard</div>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
                <form method="POST" action="{{route('admin.login_admin_process')}}">
                    @csrf
                    <div class='input-fields'>
                        <input type='email' name="email" placeholder='Email' class='input-line full-width'>
                        <input type='password' name="password" placeholder='Password' class='input-line full-width'>
                    </div>
                    <div><input type="submit" class='ghost-round full-width' value="Log In"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
