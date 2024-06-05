@extends('layouts.home')

<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<link rel="stylesheet" href={{ asset('css/assigment/send.css') }}>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

<div class="text-wrapper-6">Send Task</div>
    <div class="frame">
        <main class="container">
            <section>
                <form action="{{ route('home.assignment-user/taskStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="titlebar">
                        <h4 class="add">Add Assignment</h4>
                    </div>
                    <div class="card">
                       <div>
                            <label hidden>Name</label>
                            <input hidden type="text" name="name" value="{{ Auth::user()->name }}">
                            <label>Project Name</label>
                            <input type="text" name="title" >
                            <label>Upload Time</label>
                            <input type="date" name="date" />
                            <label>File Project</label>
                            <img src="" alt="" class="img-product" id="file-preview" />
                            <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                        </div>
                    </div>
                    <div class="titlebar">
                        <h1></h1>
                        <button type="submit">Save</button>
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
