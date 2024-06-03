@extends('layouts.app')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/create.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<div class="detail-project">
    <div class="overlap">
      <div class="frame">
        <div class="text-wrapper-9">File Assignment</div>
        <div class="div">Download Task</div>
      </div>
      <div class="overlap-wrapper">
        <div class="row"></div>
        @foreach ($task as $product)
            <div class="overlap-2">
                <div class="text-wrapper-4">{{ $product->date }}</div>
                <div class="text-wrapper-5">{{ $product->title }}</div>
                <a class="text-wrapper-6" href="{{ asset('images') . '/' . $product->image }}" download>Download File</a>
                <img class="img" src="{{ asset('images/clock.png') }}" />
                    <div class="group-2">
                        <div class="text-wrapper-7">{{ $product->name }}</div>
                    </div>
                <a href="{{ route('information-user/edit', ['id' => $product->id]) }}" class="edit" style="padding-right:12px; padding-left:12px; padding-top:10px; margin-top: 0px; margin-right:15px;">
                    <i class="fas fa-pencil-alt" ></i>
                </a>
                <form method="post" action="{{ route('assignment-user/destroyer', ['id' => $product->id]) }}">
                    @method('delete')
                    @csrf
                    <button class="remove" onclick="deleteConfirm(event)" style="background-color: transparent; border: none; padding-right:12px; padding-left:12px; padding-top:10px; margin-top: 0px; margin-right:15px">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        @endforeach
      </div>
    </div>
</div>

@endsection
