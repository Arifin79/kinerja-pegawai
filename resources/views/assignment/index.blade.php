@extends('layouts.app')
<title>@yield('title', 'Assignment')</title>
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/task.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    <div class="frame">
        <main class="container">
            <section>
                <div class="titlebar">
                    <h4>Task Assignment</h4>
                    <a href="{{ route('assignment/create') }}" class="btn-link">Add Task</a>
                </div>
                @if ($message = Session::get('success'))
                    <script type="text/javascript">
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: "top-end",
                        //     showConfirmButton: false,
                        //     timer: 3000,
                        //     timerProgressBar: true,
                        //     didOpen: (toast) => {
                        //         toast.onmouseenter = Swal.stopTimer;
                        //         toast.onmouseleave = Swal.resumeTimer;
                        //     }
                        //     });
                        //         Toast.fire({
                        //         icon: "success",
                        //         title: "{{ $message }}"
                        // });
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title:"{{ $message }}",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                    </script>
                @endif
                <div class="table">
                    <div class="table-filter">
                        <div>
                            <ul class="table-filter-list">
                                <li>
                                    <p class="table-filter-link link-active">All</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('assignment.index') }}" accept-charset="UTF-8" role="search">
                        <div class="table-search">
                            <div>
                                <button class="search-select">
                                   Search Assignments
                                </button>
                            </div>
                            <div class="relative">
                                <input class="search-input" type="text" name="search" placeholder="Search assignment..." value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>
                    <div class="table-product-head">
                        <p>No</p>
                        <p>Project Name</p>
                        <p>Project Type</p>
                        <p>Customer Name</p>
                        <p>Customer Type</p>
                        <p>Employee Name</p>
                        <p>Deadline</p>
                        <p>Image</p>
                        <p>Actions</p>
                    </div>
                    <div class="table-product-body">
                        @if (count($assignment) > 0)
                            @foreach ($assignment as $product)
                                <p style="padding-top: 15px" >{{ $product->id }}</p>
                                <p style="padding-top: 15px">{{ $product->project_name }}</p>
                                <p style="padding-top: 15px">{{ $product->project_type }}</p>
                                <p style="padding-top: 15px">{{ $product->customer_name }}</p>
                                <p style="padding-top: 15px">{{ $product->customer_type }}</p>
                                <p style="padding-top: 15px">{{ $product->employee_name }}</p>
                                <p style="padding-top: 15px">{{ $product->deadline }}</p>
                                <img style="margin-right:15px;" src="{{ asset('images/' . $product->image)}}"/>
                                <div style="display: flex">
                                    <a href="{{ route('assignment/edit', ['id' => $product->id]) }}" class="btn-link btn btn-success" style="padding-right:12px; padding-left:12px; padding-top:10px; margin-top: 0px; margin-right:15px;">
                                        <i class="fas fa-pencil-alt" ></i>
                                    </a>
                                    <form method="post" action="{{ route('assignment/destroy', ['id' => $product->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="deleteConfirm(event)" style="margin:-10px; padding-top:9px; padding-bottom:9px; padding-right:13px; padding-left:13px;">
                                            <i class="far fa-trash-alt"></i>
                                        </button>

                                    </form>
                                </div>

                                {{-- <div class="assignment-item">
                                    <p>{{ $product->project_name }}</p>
                                    <p>{{ $product->employee_name }}</p>
                                    <a href="{{ route('assignment.show', $product->id) }}">Detail</a>
                                </div>
                                 --}}
                            @endforeach
                        @else
                            <p>product not found</p>
                        @endif
                    </div>
                </div>
            </section>
            <br>
        </main>
      </div>
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
