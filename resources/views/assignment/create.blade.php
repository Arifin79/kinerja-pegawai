@extends('layouts.app')
<title>@yield('title', 'Create Asignment')</title>
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/task.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

    <div class="frame">
        <main class="container">
            <section>
                <form action="{{ route('assignment/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="titlebar">
                        <h4>Add Task</h4>
                    </div>
                    <div class="card">
                       <div>
                            <label>Project Name</label>
                            <input type="text" name="project_name">
                            <hr>
                            <label>Customer Name</label>
                            <input type="text" name="customer_name">
                            <hr>
                            <label>Add Image</label>
                            <img src="" alt="" class="img-product" id="file-preview" />
                            <input type="file" name="image" accept="image/*" onchange="showFile(event)">


                        </div>
                       <div>
                            <label>Deadline</label>
                            <input type="date" name="deadline" />
                            <hr>
                            <label>Project Type</label>
                            {{-- <input type="text" class="input" name="project_type"> --}}
                            <select  name="project_type">
                                @foreach ( json_decode('{"Smartphone": "Smartphone", "Smart TV": "Smart Tv", "Computer": "Computer"}', true) as $optionKey => $optionValue )
                                <option value="{{ $optionKey }}" {{ (isset($assignment->project_type) && $assignment->project_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                @endforeach
                            </select>
                            <hr>
                            <label>Customer Type</label>
                            {{-- <input type="text" class="input" name="customer_type"> --}}
                            <select  name="customer_type">
                                @foreach ( json_decode('{"Smartphone": "Smartphone", "Smart TV": "Smart Tv", "Computer": "Computer"}', true) as $optionKey => $optionValue )
                                <option value="{{ $optionKey }}" {{ (isset($assignment->customer_type) && $assignment->customer_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                @endforeach
                            </select>
                       </div>
                    </div>
                    <div class="titlebar">
                        <h1></h1>
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
