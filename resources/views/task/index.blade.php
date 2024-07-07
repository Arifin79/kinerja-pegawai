@extends('layouts.app')
<title>@yield('title', 'File Project')</title>
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/assigment/create.css') }}">
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
            <div>
                <h6>List Task</h6>
            </div>
            @foreach ($task as $product)
                <div class="overlap-2 ">
                    <div class="text-wrapper-4">{{ $product->date }}</div>
                    <div class="text-wrapper-5">{{ $product->title }}</div>
                    <a class="text-wrapper-6" href="{{ asset('images/' . $product->image) }}" download><img class="imge" src="{{ asset('images/download.png') }}" /></a>
                    <img class="img" src="{{ asset('images/clock.png') }}" />
                    <div class="group-2">
                        <div class="text-wrapper-7">{{ $product->name }}</div>
                    </div>
                {{-- <a href="{{ route('information/edit', ['id' => $product->id]) }}" class="edit" style="padding-right:12px; padding-left:0px; padding-top:10px; margin-top: 0px; margin-right:15px;">
                    <i class="fas fa-pencil-alt" ></i>
                </a> --}}
                <form method="post" action="{{ route('assignment/destroyer', ['id' => $product->id]) }}">
                    @method('delete')
                    @csrf
                    <button class="remove" onclick="deleteConfirm(event)" style="background-color: transparent; border: none; padding-right:12px; padding-left:12px; padding-top:0px; margin-top: 0px; margin-right:15px">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        @endforeach
      </div>
    </div>
</div>

<script>
function deleteConfirm(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    });
}
</script>

@endsection
