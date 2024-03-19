@extends('layouts.base')

@section('page.title')
    Add File
@endsection

@section('content')

<section class="my-5 border p-4 mx-auto w-50">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
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

                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File:</label>
                    <input type="file" class="form-control" id="file" name="file" accept=".pdf, .doc, .docx" required>
                </div>

                <button type="submit" class="btn btn-primary">Upload File</button>
            </form>
        </div>
    @else
        <p>You need to be logged in to upload a file.</p>
    @endif
</section>
    @include('files.dashboard')
@endsection

