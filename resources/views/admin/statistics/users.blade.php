@extends('admin.statistics.layout')

@section('page.title', 'User Statistics')

@section('charts')
    <canvas id="userChart"></canvas>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($userStats, 'date')) !!},
                datasets: [{
                    label: 'Users',
                    data: {!! json_encode(array_column($userStats, 'count')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
