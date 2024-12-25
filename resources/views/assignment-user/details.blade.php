@extends('layouts.app')

@section('title', 'Detail Project')

@section('content')
    <div class="task-details">
        <h1>Detail Tugas: {{ $task->title }}</h1>
        <p><strong>Nama Karyawan:</strong> {{ $task->employee->name }}</p>
        <p><strong>Tanggal:</strong> {{ $task->date }}</p>
        <p><strong>Deskripsi:</strong> {{ $task->description }}</p>
        <p>
            <strong>Gambar:</strong>
            <img src="{{ asset('images/' . $task->image) }}" alt="{{ $task->title }}" />
        </p>
    </div>
@endsection
