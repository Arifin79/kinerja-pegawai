@extends('layouts.home')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/card.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

<div class="text-wrapper-6">Assignment</div>
    <div class="frame">
      <div class="group">
        {{-- <div class="overlap-group">
          <div class="text-wrapper">Search Here...</div>
          <img class="vector" src="img/1.png" />
        </div> --}}
    </div>

    <div class="overlap-wrapper">
        <div class="row">
            @foreach ($assignment as $product)
                <div class="overlap">
                    <img class="image-wrapper" src="{{ asset('images/' . $product->image)}}"/>
                    <div class="div">{{ $product->project_name }}</div>
                    <div class="text-wrapper-2">{{ $product->customer_type }}</div>
                    <div class="text-wrapper-3">{{ $product->deadline }}</div>
                    <img class="clock" src="{{ asset('images/clock.jpg') }}" />
                    <a href="{{ route('home.assignment-user/edit', ['id' => $product->id]) }}" method="POST" class="btn-show">Detail</a>
                </div>

            @endforeach
        </div>
    </div>
    <div class="text-wrapper-7">Task</div>
</div>

@endsection
