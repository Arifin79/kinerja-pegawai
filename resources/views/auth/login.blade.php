@extends('layouts.auth')


@section('content')
<div style="display: flex; align-items: center; justify-content: center; height: 100vh; background-color: #ffffff;">
    <div style="text-align: center; max-width: 400px; width: 100%;">
        <h1>WELCOME BACK!</h1>
        <p>To our Company</p>
        <img src="{{ asset('images/extroverse_logo.jpg') }}" alt="Extroverse Logo" style="margin-bottom: 20px; max-width: 300px;">

        <form method="POST" action="{{ route('auth.login') }}" id="login-form" style="border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">Email</label>
                <input type="email" id="floatingInputEmail" name="email" placeholder="name@example.com" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px;">Password</label>
                <input type="password" id="floatingPassword" name="password" placeholder="Password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
            <button type="submit" id="login-form-button" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background-color: #6c757d; color: white; font-weight: bold;">Sign In</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>
    </div>
</div>
@endsection

@push('style')
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
</style>

@push('script')
<script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
