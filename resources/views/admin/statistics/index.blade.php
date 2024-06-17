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

    {{-- <ul class="nav nav-tabs mt-5" id="tableTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="usersTable-tab" data-bs-toggle="tab" href="#usersTable" role="tab" aria-controls="usersTable" aria-selected="true">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="filesTable-tab" data-bs-toggle="tab" href="#filesTable" role="tab" aria-controls="filesTable" aria-selected="false">Files</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="questionsTable-tab" data-bs-toggle="tab" href="#questionsTable" role="tab" aria-controls="questionsTable" aria-selected="false">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="commentsTable-tab" data-bs-toggle="tab" href="#commentsTable" role="tab" aria-controls="commentsTable" aria-selected="false">Comments</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="tableTabsContent">
        <div class="tab-pane fade show active" id="usersTable" role="tabpanel" aria-labelledby="usersTable-tab">
            @include('admin.users.usercontrol')
        </div>
        <div class="tab-pane fade" id="filesTable" role="tabpanel" aria-labelledby="filesTable-tab">
            
        </div>
        <div class="tab-pane fade" id="questionsTable" role="tabpanel" aria-labelledby="questionsTable-tab">
            
        </div>
        <div class="tab-pane fade" id="commentsTable" role="tabpanel" aria-labelledby="commentsTable-tab">
            
        </div>
    </div> --}}
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

            const ctxTotalStats = document.getElementById('totalStatsChartCanvas').getContext('2d');
            const totalStatsChart = new Chart(ctxTotalStats, {
                type: 'bar',
                data: {
                    labels: ['Total Users', 'Total Files', 'Total Questions', 'Total Comments'],
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
                const chartsContainer = document.getElementById('chartTabsContent');
                html2canvas(chartsContainer).then(function (canvas) {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF();
                    const imgProps = pdf.getImageProperties(imgData);
                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                    pdf.save('charts.pdf');
                });
            });
        });
    </script>
@endpush
