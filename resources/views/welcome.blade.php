<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KPI Merketing</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #435966">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Perhitungan KPI</a>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Content -->
    <div class="container mt-4">
        <!-- Header Title -->
        <h4 class="mb-4">KPI</h4>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="kpiChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Title -->
        <h4 class="mb-4">Ontime VS Late</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <canvas id="taskChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <canvas id="persentaseChart" style="max-width: 500px; max-height: 255px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->


    <!-- Bootstrap JS (optional for dropdowns etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Chart Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Soal No 1 --}}
    {{-- KPI --}}
    <script>
        // Get Data
        const kpiData = @json($kpimarketing);

        // Inisialisasi Sales, Report, KPI Pada Data Array Object
        const labels = kpiData.map(item => item.Nama);
        const lateSales = kpiData.map(item => parseFloat(item.Late_Sales));
        const salesValues = kpiData.map(item => parseFloat(item.Total_Bobot_Sales));
        const lateReports = kpiData.map(item => parseFloat(item.Late_Report));
        const reportValues = kpiData.map(item => parseFloat(item.Total_Bobot_Report));
        const kpiValues = kpiData.map(item => parseFloat(item.KPI));
        const ctx = document.getElementById('kpiChart').getContext('2d');

        // Chart
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Late Sales',
                    data: lateSales,
                    backgroundColor: '#f44336',
                    borderRadius: 3,
                    maxBarThickness: 20
                },
                {
                    label: 'Total Bobot Sales',
                    data: salesValues,
                    backgroundColor: '#2196f3',
                    borderRadius: 3,
                    maxBarThickness: 20
                },
                {
                    label: 'Late Report',
                    data: lateReports,
                    backgroundColor: '#ff9800',
                    borderRadius: 3,
                    maxBarThickness: 20
                },
                {
                    label: 'Total Bobot Report',
                    data: reportValues,
                    backgroundColor: '#9c27b0',
                    borderRadius: 3,
                    maxBarThickness: 20
                },
                {
                    label: 'KPI',
                    data: kpiValues,
                    backgroundColor: '#4caf50',
                    borderRadius: 3,
                    maxBarThickness: 20
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Sales, Report, Kpi Karyawan (%)'
                },
                tooltip: {
                    callbacks: {
                        label: context => context.dataset.label + ": " + context.raw + '%'
                    }
                }
            },
            scales: {
                y: {
                    max: 100,
                    ticks: {
                        callback: value => value + '%'
                    }
                }
            }
        }
    });
    </script>


    {{-- Soal No 2 --}}
    {{-- Chart Jumlah Ontime dan Late --}}
    <script>
        // Get Data
        const taskData = @json($jumlahPersentase);
        const ctx2 = document.getElementById('taskChart').getContext('2d');

        new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Ontime', 'Late'],
            datasets: [{
                label: 'Jumlah',
                data: [parseFloat(taskData.Jumlah_Ontime),parseFloat(taskData.Jumlah_Late)],
                backgroundColor: '#71b6f9',
                borderRadius: 3,
                barThickness: 30,
            
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Tasklist Ontime vs Late'
                },   
            },
        }
    });
    </script>

    {{-- Chart Persentase Ontime dan Late --}}
    <script>
        const persentaseData = @json($jumlahPersentase);
        const ctx3 = document.getElementById('persentaseChart').getContext('2d');

        new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: ['Ontime', 'Late'],
            datasets: [{
                data: [parseFloat(persentaseData.Persentase_Ontime),parseFloat(persentaseData.Persentase_Late)],
                backgroundColor: ['#10c469', '#f05050'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Persentase Task (%)'
                },
                tooltip: {
                    callbacks: {
                        label: context => context.raw + '%'
                    }
                },
            }
        }
    });
    </script>

</body>

</html>