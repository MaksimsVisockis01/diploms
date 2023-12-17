@extends('layouts.base')

@section('page.title')
    Add File
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(auth()->check())
        <div class="file-upload-container">
            <h2>Add File</h2>

            <form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" name="file" id="file" accept=".pdf, .doc, .docx" required>
                </div>

                <button type="submit">Upload File</button>
            </form>
        </div>
    @else
        <p>You need to be logged in to upload a file.</p>
    @endif

    @include('files.dashboard')
@endsection

