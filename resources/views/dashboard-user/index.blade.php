@extends('layouts.home')
<title>@yield('title', 'Dashboard')</title>
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="greeting-container">
                    <h2 class="greeting">Good Morning</h2>
                    <h2 class="username">{{ auth()->user()->name }}</h2>
                </div>
                <h5 class="m-0 text-dark font-weight-bold mb-3">Dashboard</h5>
            </div>
        </div>
    </div>
<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <span data-feather="clipboard" class="icon-top-right"></span>
                    <h6 class="fs-6 fw-light">Data Jabatan</h6>
                    <h4 class="fw-bold">{{ $positionCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <span data-feather="user" class="icon-top-right"></span>
                    <h6 class="fs-6 fw-light">Data Karyawan</h6>
                    <h4 class="fw-bold">{{ $userCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <span data-feather="bell" class="icon-top-right"></span>
                    <h6 class="fs-6 fw-light">Data Information</h6>
                    <h4 class="fw-bold">{{ $informationCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <span data-feather="clock" class="icon-top-right"></span>
                    <h6 class="fs-6 fw-light">Waktu</h6>
                    <h4 class="fw-bold">{{ $waktuCount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
