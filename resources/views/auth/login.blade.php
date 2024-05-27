@extends('layouts.auth')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/login/main.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@push('style')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush

@section('content')

<div class="w-100">

    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('auth.login') }}" id="login-form">
            <h1 class="h3 mb-3 fw-normal">Silahkan masuk untuk absensi</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInputEmail" name="email"
                    placeholder="name@example.com">
                <label for="floatingInputEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckRemember">
                <label class="form-check-label" for="flexCheckRemember">
                    Ingatkan Saya di Perangkat ini
                </label>
            </div>

            <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </form>
    </main>

</div>
@endsection

@push('script')
<script type="module" src="{{ asset('js/auth/login.js') }}"></script>
@endpush
