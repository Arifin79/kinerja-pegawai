@extends('layouts.app')
<title>@yield('title', 'Edit Assignment')</title>
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/task.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

<div class="text-wrapper-6">Assignment</div>
    <div class="frame">
        <main class="container">
            <section>
                <form action="{{ route('assignment/update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="titlebar">
                        <h4>Edit Product</h4>
                    </div>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                       <div>
                        <label>Project Name</label>
                            <input type="text" name="project_name" value="{{ $assignment->project_name}}">
                            <hr>
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" value="{{ $assignment->customer_name }}">
                            <hr>
                            {{-- <label>Name</label>
                            <input type="text" name="name" value="{{ $assignment->name }}">
                            <label>Description (optional)</label>
                            <textarea cols="10" rows="5" name="description" value="{{ $assignment->description }}">{{ $assignment->description }}</textarea> --}}
                            <label>Add Image</label>
                            <img src="{{ asset('images/'.$assignment->image) }}" alt="" class="img-product" id="file-preview" />
                            <input type="hidden" name="hidden_product_image" value="{{ $assignment->image }}">
                            <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                        </div>
                       <div>
                            <label>Employee Name</label>
                            <input type="text" class="input" name="employee_name" value="{{ $assignment->employee_name }}">
                            <label>Deadline</label>
                            <input type="date" name="deadline" value="{{ $assignment->deadline }}"/>
                            <hr>
                            <label>Project Type</label>
                            <input type="text" class="input" name="project_type" value="{{ $assignment->project_type }}">
                            <hr>
                            <label>Customer Type</label>
                            <input type="text" class="input" name="customer_type" value="{{ $assignment->customer_type }}">
                            <label>Category</label>

                            {{-- <hr>
                            <label>Inventory</label>
                            <input type="text" class="input" name="quantity" value="{{ $assignment->quantity }}">
                            <hr>
                            <label>Price</label>
                            <input type="text" class="input" name="price" value="{{ $assignment->price }}"> --}}
                       </div>
                    </div>
                    <div class="titlebar">
                        <h1></h1>
                        <input type="hidden" name="hidden_id" value="{{ $assignment->id }}">
                        <button>Save</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<script>
    function showFile(event){
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('file-preview');
            output.src = dataURL;
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>

@endsection
