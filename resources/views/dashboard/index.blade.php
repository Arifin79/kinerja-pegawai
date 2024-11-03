@extends('layouts.app')
<title>@yield('title', 'Dashboard')</title>
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="greeting-container">
                    <h2 class="greeting"><span id="greeting"></span></h2>
                    <h2 class="username">{{ auth()->user()->name }}</h2>
                </div>
                <h5 class="m-0 text-dark font-weight-bold mb-3">Dashboard</h5>
            </div>
        </div>
    </div>
    <script>
        function updateGreeting() {
            const now = new Date();
            const hours = now.getHours();
            let greeting;
    
            if (hours >= 4 && hours < 12) {
                greeting = "Good Morning";
            } else if (hours >= 12 && hours < 18) {
                greeting = "Good Afternoon";
            } else if (hours >= 18 && hours < 22) {
                greeting = "Good Evening";
            } else {
                greeting = "Good Night";
            }
    
            document.getElementById('greeting').innerText = greeting;
        }
    
        // Jalankan fungsi ketika halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', updateGreeting);
    </script>
    
    <div class="container py-4">
        <div class="row">
            <!-- Card Data Jabatan -->
            <div class="col-md-3">
                <div class="card shadow" onclick="handleClick('Data Jabatan')">
                    <div class="card-body">
                        <i class="fas fa-clipboard icon-top-right"></i>
                        <h6 class="fs-6 fw-light">Data Jabatan</h6>
                        <h4 class="fw-bold">{{ $positionCount }}</h4>
                    </div>
                </div>
            </div>
            <!-- Card Data Karyawan -->
            <div class="col-md-3">
                <div class="card shadow" onclick="handleClick('Data Karyawan')">
                    <div class="card-body">
                        <i class="fas fa-user icon-top-right"></i>
                        <h6 class="fs-6 fw-light">Data Karyawan</h6>
                        <h4 class="fw-bold">{{ $userCount }}</h4>
                    </div>
                </div>
            </div>
            <!-- Card Data Information -->
            <div class="col-md-3">
                <div class="card shadow" onclick="handleClick('Data Information')">
                    <div class="card-body">
                        <i class="fas fa-bell icon-top-right"></i>
                        <h6 class="fs-6 fw-light">Data Information</h6>
                        <h4 class="fw-bold">{{ $informationCount }}</h4>
                    </div>
                </div>
            </div>
            <!-- Card Waktu -->
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <i class="fas fa-clock icon-top-right"></i>
                        <h6 class="fs-6 fw-light">Waktu</h6>
                        <h4 class="fw-bold" id="time">{{ $time }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk interaktivitas dan jam real-time -->
    <script>
        // Fungsi untuk menampilkan pesan ketika card diklik
        function handleClick(cardName) {
            alert('Anda mengklik ' + cardName);
            // Anda juga bisa mengarahkan ke halaman lain dengan window.location.href = '/halaman-yang-dituju';
        }

        // Fungsi untuk memperbarui waktu setiap detik
        setInterval(() => {
            document.getElementById('time').innerText = new Date().toLocaleTimeString();
        }, 1000);
    </script>
</div>
@endsection
