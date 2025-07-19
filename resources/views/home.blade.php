@extends('layouts.header')

@section('konten')
@include('partials.modalReminder')

<div class="row mb-5">
    <div class="col-12 px-0"> <!-- Menghapus padding horizontal pada kolom -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dashboard Maintenance & Breakdown</h3>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Maintenance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Breakdown</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-0"> <!-- Menghapus semua padding pada card-body -->
                <div class="container-fluid p-0"> <!-- Menghapus semua padding pada container -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <!-- Maintenance Dashboard -->
                            <div class="row g-5 g-xl-10 mb-8 px-4">
                                <div class="col-xl-3">
                                    <a class="card bg-danger hoverable h-100"> <!-- Mengubah card-xl-stretch menjadi h-100 -->
                                        <div class="card-body p-5"> <!-- Menambah padding -->
                                            @if($terlambat->count() > 0 and $terlambat->count() < 100)
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-warning">{{ $terlambat->count() }}</span>
                                            @elseif($terlambat->count() > 100)
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-warning">99+</span>
                                            @endif
                                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6.5 11C8.98528 11 11 8.98528 11 6.5C11 4.01472 8.98528 2 6.5 2C4.01472 2 2 4.01472 2 6.5C2 8.98528 4.01472 11 6.5 11Z" fill="white"/>
                                                    <path opacity="0.3" d="M13 6.5C13 4 15 2 17.5 2C20 2 22 4 22 6.5C22 9 20 11 17.5 11C15 11 13 9 13 6.5ZM6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22ZM17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22Z" fill="white"/>
                                                </svg>
                                            </span>
                                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">TERLAMBAT</div> <!-- Memperbesar font -->
                                            <div class="fw-bold text-white fs-3">Maintenance yang melebihi tanggal rencana</div> <!-- Memperbesar font -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3">
                                    <a class="card bg-dark hoverable h-100"> <!-- Mengubah card-xl-stretch menjadi h-100 -->
                                        <div class="card-body p-5"> <!-- Menambah padding -->
                                            @if($hari_ini->count() > 0 and $hari_ini->count() < 100)
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-warning">{{ $hari_ini->count() }}</span>
                                            @elseif($hari_ini->count() > 100)
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-warning">99+</span>
                                            @endif
                                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="white"/>
                                                    <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="white"/>
                                                    <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="white"/>
                                            </svg>
                                        </span>
                                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">HARI INI</div> <!-- Memperbesar font -->
                                        <div class="fw-bold text-white fs-3">Maintenance Pada Hari Ini</div> <!-- Memperbesar font -->
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3">
                                <a class="card bg-info hoverable h-100"> <!-- Mengubah card-xl-stretch menjadi h-100 -->
                                    <div class="card-body p-5"> <!-- Menambah padding -->
                                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="white"/>
                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="white"/>
                                            </svg>
                                        </span>
                                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">Mesin</div> <!-- Memperbesar font -->
                                        <div class="fw-bold text-white">Data Total Mesin</div> <!-- Memperbesar font -->
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3">
                                <a class="card bg-success hoverable h-100"> <!-- Mengubah card-xl-stretch menjadi h-100 -->
                                    <div class="card-body p-5"> <!-- Menambah padding -->
                                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="white"/>
                                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="white"/>
                                            </svg>
                                        </span>
                                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">User</div> <!-- Memperbesar font -->
                                        <div class="fw-bold text-white">Data Total User</div> <!-- Memperbesar font -->
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card card-bordered mt-5">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">RENCANA & REALISASI</span>
                                    <span class="text-muted fw-bold fs-7">Tahun : {{ now()->year }}</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="kt_apexcharts_1" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                        <!-- Breakdown Dashboard -->
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10 px-5">
                            <div class="col-xl-3">
                                <a class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" fill="black"/>
                                            </svg>
                                        </span>
                                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">PENDING</div>
                                        <div class="fw-bold text-gray-100">Breakdown yang belum ditangani</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3">
                                <a class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 16 16">
                                                <path d="M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3zm4 8a4 4 0 0 1-8 0V5a4 4 0 1 1 8 0v6z" fill="black"/>
                                            </svg>
                                        </span>
                                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">PROSES</div>
                                        <div class="fw-bold text-gray-100">Breakdown dalam perbaikan</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3">
                                <a class="card bg-success hoverable card-xl-stretch mb-xl-8">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 16 16">
                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" fill="black"/>
                                            </svg>
                                        </span>
                                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">SELESAI</div>
                                        <div class="fw-bold text-gray-100">Breakdown selesai diperbaiki</div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3">
                                <a class="card bg-info hoverable card-xl-stretch mb-xl-8">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" fill="black"/>
                                            </svg>
                                        </span>
                                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">TOTAL</div>
                                        <div class="fw-bold text-gray-100">Total kasus breakdown</div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card card-bordered">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Statistik Breakdown</span>
                                    <span class="text-muted fw-bold fs-7">Tahun: {{ now()->year }}</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="breakdown_chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    // Chart Maintenance
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

    // Chart Breakdown
    var breakdownChart = document.getElementById('breakdown_chart');
    if (breakdownChart) {
        var breakdownOptions = {
            series: [{
                name: 'Total Breakdown',
                data: [@for($i = 1; $i <= 12; $i++){{ $breakdown_monthly[$i] ?? 0 }},@endfor]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: 350,
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
                show: false
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
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
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
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val + " kasus";
                    }
                }
            },
            colors: [baseColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var breakdownChartObj = new ApexCharts(breakdownChart, breakdownOptions);
        breakdownChartObj.render();
    }
</script>
@endsection
