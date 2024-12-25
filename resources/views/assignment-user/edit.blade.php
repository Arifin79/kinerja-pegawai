@extends('layouts.home')
<title>@yield('title', 'Edit Assignment')</title>
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href= {{ asset('css/assigment/create.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

<div class="detail-project">
  <div class="overlap">
      <div class="frame">
          <div class="group">
              <img class="clock" src="{{ asset('images/clock.png') }}" alt="Clock Icon" />
          </div>
          <div class="div">Send Task</div>
          <div class="div">
              <p style="padding-top: 25px">{{ $assignment->employee_name }}</p>
          </div>
          <img class="line" src="img/line-5.svg" alt="Decorative Line" />
        <div class="overlap-group-wrapper">
          <div class="overlap-group">
            <a href="{{ route('home.assignment-user/create') }}" class="text-wrapper-3">Add Assignment</a>
          </div>
        </div>
      </div>
      <div class="overlap-wrapper">
        <div class="row"></div>
        @foreach ($task as $product)
            <div class="overlap-2">
                <div class="text-wrapper-4">{{ $product->date }}</div>
                <div class="text-wrapper-5">{{ $product->title }}</div>
                <a class="text-wrapper-6" href="{{ asset('images') . '/' . $product->image }}" download>
                  <img class="imge" src="{{ asset('images/download.png') }}" alt="Download {{ $product->title }}" />
                </a>
                <img class="img" src="{{ asset('images/clock.png') }}" alt="Clock Icon" />
                    <div class="group-2">
                        <div class="text-wrapper-7">{{ $product->name }}</div>
                    </div>
            </div>
        @endforeach
      </div>
    </div>
    <div class="text-wrapper-9 ">Detail Project</div>
</div>

  
<script>
    window.deleteConfirm = function (e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        });
    }
</script>
@endsection
