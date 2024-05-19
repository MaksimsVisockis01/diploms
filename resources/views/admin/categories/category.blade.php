@extends('layouts.base')

@section('page.title')
    forum
@endsection

@section('content')
    <p>
         make category
    </p>

{{-- form --}}
<x-form-container>
    <x-forms-header>
        <x-forms-heading>
            Create category
        </x-forms-heading>
    </x-forms-header>
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <x-form-wrapper>
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @if ($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </x-form-wrapper>
    
            <x-form-wrapper>
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @endif
            </x-form-wrapper>
    
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    
        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif
</x-form-container>

{{-- endform --}}

@endsection