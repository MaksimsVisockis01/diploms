@extends('layouts.base')

@section('page.title', 'Admin Statistics')

@section('content')
<x-form-75-container>
    <x-forms-header>
        <x-forms-heading>Statistics</x-forms-heading>
        <x-pdf-button>
            <button id="downloadPdf" class="btn btn-secondary">Download PDF</button>
        </x-pdf-button>
    </x-forms-header>
    
    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="timeSeriesChart-tab" data-bs-toggle="tab" href="#timeSeriesChart" role="tab" aria-controls="timeSeriesChart" aria-selected="true">Time Series Chart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="totalStatsChart-tab" data-bs-toggle="tab" href="#totalStatsChart" role="tab" aria-controls="totalStatsChart" aria-selected="false">Total Stats Chart</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="chartTabsContent">
        <div class="tab-pane fade show active" id="timeSeriesChart" role="tabpanel" aria-labelledby="timeSeriesChart-tab">
            <x-filter-container>
                <form action="{{ route('admin.statistics') }}" method="GET">
                    @csrf
                    <x-filters-container>
                        <x-filter-parametr-container>
                            <select name="date_filter" id="date_filter" class="form-control">
                                <option value="daily" {{ $dateFilter == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ $dateFilter == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ $dateFilter == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ $dateFilter == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                        </x-filter-parametr-container>

                        <x-filter-parametr-container>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $date }}">
                        </x-filter-parametr-container>

                        <x-filter-parametr-container>
                            <input type="number" name="intervals" id="intervals" class="form-control" value="{{ $intervals }}">
                        </x-filter-parametr-container>
                        <x-filter-parametr-container>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </x-filter-parametr-container>
                    </x-filters-container>
                </form>
            </x-filter-container>

            <div class="chart-container mt-5">
                <canvas id="combinedChart"></canvas>
            </div>
        </div>
        <div class="tab-pane fade" id="totalStatsChart" role="tabpanel" aria-labelledby="totalStatsChart-tab">
            <div class="chart-container mt-5">
                <canvas id="totalStatsChartCanvas"></canvas>
            </div>
        </div>
    </div>
</x-form-75-container>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userStats = @json($userStats);
            const fileStats = @json($fileStats);
            const questionStats = @json($questionStats);
            const commentStats = @json($commentStats);

            const totalUsers = @json($totalUsers);
            const totalFiles = @json($totalFiles);
            const totalQuestions = @json($totalQuestions);
            const totalComments = @json($totalComments);

            const ctx = document.getElementById('combinedChart').getContext('2d');
            const combinedChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: userStats.map(item => item.date),
                    datasets: [
                        {
                            label: 'Users',
                            data: userStats.map(item => item.count),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Files',
                            data: fileStats.map(item => item.count),
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Questions',
                            data: questionStats.map(item => item.count),
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Comments',
                            data: commentStats.map(item => item.count),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const totalCtx = document.getElementById('totalStatsChartCanvas').getContext('2d');
            const totalStatsChart = new Chart(totalCtx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Files', 'Questions', 'Comments'],
                    datasets: [
                        {
                            label: 'Total Count',
                            data: [totalUsers, totalFiles, totalQuestions, totalComments],
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            document.getElementById('downloadPdf').addEventListener('click', function () {
                const activeTabId = document.querySelector('.nav-tabs .nav-link.active').id;
                let canvasId;
                switch (activeTabId) {
                    case 'timeSeriesChart-tab':
                        canvasId = 'combinedChart';
                        break;
                    case 'totalStatsChart-tab':
                        canvasId = 'totalStatsChartCanvas';
                        break;
                }

                const canvas = document.getElementById(canvasId);
                const canvasImage = canvas.toDataURL('image/png', 1.0);
                const pdf = new jsPDF('landscape');
                pdf.setFontSize(20);
                pdf.text(15, 15, "Statistics Report");
                pdf.addImage(canvasImage, 'PNG', 10, 10, 280, 150);
                pdf.save('statistics.pdf');
            });
        });
    </script>
@endpush