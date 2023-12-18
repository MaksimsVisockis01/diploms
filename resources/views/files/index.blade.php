@extends('layouts.base')

@section('page.title')
    Add File
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger file-upload-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(auth()->check())
        <div class="file-upload-container">
            <h2 class="file-upload-heading">Add File</h2>

            <form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data" class="file-upload-form">
                @csrf

                <div class="form-group file-upload-group">
                    <label for="title" class="file-upload-label">Title:</label>
                    <input type="text" name="title" id="title" class="file-upload-input" required>
                </div>

                <div class="form-group file-upload-group">
                    <label for="author" class="file-upload-label">Author:</label>
                    <input type="text" name="author" id="author" class="file-upload-input" required>
                </div>

                <div class="form-group file-upload-group">
                    <label for="description" class="file-upload-label">Description:</label>
                    <textarea name="description" id="description" rows="4" class="file-upload-textarea" required></textarea>
                </div>

                <div class="form-group file-upload-group">
                    <label for="file" class="file-upload-label">File:</label>
                    <input type="file" name="file" id="file" accept=".pdf, .doc, .docx" class="file-upload-file" required>
                </div>

                <button type="submit" class="file-upload-submit">Upload File</button>
            </form>
        </div>
    @else
        <p class="file-upload-login-message">You need to be logged in to upload a file.</p>
    @endif

    @include('files.dashboard')
@endsection
