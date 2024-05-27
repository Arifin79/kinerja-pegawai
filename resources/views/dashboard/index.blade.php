@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Data Jabatan</h6>
                    <h4 class="fw-bold">{{ $positionCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Data Karyawan</h6>
                    <h4 class="fw-bold">{{ $userCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Data Information</h6>
                    <h4 class="fw-bold">{{ $informationCount }}</h4>
                </div>
                <i class="fas fa-bell position-absolute rounded-circle bg-black" style="top: 20px; right: 30px; font-size: 20px; padding: 8px;"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="fs-6 fw-light">Data Information</h6>
                    <h4 class="fw-bold">{{ $informationCount }}</h4>
                </div>
                <i class="fas fa-bell position-absolute rounded-circle bg-black" style="top: 20px; right: 30px; font-size: 20px; padding: 8px;"></i> <!-- Menambahkan ikon bell dengan ukuran yang sama -->
            </div>
        </div>
    </div>
</div>
@endsection
