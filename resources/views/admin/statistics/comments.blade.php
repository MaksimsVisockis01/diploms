@extends('admin.statistics.layout')

@section('page.title', 'Comment Statistics')

@section('charts')
    <canvas id="commentChart"></canvas>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const commentStats = @json($commentStats);

            const commentChartCtx = document.getElementById('commentChart').getContext('2d');

            const chartConfig = (label, data) => ({
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: label,
                        data: data.map(item => item.count),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
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

            new Chart(commentChartCtx, chartConfig('Comments Created', commentStats));
        });
    </script>
@endpush
