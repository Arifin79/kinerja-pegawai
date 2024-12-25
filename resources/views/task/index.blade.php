@extends('layouts.app')

@section('title', 'File Project')

@section('content')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/assigment/create.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            @forelse ($task as $product)
                <div class="overlap-2">
                    <div class="text-wrapper-4">{{ $product->date }}</div>
                    <div class="text-wrapper-5">{{ $product->title }}</div>
                    <a class="text-wrapper-6" href="{{ asset('images/' . $product->image) }}" download>
                        <img class="imge" src="{{ asset('images/download.png') }}" />
                    </a>
                    <img class="img" src="{{ asset('images/clock.png') }}" />
                    <div class="group-2">
                        <div class="text-wrapper-7">{{ $product->name }}</div>
                    </div>
                    <form method="post" action="{{ route('assignment/destroyer', ['id' => $product->id]) }}">
                        @method('delete')
                        @csrf
                        <button class="remove" onclick="deleteConfirm(event)" style="background-color: transparent; border: none; padding: 0; margin-right: 15px;">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center">
                    <p>No tasks available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function deleteConfirm(event) {
        event.preventDefault();
        const form = event.target.closest('form');
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
                form.submit();
            }
        });
    }
</script>

@endsection
