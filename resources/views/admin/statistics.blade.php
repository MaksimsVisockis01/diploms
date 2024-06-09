@extends('layouts.base')

@section('page.title', 'Admin Statistics')

@section('content')
<div class="container">
    <h1>Statistics</h1>

    <form action="{{ route('admin.statistics') }}" method="GET">
        <select name="date_filter" onchange="this.form.submit()">
            <option value="daily" {{ $dateFilter == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="weekly" {{ $dateFilter == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ $dateFilter == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ $dateFilter == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </form>

    <div class="charts">
        <!-- Chart.js integration for displaying charts -->
        <canvas id="userChart"></canvas>
        <canvas id="fileChart"></canvas>
        <canvas id="questionChart"></canvas>
        <canvas id="commentChart"></canvas>
    </div>

    <!-- User Statistics Table -->
    <h2>User Statistics</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}

    <!-- File Statistics Table -->
    <h2>File Statistics</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{ $file->title }}</td>
                <td>{{ $file->user->name }}</td>
                <td>{{ $file->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $files->links() }}

    <!-- Question Statistics Table -->
    <h2>Question Statistics</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td>{{ $question->title }}</td>
                <td>{{ $question->user->name }}</td>
                <td>{{ $question->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $questions->links() }}

    <!-- Comment Statistics Table -->
    <h2>Comment Statistics</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Text</th>
                <th>Author</th>
                <th>Question</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->text }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->question->title }}</td>
                <td>{{ $comment->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $comments->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userStats = @json($userStats);
        const fileStats = @json($fileStats);
        const questionStats = @json($questionStats);
        const commentStats = @json($commentStats);

        const userChartCtx = document.getElementById('userChart').getContext('2d');
        const fileChartCtx = document.getElementById('fileChart').getContext('2d');
        const questionChartCtx = document.getElementById('questionChart').getContext('2d');
        const commentChartCtx = document.getElementById('commentChart').getContext('2d');

        const chartConfig = (label, data) => ({
            type: 'line',
            data: {
                labels: data.map(item => item.date),
                datasets: [{
                    label: label,
                    data: data.map(item => item.count),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                scales: {
                    x: { display: true, title: { display: true, text: 'Date' } },
                    y: { display: true, title: { display: true, text: 'Count' } },
                },
            }
        });

        new Chart(userChartCtx, chartConfig('User Registrations', userStats));
        new Chart(fileChartCtx, chartConfig('File Uploads', fileStats));
        new Chart(questionChartCtx, chartConfig('Questions', questionStats));
        new Chart(commentChartCtx, chartConfig('Comments', commentStats));
    });
</script>
@endsection
