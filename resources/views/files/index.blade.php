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
    <x-form-container>
        <x-forms-header>
            Add File
        </x-forms-header>

            <form action="{{ route('index.store') }}" method="POST" enctype="multipart/form-data" class="file-upload-form">
                @csrf

                <x-form-wrapper>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title"  class="form-control" required>
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="author" class="form-label">Author</label>
                    <input type="text" name="author" id="author" class="form-control" required>
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
                </x-form-wrapper>

                <x-form-wrapper>
                    <label for="file" class="form-label">File</label>
                    <input type="file" name="file" id="file" accept=".pdf, .doc, .docx" class="form-control" required>
                </x-form-wrapper>

                <button type="submit" class="btn btn-primary">Upload File</button>
            </form>
        @else
            <p class="file-upload-login-message">You need to be logged in to upload a file.</p>
        @endif
    </x-form-container>
    @include('files.dashboard')
@endsection
