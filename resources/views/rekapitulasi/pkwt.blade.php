@extends('layouts.main')
@push('style')

@endpush
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="example-select">Pilih Unit</label>
                        <select class="form-control" id="example-select">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <button type="button" id="refresh" class="btn btn-primary btn-submit waves-effect waves-light">Refresh</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="canvas-area">
                                <canvas id="myChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <canvas id="pkwt"></canvas>
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
                    2022 - <script>document.write(new Date().getFullYear())</script> &copy; Sistem Informasi GAP Karyawan <a href="">Peruri</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    @php
        $pkwts = json_encode($pkwt_labels);
        $counts = json_encode($counts);
    @endphp
</div>
@endsection
@push('script')
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const pkwts = `{!! $pkwts !!}`;
    const counts = `{!! $counts !!}`;

    let label = JSON.parse(pkwts)
    let count_label = JSON.parse(counts)

    $(document).ready(function () {
        $(document).on('click', '#refresh', function () {
            clearChart();
            getCountCart(label, count_label);
        });
        $(document).on('change', '#example-select', function() {
            $('.form-process').css('display', 'block');
            let this_val = $(this).val();
            $.ajax({
                url: '{{ route('count.pkwt') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": 'POST',
                    "unit_id": this_val
                },
                success: function(response) {
                    if (response.status == 'true') {
                        clearChart();
                        getCountCart(response.pkwt_labels, response.counts);
                    } else {
                        console.log('response');
                    }
                    $('.form-process').css('display', 'none');
                }, error: function (request, status, error) {
                    console.log(error);
                    $('.form-process').css('display', 'none');
                }
            });
        });
    });

    function clearChart() {
        var grapharea = document.getElementById("myChart");
        grapharea.remove();
        $('#canvas-area').html(`<canvas id="myChart" width="400" height="400"></canvas>`);
    }

    function getCountCart(label, count_label) {
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'Total',
                    data: count_label,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    getCountCart(label, count_label);
</script>
@endpush
