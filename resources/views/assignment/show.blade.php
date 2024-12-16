@extends('layouts.app')

@section('title', 'Detail Assignment')

@section('content')
    <div class="assignment-detail">
        <h1>Detail Project: {{ $assignment->project_name }}</h1>
        <p><strong>Project Type:</strong> {{ $assignment->project_type }}</p>
        <p><strong>Customer Name:</strong> {{ $assignment->customer_name }}</p>
        <p><strong>Employee Name:</strong> {{ $assignment->employee_name }}</p>
        <p><strong>Deadline:</strong> {{ $assignment->deadline }}</p>
        <p><strong>Image:</strong> <img src="{{ asset('images/' . $assignment->image) }}" alt="Project Image" width="200" /></p>
        <a href="{{ route('assignment.index') }}">Back to Assignments</a>
    </div>
@endsection
