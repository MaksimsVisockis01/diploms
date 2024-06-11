<!-- resources/views/admin/statistics/files.blade.php -->
<h3>Files</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Filename</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file->id }}</td>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->created_at }}</td>
                <td>
                    <form action="{{ route('admin.filescontrol.delete', $file->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $files->links() }}
