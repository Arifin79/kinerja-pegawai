@extends('layouts.home')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/information/card.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<div class="text-wrapper-6">Information</div>
    <div class="frame">
        <div class="text-wrapper">Information Team</div>
        <div class="text-wrapper-5">Extroverse</div>
        <img class="line" src="img/line-5.svg" />
        <div class="row">
            @foreach ($information as $product)
            <div class="group">
                <div class="overlap-group">
                <div class="div">{{ $product->title }}</div>
                <div class="text-wrapper-2">{{ $product->date }}</div>
                <p class="p">{{ $product->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
