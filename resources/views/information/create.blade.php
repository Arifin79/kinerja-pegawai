@extends('admin/information.layout.main')

@section('content')

<div class="text-wrapper-6">Information</div>
    <div class="frame">
        <main class="container">
            <section>
                <form action="{{ route('admin/information/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="titlebar">
                        <h4>Add Product</h4>
                    </div>
                    <div class="card">
                       <div>
                            <label>Title</label>
                            <input type="text" name="title" >
                            <label>Date</label>
                            <input type="date" name="date" />
                            <label>Description (optional)</label>
                            <textarea cols="10" rows="5" name="description" ></textarea>
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
