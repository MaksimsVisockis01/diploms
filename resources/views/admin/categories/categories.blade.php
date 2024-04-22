@extends('layouts.base')

@section('page.title')
    Categories Control
@endsection

@section('content')
<section class="my-5 border p-4 mx-auto w-75">
    <div class="align-self-center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="my-4">Category Management</h2>

        <p><a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create category</a></p>

        @if ($categories->count() > 0)
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>description</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <div class="w-auto">
                                <td class="d-flex gap-2">
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">Edit Category</a>
                                </td>
                            </div>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No categories found.</p>
        @endif
    </div>
</section>
@endsection