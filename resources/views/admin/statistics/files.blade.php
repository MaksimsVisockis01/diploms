@extends('admin.statistics.layout')

@section('page.title', 'File Statistics')

@section('charts')
    <canvas id="fileChart"></canvas>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileStats = @json($fileStats);

            const fileChartCtx = document.getElementById('fileChart').getContext('2d');

            const chartConfig = (label, data) => ({
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: label,
                        data: data.map(item => item.count),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
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

            new Chart(fileChartCtx, chartConfig('File Uploads', fileStats));
        });
    </script>
@endpush
