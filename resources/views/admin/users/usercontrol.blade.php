@extends('layouts.base')

@section('content')
    <div class="container">
        <h1>Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Teacher</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->active ? 'Yes' : 'No' }}</td>
                        <td>
                            <form action="{{ route('users.toggle-teacher', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-{{ $user->teacher ? 'danger' : 'success' }}">
                                    {{ $user->teacher ? 'Remove Teacher' : 'Make Teacher' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('users.toggle-active', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-{{ $user->active ? 'danger' : 'success' }}">
                                    {{ $user->active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
