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



</x-form-75-container>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userStats = @json($userStats);
            const fileStats = @json($fileStats);
            const questionStats = @json($questionStats);
            const commentStats = @json($commentStats);

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

            document.getElementById('downloadPdf').addEventListener('click', function () {
                console.log('Download button clicked');
                html2canvas(document.getElementById('combinedChart')).then(canvas => {
                    console.log('Canvas captured');
                    const imgData = canvas.toDataURL('image/png');
                    console.log('Image Data:', imgData);

                    // Create jsPDF document in landscape mode
                    const pdf = new jsPDF('landscape');
                    const pageWidth = pdf.internal.pageSize.width;
                    const pageHeight = pdf.internal.pageSize.height;
                    const imgWidth = pageWidth - 20; // Adjust to fit within the page margins
                    const imgHeight = canvas.height * imgWidth / canvas.width;

                    pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                    pdf.save('chart.pdf');
                    console.log('PDF generated and saved');
                }).catch(function (error) {
                    console.error('Error generating PDF:', error);
                });
            });
        });
    </script>
@endpush



