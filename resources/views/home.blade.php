@extends('layouts.header')

@section('konten')

@include('partials.modalReminder')

    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-danger hoverable card-xl-stretch mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <!--begin::Body-->
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-dark hoverable card-xl-stretch mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
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
                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">HARI INI</div>
                    <div class="fw-bold text-gray-100">Maintenance Pada Hari Ini</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-info hoverable card-xl-stretch mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_3">
                <!--begin::Body-->
                <div class="card-body">
                    @if($seminggu->count() > 0 and $seminggu->count() < 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">{{ $seminggu->count() }}</span>
                    @elseif($seminggu->count() > 100)
                    <span class="position-absolute top-0 fs-3 start-100 p-7 translate-middle badge badge-circle badge-warning">99+</span>
                    @endif

                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg"  shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 461.169" fill="black">
                            <path opacity="0.3" d="M164.327 88.809h232.902v308.103h-11.572l20.326 47.279a11.763 11.763 0 011.181 5.155c0 6.529-5.294 11.823-11.823 11.823H195.626v-.047c-1.318 0-2.658-.223-3.971-.693-6.122-2.192-9.305-8.934-7.113-15.055l17.363-48.462h-37.578c-10.333 0-19.732-4.231-26.547-11.045l-.026-.026c-6.814-6.815-11.046-16.214-11.046-26.548v-15.651H79.376c-5.759 0-11.008-2.358-14.8-6.151-3.785-3.785-6.148-9.022-6.148-14.797v-59.423H20.411C9.139 263.271 0 254.132 0 242.86c0-11.271 9.139-20.41 20.411-20.41h38.017v-59.423c0-5.773 2.351-11.011 6.144-14.803 3.793-3.793 9.03-6.144 14.804-6.144h47.332v-15.652c0-10.334 4.232-19.733 11.046-26.548l.026-.026c6.815-6.813 16.214-11.045 26.547-11.045zM247.214 0h105.097c17.73 0 32.233 14.536 32.233 32.233v.004c0 17.696-14.535 32.233-32.233 32.233H247.214c-17.697 0-32.233-14.505-32.233-32.233v-.004C214.981 14.503 229.486 0 247.214 0zM122.04 165.726H82.075v154.269h39.965V165.726zm298.836-76.238c23.617 2.73 44.866 13.533 60.888 29.557C500.421 137.7 512 163.44 512 191.757v109.537c0 26.302-10.757 50.211-28.083 67.535-16.333 16.334-38.515 26.828-63.041 27.976V89.488zm-58.625 312.798H224.994l-12.624 35.236h165.029l-15.148-35.236zm-161.583-218.22c-7.45 0-13.492-6.042-13.492-13.492 0-7.451 6.042-13.493 13.492-13.493h146.274c7.45 0 13.492 6.042 13.492 13.493 0 7.45-6.042 13.492-13.492 13.492H200.668zm0 147.512c-7.45 0-13.492-6.042-13.492-13.493 0-7.45 6.042-13.492 13.492-13.492h146.274c7.45 0 13.492 6.042 13.492 13.492 0 7.451-6.042 13.493-13.492 13.492H200.668zm0-73.756c-7.45 0-13.492-6.041-13.492-13.492 0-7.45 6.042-13.492 13.492-13.492h146.274c7.45 0 13.492 6.042 13.492 13.492 0 7.451-6.042 13.492-13.492 13.492H200.668z" fill="black"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">Mesin</div>
                    <div class="fw-bold text-white">Data Total Mesin</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-3">
            <!--begin::Statistics Widget 5-->
            <a class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8" data-bs-toggle="modal" data-bs-target="#kt_modal_4">
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
