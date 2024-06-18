<h3>Comments</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Comment</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->comment }}</td>
                <td>{{ $comment->created_at }}</td>
                <td>
                    <form action="{{ route('admin.commentscontrol.delete', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $comments->links() }}
