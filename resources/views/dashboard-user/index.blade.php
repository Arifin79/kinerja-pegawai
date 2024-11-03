@extends('layouts.home')
<title>@yield('title', 'Dashboard')</title>
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="greeting-container">
            <h2 class="greeting"><span id="greeting"></span></h2>
            <h2 class="username">{{ auth()->user()->name }}</h2>
        </div>
        <div class="row">
            <div class="col-12">
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
                    <!-- Elemen ini akan menampilkan waktu real-time -->
                    <h4 class="fw-bold" id="realTimeClock"></h4>
                </div>
            </div>
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
<!-- Script untuk jam digital real-time -->
<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        const timeString = `${hours}:${minutes}:${seconds}`;
        
        document.getElementById('realTimeClock').innerText = timeString;
    }

    // Update clock every second
    setInterval(updateClock, 1000);

    // Run the function initially to display time immediately on load
    updateClock();
</script>
@endsection
