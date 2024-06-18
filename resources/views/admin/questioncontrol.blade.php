<h3>Questions</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->title }}</td>
                <td>{{ $question->created_at }}</td>
                <td>
                    <form action="{{ route('admin.questionscontrol.delete', $question->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $questions->links() }}
