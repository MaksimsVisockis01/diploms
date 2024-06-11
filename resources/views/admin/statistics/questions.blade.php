@extends('admin.statistics.layout')

@section('page.title', 'Question Statistics')

@section('charts')
    <canvas id="questionChart"></canvas>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const questionStats = @json($questionStats);

            const questionChartCtx = document.getElementById('questionChart').getContext('2d');

            const chartConfig = (label, data) => ({
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: label,
                        data: data.map(item => item.count),
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
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

            new Chart(questionChartCtx, chartConfig('Questions Created', questionStats));
        });
    </script>
@endpush
