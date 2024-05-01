@extends('admin/information.layout.main')

@section('content')

<div class="text-wrapper-6">Information</div>
    <div class="frame">
        <main class="container">
            <section>
                <form action="{{ route('admin/information/update', $information->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="titlebar">
                        <h4>Edit Information</h4>
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
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $information->title }}">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ $information->date }}"/>
                            <label>Description (optional)</label>
                            <textarea cols="10" rows="5" name="description" value="{{ $information->description }}">{{ $information->description }}</textarea>
                        </div>
                    </div>
                    <div class="titlebar">
                        <h1></h1>
                        <input type="hidden" name="hidden_id" value="{{ $information->id }}">
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
