@extends('layouts.base')

@section('page.title')
    Users Control
@endsection

@section('content')
<section class="d-flex justify-content-center my-3 p-4">
    <div class="align-self-center w-50">
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

        <h2 class="my-4">User Management</h2>

        @if ($users->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Uid</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->uid }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No users found.</p>
        @endif
    </div>
</section>
@endsection
