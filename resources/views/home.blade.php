@extends('layouts.header')

@section('konten')

@include('partials.modalReminder')

    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-3">
            <!--begin::Modern Statistics Widget-->
            <a href="{{ url('/jadwal/all') }}" class="modern-card card-riwayat text-decoration-none">
                <div class="modern-card-body">
                    @if($total_jadwal->count() > 0 and $total_jadwal->count() < 100)
                    <span class="modern-badge">{{ $total_jadwal->count() }}</span>
                    @elseif($total_jadwal->count() > 100)
                    <span class="modern-badge">99+</span>
                    @endif
                    
                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-history modern-icon"></i>
                        </div>
                    </div>
                    
                    <div class="modern-content">
                        <h3 class="modern-title">RIWAYAT</h3>
                        <p class="modern-subtitle">Riwayat Semua Data Breakdown</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>

        <div class="col-xl-3">
            <!--begin::Modern Statistics Widget-->
            <a href="{{ url('/mesin') }}" class="modern-card card-breakdown text-decoration-none">
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

        <div class="col-xl-3">
            <!--begin::Modern Statistics Widget-->
            <a class="modern-card card-hari-ini text-decoration-none" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                <div class="modern-card-body">
                    @if($hari_ini->count() > 0 and $hari_ini->count() < 100)
                    <span class="modern-badge">{{ $hari_ini->count() }}</span>
                    @elseif($hari_ini->count() > 100)
                    <span class="modern-badge">99+</span>
                    @endif
                    
                    <div class="modern-icon-container">
                        <div class="modern-icon-bg">
                            <i class="fas fa-calendar-day modern-icon"></i>
                        </div>
                    </div>
                    
                    <div class="modern-content">
                        <h3 class="modern-title">HARI INI</h3>
                        <p class="modern-subtitle">Breakdown Pada Hari Ini</p>
                        <div class="modern-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            <!--end::Modern Statistics Widget-->
        </div>

        <div class="col-xl-3">
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
                        <h3 class="modern-title">USERS</h3>
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

    <div class="modern-chart-card">
        <div class="modern-chart-header">
            <div class="chart-title-container">
                <h1 class="chart-main-title">RENCANA & REALISASI</h1>
                <span class="chart-subtitle">Tahun : {{ now(7)->year }}</span>
            </div>
            <div class="chart-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
        </div>
        <div class="modern-chart-body">
            <div id="kt_apexcharts_1" style="height: 420px;"></div>
        </div>
    </div>


@endsection

@section('customJs')
    <style>
        /* Modern Card Styles */
        .modern-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 25px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            margin-bottom: 2rem;
            cursor: pointer;
            min-height: 200px;
            display: flex;
            align-items: center;
        }
        
        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0.08) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .modern-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.2) 0%, transparent 50%);
            opacity: 0.6;
            pointer-events: none;
        }
        
        .modern-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }
        
        .modern-card:hover::before {
            opacity: 1;
        }
        
        .modern-card-body {
            padding: 2.5rem 2rem;
            position: relative;
            z-index: 2;
            width: 100%;
            text-align: center;
        }
        
        .modern-badge {
            position: absolute;
            top: -15px;
            right: -15px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
            animation: pulse 2s infinite;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .modern-icon-container {
            margin-bottom: 1.5rem;
        }
        
        .modern-icon-bg {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(15px);
            transition: all 0.4s ease;
            margin: 0 auto 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .modern-card:hover .modern-icon-bg {
            transform: rotate(15deg) scale(1.15);
            background: rgba(255, 255, 255, 0.35);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
        }
        
        .modern-icon {
            font-size: 2.2rem;
            color: white;
            transition: all 0.4s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }
        
        .modern-content {
            color: white;
        }
        
        .modern-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 0.8rem;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .modern-subtitle {
            font-size: 1rem;
            opacity: 0.95;
            margin-bottom: 1.5rem;
            line-height: 1.5;
            font-weight: 500;
        }
        
        .modern-arrow {
            opacity: 0;
            transform: translateX(-15px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 1.2rem;
            margin-top: 0.5rem;
        }
        
        .modern-card:hover .modern-arrow {
            opacity: 1;
            transform: translateX(5px);
        }
        
        .modern-card:hover .modern-arrow i {
            animation: arrowBounce 1s ease-in-out infinite;
        }
        
        @keyframes arrowBounce {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(5px); }
        }
        
        /* Specific card colors with enhanced gradients */
        .card-riwayat {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #5a67d8 100%);
        }
        
        .card-breakdown {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #e53e3e 100%);
        }
        
        .card-hari-ini {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 50%, #0bc5ea 100%);
        }
        
        .card-user {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 50%, #2dd4bf 100%);
        }
        
        /* Modern Chart Card */
        .modern-chart-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }
        
        .modern-chart-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .modern-chart-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chart-main-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        
        .chart-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }
        
        .chart-icon {
            font-size: 3rem;
            opacity: 0.3;
        }
        
        .modern-chart-body {
            padding: 2rem;
        }
        
        /* Enhanced responsive adjustments */
        @media (max-width: 992px) {
            .modern-card {
                min-height: 180px;
            }
            
            .modern-card-body {
                padding: 2rem 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .modern-card {
                min-height: 160px;
                margin-bottom: 1.5rem;
            }
            
            .modern-card-body {
                padding: 1.5rem;
            }
            
            .modern-title {
                font-size: 1.4rem;
                letter-spacing: 1px;
            }
            
            .modern-subtitle {
                font-size: 0.9rem;
            }
            
            .modern-icon-bg {
                width: 70px;
                height: 70px;
                margin-bottom: 1rem;
            }
            
            .modern-icon {
                font-size: 1.8rem;
            }
            
            .chart-main-title {
                font-size: 1.5rem;
            }
            
            .modern-badge {
                width: 45px;
                height: 45px;
                font-size: 0.9rem;
            }
        }
        
        /* Enhanced loading animation for cards */
        .modern-card {
            animation: fadeInUp 0.8s ease-out;
            animation-fill-mode: both;
        }
        
        .col-xl-3:nth-child(1) .modern-card { animation-delay: 0.1s; }
        .col-xl-3:nth-child(2) .modern-card { animation-delay: 0.2s; }
        .col-xl-3:nth-child(3) .modern-card { animation-delay: 0.3s; }
        .col-xl-3:nth-child(4) .modern-card { animation-delay: 0.4s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Floating animation for cards */
        .modern-card {
            animation: fadeInUp 0.8s ease-out, float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .col-xl-3:nth-child(1) .modern-card { animation-delay: 0.1s, 0s; }
        .col-xl-3:nth-child(2) .modern-card { animation-delay: 0.2s, 1.5s; }
        .col-xl-3:nth-child(3) .modern-card { animation-delay: 0.3s, 3s; }
        .col-xl-3:nth-child(4) .modern-card { animation-delay: 0.4s, 4.5s; }
    </style>
    
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
            
        // Add interactive effects to modern cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.modern-card');
            
            cards.forEach((card, index) => {
                // Add stagger animation
                card.style.animationDelay = `${index * 0.1}s`;
                
                // Add click ripple effect
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    const rect = card.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                        z-index: 1;
                    `;
                    
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(2);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
        
        // Handle status dropdown change for modal reminder
        $(document).ready(function() {
            $('.status-dropdown').on('change', function() {
                const dropdown = $(this);
                const jadwalId = dropdown.data('jadwal-id');
                const newStatus = dropdown.val();
                const originalStatus = dropdown.data('original-status');
                
                // Show loading state
                dropdown.prop('disabled', true);
                
                // Send AJAX request
                $.ajax({
                    url: `/jadwal/update-status/${jadwalId}`,
                    type: 'PUT',
                    data: {
                        status: newStatus,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update the original status data attribute
                            dropdown.data('original-status', newStatus);
                            
                            // Show success notification
                            if (typeof toastr !== 'undefined') {
                                toastr.success('Status berhasil diperbarui!');
                            }
                        } else {
                            // Revert dropdown to original value
                            dropdown.val(originalStatus);
                            
                            if (typeof toastr !== 'undefined') {
                                toastr.error('Gagal memperbarui status: ' + (response.message || 'Terjadi kesalahan'));
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Revert dropdown to original value
                        dropdown.val(originalStatus);
                        
                        let errorMessage = 'Terjadi kesalahan saat memperbarui status';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        if (typeof toastr !== 'undefined') {
                            toastr.error(errorMessage);
                        }
                        
                        console.error('Error updating status:', error);
                    },
                    complete: function() {
                        // Re-enable dropdown
                        dropdown.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
