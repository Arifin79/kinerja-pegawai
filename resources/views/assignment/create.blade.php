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
                            <label for="project_name">Project Name</label>
                            <input type="text" id="project_name" name="project_name">
                            <hr>
                            <label for="customer_name">Customer Name</label>
                            <input type="text" id="customer_name" name="customer_name">
                            <hr>
                            <label for="file-upload">Add Image</label>
                            <img src="" alt="Preview of uploaded file" class="img-product" id="file-preview" />
                            <input type="file" id="file-upload" name="image" accept="image/*" onchange="showFile(event)">
                        </div>
                        <div>
                            <label for="employee_name">Employee Name</label>
                            <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name', $assignment->employee_name ?? '') }}">
                            <label>Deadline</label>
                            <input type="date" name="deadline" />
                            <hr>
                            <label>Project Type</label>
                            {{-- <input type="text" class="input" name="project_type"> --}}
                            <select  name="project_type">
                                @foreach ( json_decode('{"Konveksi": "Konveksi", "Software Development": "Software Development", "Hardware Service": "Hardware Service", "Event": "Event", "Digital Ads": "Digital Ads"}', true) as $optionKey => $optionValue )
                                <option value="{{ $optionKey }}" {{ (isset($assignment->project_type) && $assignment->project_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                @endforeach
                            </select>
                            <hr>
                            <label>Customer Type</label>
                            {{-- <input type="text" class="input" name="customer_type"> --}}
                            <select  name="customer_type">
                                @foreach ( json_decode('{"Mitra": "Mitra", "Reseller": "Reseller", "Non Mitra(Membership)": "Non Mitra(Membership)"}', true) as $optionKey => $optionValue )
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
