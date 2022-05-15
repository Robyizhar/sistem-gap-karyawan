@extends('layouts.main')
@push('style')

@endpush
@section('content')
<div class="content-page">
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <form class="form-inline">
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control border" id="dash-daterange">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-blue border-blue text-white">
                                                <i class="mdi mdi-calendar-range"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
                                    <i class="mdi mdi-autorenew"></i>
                                </a>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
                                    <i class="mdi mdi-filter-variant"></i>
                                </a>
                            </form>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">{{ $data['organik'] }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Organik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $data['pkwt'] }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total PKWT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <canvas id="organikPkwt"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <canvas id="level"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2021 - <script>document.write(new Date().getFullYear())</script> &copy; Sistem Informasi GAP Karyawan <a href="">Peruri</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>
@endsection
@push('script')
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/pages/dashboard-2.init.js') }}"></script> --}}
<script>
    let count_organik = `{{ $data['organik'] }}`;
    let count_pkwt = `{{ $data['pkwt'] }}`;

    let count_junior = `{{ $data['junior_organik'] }}`;
    let count_middle = `{{ $data['middle_organik'] }}`;
    let count_senior = `{{ $data['senior_organik'] }}`;
</script>
<script>

    // Perbandingan Organik - PKWT
    const total = parseInt(count_organik) + parseInt(count_pkwt);
    const labels = [
        'ORGANIK' + ' ' + (Math.round(parseInt(count_organik) * 100) / total).toFixed(2) + ' % ',
        'PKWT' + ' ' + (Math.round(parseInt(count_pkwt) * 100) / total).toFixed(2) + ' % '
    ];

    const datas = [
        count_organik,
        count_pkwt
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: ['rgb(54,162,235)', 'rgb(75,192,192)'],
            borderColor: ['rgb(54,162,235)', 'rgb(75,192,192)'],
            data: datas,
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Perbandingan Organik - PKWT'
            }
            }
        },
    };

    // GRADE KARYAWAN ORGANIK
    const totalOrganik = parseInt(count_junior) + parseInt(count_middle) + parseInt(count_senior);
    const labelsOrganik = [
        'JUNIOR' + ' ' + (Math.round(parseInt(count_junior) * 100) / total).toFixed(2) + ' % ',
        'MIDDLE' + ' ' + (Math.round(parseInt(count_middle) * 100) / total).toFixed(2) + ' % ',
        'SENIOR' + ' ' + (Math.round(parseInt(count_senior) * 100) / total).toFixed(2) + ' % '
    ];

    const datasOrganik = [
        count_junior,
        count_middle,
        count_senior
    ];

    const dataOrganik = {
        labels: labelsOrganik,
        datasets: [{
            label: 'My Second dataset',
            backgroundColor: ['rgb(255,201,75)', 'rgb(255,149,43)', 'rgb(255,99,132)'],
            borderColor: ['rgb(255,201,75)', 'rgb(255,149,43)', 'rgb(255,99,132)'],
            data: datasOrganik,
        }]
    };

    const configOrganik = {
        type: 'doughnut',
        data: dataOrganik,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'GRADE'
            }
            }
        },
    };
</script>

<script>
    const organikPkwt = new Chart(
        document.getElementById('organikPkwt'),
        config
    );

    const gradeOrganik = new Chart(
        document.getElementById('level'),
        configOrganik
    );
</script>

@endpush
