@extends('layouts.header')

@section('konten')

@include('partials.modalReminder')

    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-3">
                        <!--begin::Statistics Widget 5-->
            <a href="{{ url('/jadwal/all') }}" class="card bg-primary hoverable card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    @if($total_jadwal->count() > 0 and $total_jadwal->count() < 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">{{ $total_jadwal->count() }}</span>
                    @elseif($total_jadwal->count() > 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">99+</span>
                    @endif
                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.998 2.50006C8.79882 2.50006 6.12448 4.9443 6.00448 8.10006V9.50006H4.50048C3.90048 9.50006 3.50048 9.90006 3.50048 10.5001V19.5001C3.50048 20.1001 3.90048 20.5001 4.50048 20.5001H19.5005C20.1005 20.5001 20.5005 20.1001 20.5005 19.5001V10.5001C20.5005 9.90006 20.1005 9.50006 19.5005 9.50006H18.0005V8.10006C17.8805 4.9443 15.2061 2.50006 11.998 2.50006ZM11.998 4.50006C14.1026 4.50006 15.8005 6.19791 15.8005 8.30256V9.50006H8.19548V8.30256C8.19548 6.19791 9.89332 4.50006 11.998 4.50006Z" fill="black"/>
                            <path opacity="0.3" d="M9.00048 16.5001C8.40048 16.5001 8.00048 16.1001 8.00048 15.5001C8.00048 14.9001 8.40048 14.5001 9.00048 14.5001H15.0005C15.6005 14.5001 16.0005 14.9001 16.0005 15.5001C16.0005 16.1001 15.6005 16.5001 15.0005 16.5001H9.00048Z" fill="black"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">RIWAYAT</div>
                    <div class="fw-bold text-white">Riwayat Semua Data Breakdown</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>

                <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a href="{{ url('/mesin') }}" class="card bg-primary hoverable card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    {{-- <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-danger">0</span> --}}
                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C2.05 18.225 1.5 17.525 1.5 16.725V7.225C1.5 6.425 2.05 5.725 2.75 5.425L10.95 2.125C11.65 1.825 12.35 1.825 13.05 2.125L21.25 5.425C21.95 5.725 22.5 6.425 22.5 7.225V16.725C22.5 17.525 21.95 18.225 21.25 18.525Z" fill="black"></path>
                            <path d="M11.1 15.025L14.9 13.225C15.3 13.025 15.3 12.525 14.9 12.325L11.1 10.525C10.7 10.325 10.3 10.725 10.3 11.125V14.425C10.3 14.825 10.7 15.225 11.1 15.025Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">BREAKDOWN</div>
                    <div class="fw-bold text-white">Laporkan Kerusakan Disini!</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-warning hoverable card-xl-stretch mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                <!--begin::Body-->
                <div class="card-body">
                    @if($hari_ini->count() > 0 and $hari_ini->count() < 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">{{ $hari_ini->count() }}</span>
                    @elseif($hari_ini->count() > 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">99+</span>
                    @endif
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" fill="black"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" fill="black"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">HARI INI</div>
                    <div class="fw-bold text-white">Breakdown Pada Hari Ini</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_4">
                <!--begin::Body-->
                <div class="card-body">
                    @if($sebulan->count() > 0 and $sebulan->count() < 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">{{ $sebulan->count() }}</span>
                    @elseif($sebulan->count() > 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">99+</span>
                    @endif
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" fill="black"/>
                            </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">User</div>
                    <div class="fw-bold text-white">Data Total User</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>

    </div>
    <!--end::Row-->

    <div class="card card-bordered">
        <div class="card-header border-0 pt-5">
            <h1 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-1 mb-1">RENCANA & REALISASI</span>
                <span class="text-muted fw-bold fs-7">Tahun : {{ now(7)->year }}</span>
            </h1>
        </div>
        <div class="card-body">
            <div id="kt_apexcharts_1" style="height: 420px;"></div>
        </div>
    </div>


@endsection

@section('customJs')
    <script>
            var element = document.getElementById('kt_apexcharts_1');

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-700');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-400');
            var baseColor = KTUtil.getCssVariableValue('--bs-primary');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-warning');



            var options = {
                series: [{
                    name: 'Rencana',
                    data: [ @for($i = 1; $i <= 12; $i++)@if($chart_rencana->get($i)){{$chart_rencana->get($i)}},@else 0,@endif @endfor ]
                }, {
                    name: 'Realisasi',
                    data: [@for($i = 1; $i <= 12; $i++)@if($chart_realisasi->get($i)){{$chart_realisasi->get($i)}},@else 0,@endif @endfor ]
                },

            ],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['50%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: true
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '15px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '14px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '16px'
                    },

                },
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                legend:{
                    fontSize: '20px',
                    itemMargin: {
                    horizontal: 10,
                    vertical: 0
                },
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
    </script>
@endsection
