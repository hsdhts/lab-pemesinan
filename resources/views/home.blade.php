@extends('layouts.header')

@section('konten')

<style>
.modern-card {
    display: block;
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 25px;
    min-height: 200px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.07);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
}

.modern-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15), 0 10px 25px rgba(0,0,0,0.1);
    text-decoration: none;
}

.modern-card-body {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.modern-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 16px;
    box-shadow: 0 8px 25px rgba(255,107,107,0.4);
    animation: pulseEnhanced 2s infinite;
    z-index: 3;
    border: 3px solid rgba(255,255,255,0.3);
    backdrop-filter: blur(10px);
}

.modern-icon-container {
    margin-bottom: 20px;
}

.modern-icon-bg {
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 10px rgba(255,255,255,0.1);
}

.modern-card:hover .modern-icon-bg {
    transform: rotate(360deg) scale(1.1);
    background: rgba(255,255,255,0.25);
}

.modern-icon {
    font-size: 32px;
    color: white;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.modern-content {
    flex-grow: 1;
}

.modern-title {
    color: white;
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 8px;
    letter-spacing: 1px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.modern-subtitle {
    color: rgba(255,255,255,0.9);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 15px;
    opacity: 0.9;
    line-height: 1.4;
    text-shadow: 0 1px 5px rgba(0,0,0,0.2);
}

.modern-arrow {
    align-self: flex-end;
    color: rgba(255,255,255,0.8);
    font-size: 18px;
    transition: all 0.3s ease;
}

.modern-card:hover .modern-arrow {
    transform: translateX(5px);
    color: white;
}

.card-breakdown {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
}

.card-today {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-machine {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.card-user {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

@keyframes pulseEnhanced {
    0% {
        transform: scale(1);
        box-shadow: 0 8px 25px rgba(255,107,107,0.4);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(255,107,107,0.6);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 8px 25px rgba(255,107,107,0.4);
    }
}

/* Responsive Design */
@media (max-width: 1199.98px) {
    .modern-card {
        padding: 20px;
        min-height: 180px;
    }
    .modern-title {
        font-size: 20px;
    }
    .modern-icon-bg {
        width: 60px;
        height: 60px;
    }
    .modern-icon {
        font-size: 28px;
    }
}

@media (max-width: 991.98px) {
    .modern-card {
        padding: 18px;
        min-height: 160px;
        margin-bottom: 20px;
    }
    .modern-title {
        font-size: 18px;
    }
    .modern-subtitle {
        font-size: 13px;
    }
    .modern-icon-bg {
        width: 55px;
        height: 55px;
    }
    .modern-icon {
        font-size: 24px;
    }
    .modern-badge {
        width: 45px;
        height: 45px;
        font-size: 14px;
    }
}

@media (max-width: 767.98px) {
    .modern-card {
        padding: 15px;
        min-height: 140px;
        margin-bottom: 15px;
    }
    .modern-title {
        font-size: 16px;
        margin-bottom: 6px;
    }
    .modern-subtitle {
        font-size: 12px;
        margin-bottom: 10px;
    }
    .modern-icon-container {
        margin-bottom: 15px;
    }
    .modern-icon-bg {
        width: 50px;
        height: 50px;
    }
    .modern-icon {
        font-size: 22px;
    }
    .modern-badge {
        width: 40px;
        height: 40px;
        font-size: 12px;
        top: -8px;
        right: -8px;
    }
}

@media (max-width: 575.98px) {
    .modern-card {
        padding: 12px;
        min-height: 120px;
        margin-bottom: 12px;
    }
    .modern-title {
        font-size: 14px;
        margin-bottom: 4px;
    }
    .modern-subtitle {
        font-size: 11px;
        margin-bottom: 8px;
    }
    .modern-icon-container {
        margin-bottom: 12px;
    }
    .modern-icon-bg {
        width: 45px;
        height: 45px;
    }
    .modern-icon {
        font-size: 20px;
    }
    .modern-badge {
        width: 35px;
        height: 35px;
        font-size: 11px;
        top: -6px;
        right: -6px;
    }
    .modern-arrow {
        font-size: 16px;
    }
}
</style>

@include('partials.modalReminder')

    <!--begin::Row-->
    <div class="row g-3 g-md-4 g-xl-5">
        <div class="col-12 col-sm-6 col-lg-3">
            <!--begin::Modern Statistics Widget-->
            <a href="{{ route('mesin.index') }}" class="modern-card card-breakdown text-decoration-none">
                <div class="modern-card-body">

                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-tools modern-icon"></i>
                        </div>
                    </div>

                    <div class="modern-content">
                        <h3 class="modern-title">BREAKDOWN</h3>
                        <p class="modern-subtitle">Laporkan Kerusakan Disini!</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <!--begin::Modern Statistics Widget-->
            <a class="modern-card card-today text-decoration-none" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                <div class="modern-card-body">
                    @if($hari_ini->count() > 0 and $hari_ini->count() < 100)
                    <span class="modern-badge">{{ $hari_ini->count() }}</span>
                    @elseif($hari_ini->count() > 100)
                    <span class="modern-badge">99+</span>
                    @endif

                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-calendar-check modern-icon"></i>
                        </div>
                    </div>

                    <div class="modern-content">
                        <h3 class="modern-title">BREAKDOWN LIST</h3>
                        <p class="modern-subtitle">Daftar Breakdown Terkini!</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <!--begin::Modern Statistics Widget-->
            <a href="{{ route('jadwal.all') }}" class="modern-card card-maintenance text-decoration-none">
                <div class="modern-card-body">

                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-calendar-alt modern-icon"></i>
                        </div>
                    </div>

                    <div class="modern-content">
                        <h3 class="modern-title">MAINTENANCE</h3>
                        <p class="modern-subtitle">Jadwal Maintenance Preventif</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <!--begin::Modern Statistics Widget-->
            <a class="modern-card card-user text-decoration-none" data-bs-toggle="modal" data-bs-target="#kt_modal_4">
                <div class="modern-card-body">
                    @if($sebulan->count() > 0 and $sebulan->count() < 100)
                    <span class="modern-badge">{{ $sebulan->count() }}</span>
                    @elseif($sebulan->count() > 100)
                    <span class="modern-badge">99+</span>
                    @endif

                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-users modern-icon"></i>
                        </div>
                    </div>

                    <div class="modern-content">
                        <h3 class="modern-title">USER</h3>
                        <p class="modern-subtitle">Data Total User</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>
    </div>
    <!--end::Row-->

    <div class="card card-bordered">
        <div class="card-header border-0 pt-5">
            <h1 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-1 mb-1">REALISASI</span>
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

        // Handle status dropdown changes
        $(document).on('change', '.status-dropdown', function() {
            const jadwalId = $(this).data('jadwal-id');
            const newStatus = $(this).val();
            const originalStatus = $(this).data('original-status');
            const dropdown = $(this);

            // Show loading state
            dropdown.prop('disabled', true);

            $.ajax({
                url: `/jadwal/update-status/${jadwalId}`,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    status: newStatus
                }),
                success: function(response) {
                    if (response.success) {
                        // Update the original status
                        dropdown.data('original-status', newStatus);

                        // Update CSS class for visual feedback
                        dropdown.removeClass('status-1 status-2').addClass('status-' + newStatus);

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Status berhasil diperbarui',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        // Revert to original status
                        dropdown.val(originalStatus);

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat memperbarui status'
                        });
                    }
                },
                error: function(xhr) {
                    // Revert to original status
                    dropdown.val(originalStatus);

                    let errorMessage = 'Terjadi kesalahan saat memperbarui status';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage
                    });
                },
                complete: function() {
                    // Re-enable dropdown
                    dropdown.prop('disabled', false);
                }
            });
        });
    </script>
@endsection
