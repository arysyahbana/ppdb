@extends('admin.app')

@section('title', 'PPDB')

@section('content')

    {{-- 4 Data --}}
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Pendaftar</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $pendaftar ?? 0 }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i> {{-- Ikon orang --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Jurusan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $jurusan ?? 0 }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i> {{-- Ikon pendidikan --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Lolos Verifikasi Berkas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $lolos ?? 0 }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i> {{-- Ikon centang --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gagal Verifikasi Berkas</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $tolak ?? 0 }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i> {{-- Ikon silang --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100 justify-content-center mx-5">
                                <p class="mb-1 pt-2 text-bold fs-5">Selamat Datang</p>
                                <h4 class="font-weight-bolder">{{ Auth::user()->name }}</h4>
                                <p class="mb-5 text-sm">Semoga harimu menyenangkan ^^</p>
                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                            <div class="bg-gradient-primary border-radius-lg h-100">
                                <img src={{ asset('dist/assets/img/shapes/waves-white.svg') }}
                                    class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4"
                                        src={{ asset('dist/assets/img/illustrations/rocket-white.png') }} alt="rocket">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card z-index-2">
                <div class="card-body p-5">
                    <div class="chart" style="width: 225px; height: 225px; margin: auto;">
                        <canvas id="doughnut" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                    {{-- <div class="card-header pb-0">
                        <h6>Sales overview</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div> --}}
                <div class="card-body p-5">
                    <div class="chart d-flex justify-content-center align-items-center" style="height: 500px; margin: auto;">
                        <canvas id="barchart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>

    {{-- Bar Chart --}}
    <script>
        const labels = {!! json_encode($chartData->pluck('label')) !!};
        const dataCounts = {!! json_encode($chartData->pluck('count')) !!};

        const data = {
            labels: labels,
            datasets: [{
                label: "Jumlah Siswa per Jurusan",
                data: dataCounts,
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)",
                    "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)",
                    "rgba(201, 203, 207, 0.2)"
                ],
                borderColor: [
                    "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)",
                    "rgb(201, 203, 207)"
                ],
                borderWidth: 1
            }]
        };

        const config = {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            scales: {
            y: {
                beginAtZero: true,
                ticks: {
                callback: function(value) {
                    if (Number.isInteger(value)) {
                    return value;
                    }
                },
                stepSize: 1
                }
            }
            }
        }
        };

        const ctx100 = document.getElementById("barchart").getContext("2d");
        const barchart = new Chart(ctx100, config);
    </script>

    {{-- doughnut --}}
    <script>
        const labelsGender = {!! json_encode($genderChart->pluck('label')) !!};
        const dataGender = {!! json_encode($genderChart->pluck('count')) !!};

        const genderChartData = {
            labels: labelsGender,
            datasets: [{
                label: "Jumlah Siswa per Jenis Kelamin",
                data: dataGender,
                backgroundColor: [
                    "rgba(54, 162, 235, 0.6)",   // Laki-laki
                    "rgba(255, 99, 132, 0.6)"    // Perempuan
                ],
                borderColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 99, 132)"
                ],
                borderWidth: 1
            }]
        };

        const genderChartConfig = {
            type: "doughnut",
            data: genderChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' siswa';
                            }
                        }
                    }
                }
            }
        };

        const ctx101 = document.getElementById("doughnut").getContext("2d");
        const doughnut = new Chart(ctx101, genderChartConfig);
    </script>

@endsection
