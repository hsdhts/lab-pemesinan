@extends('layouts.header')

@section('customCss')
    <style>
        .tabel-tampil-jadwal td{
    position: relative;
    /*border: 1px #1a1a1a; */
    text-align: center;
    min-width: 40px;
}

.tabel-tampil-jadwal thead th,
.tabel-tampil-jadwal thead td{
   /* border-collapse: collapse; */
   font-size: small;
   position: sticky;
   top: 0;
   background-color: white;
   z-index: 1;
}
.tabel-tampil-jadwal thead th:first-child,
.tabel-tampil-jadwal td:first-child{
    position: sticky;
    left: 0;
    color: #212529;
    z-index: 2;
    min-width: 300px;
    font-size: small;
    text-align: left;
    background-color: #009EF7;
}


.tabel-tampil-jadwal thead th:first-child{
    z-index: 4;
}
    </style>
@endsection

@section('styles')
<style>
    /* Modern UI Styles */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --dark-gradient: linear-gradient(135deg, #434343 0%, #000000 100%);
        --glass-bg: rgba(255, 255, 255, 0.25);
        --glass-border: rgba(255, 255, 255, 0.18);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .search-highlight {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        padding: 4px 8px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        animation: highlight 0.3s ease;
    }

    @keyframes highlight {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .filter-section {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        animation: slideInDown 0.6s ease;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-section h5 {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .form-control, .form-select {
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 15px;
        padding: 14px 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 14px;
        font-weight: 500;
    }

    .form-control:focus, .form-select:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3), 0 8px 25px rgba(102, 126, 234, 0.15);
        background: white;
        transform: translateY(-3px) scale(1.02);
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(0, 0, 0, 0.5);
        font-weight: 400;
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .input-group-text {
        background: var(--primary-gradient);
        border: none;
        color: white;
        border-radius: 12px 0 0 12px;
    }

    .btn {
        border-radius: 15px;
        padding: 14px 28px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn:active {
        transform: translateY(-1px) scale(1.02);
    }

    .btn-primary {
        background: var(--primary-gradient);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-secondary {
        background: var(--dark-gradient);
        box-shadow: 0 4px 15px rgba(67, 67, 67, 0.4);
    }

    .btn-secondary:hover {
        box-shadow: 0 8px 25px rgba(67, 67, 67, 0.6);
    }

    .btn-info {
        background: var(--success-gradient);
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
    }

    .btn-success {
        background: var(--warning-gradient);
        box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4);
    }

    .btn-action {
        padding: 8px 16px;
        font-size: 0.85rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        min-width: 80px;
    }

    .btn-action:hover {
        transform: translateY(-2px) scale(1.05);
    }

    .table-responsive {
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .table {
        margin-bottom: 0;
        background: transparent;
    }

    .table th {
        background: var(--primary-gradient);
        color: white;
        font-weight: 700;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
        padding: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }

    .table td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.9rem;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        border-left: 4px solid var(--primary-gradient);
    }

    .table tbody tr:hover td {
        color: #2d3748;
        font-weight: 500;
    }

    .table tbody tr:nth-child(even) {
        background: rgba(248, 249, 250, 0.5);
    }

    .no-data-message {
        color: #6c757d;
        font-style: italic;
        padding: 40px;
        text-align: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        margin: 20px;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-radius: 16px;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fade-in {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
        100% {
            transform: scale(1);
        }
    }

    /* Loading Spinner Modern */
        .modern-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth Scrollbar */
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
        }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .filter-section {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card {
            border-radius: 16px;
        }
        
        .table-responsive {
            font-size: 0.85rem;
            border-radius: 12px;
        }
        
        .btn-action {
            padding: 6px 12px;
            font-size: 0.75rem;
            min-width: 60px;
        }
        
        .table th, .table td {
            padding: 12px 8px;
        }
        
        .btn {
            padding: 10px 20px;
            font-size: 0.85rem;
        }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-gradient);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-gradient);
    }

    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card Hover Effects */
    .jadwal-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .jadwal-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .jadwal-card .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important;
    }
    
    .jadwal-card .card-header {
        position: relative;
        overflow: hidden;
    }
    
    .jadwal-card .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        transition: all 0.6s ease;
        opacity: 0;
    }
    
    .jadwal-card:hover .card-header::before {
        animation: shimmer 1.5s ease-in-out;
    }
    
    @keyframes shimmer {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
            opacity: 0;
        }
    }
    
    .jadwal-card .badge {
        transition: all 0.3s ease;
    }
    
    .jadwal-card:hover .badge {
        transform: scale(1.05);
    }
    
    .jadwal-card .bg-gradient {
        position: relative;
        overflow: hidden;
    }
    
    .jadwal-card .bg-gradient::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .jadwal-card:hover .bg-gradient::after {
         opacity: 1;
     }
     
     /* List View Styles */
     .list-view {
         display: flex;
         flex-direction: column;
     }
     
     .list-item {
         width: 100% !important;
         margin-bottom: 1rem;
     }
     
     .list-card {
         display: flex;
         flex-direction: row;
         align-items: center;
         min-height: 120px;
     }
     
     .list-card .card-header {
         flex: 0 0 200px;
         margin-bottom: 0;
         border-radius: 12px 0 0 12px;
     }
     
     .list-card .card-body {
         flex: 1;
         display: flex;
         align-items: center;
         padding: 1.5rem;
     }
     
     .list-card .card-footer {
         flex: 0 0 150px;
         border-radius: 0 12px 12px 0;
         display: flex;
         align-items: center;
         justify-content: center;
     }
     
     /* View Toggle Buttons */
     .view-toggle {
         transition: all 0.3s ease;
         border: 2px solid #e2e8f0;
         background: white;
         color: #64748b;
     }
     
     .view-toggle.active {
         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
         border-color: #667eea;
         color: white;
         transform: translateY(-2px);
         box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
     }
     
     .view-toggle:hover:not(.active) {
         border-color: #667eea;
         color: #667eea;
         transform: translateY(-1px);
     }

    /* Utility Classes */
    .fade-in {
        animation: fadeInUp 0.6s ease;
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    /* Load More Button */
    #loadMoreBtn {
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
    }

    #loadMoreBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    #loadMoreBtn:disabled {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        cursor: not-allowed;
    }

    /* Badge Styling */
    .badge {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Icon Wrapper */
    .icon-wrapper {
        transition: all 0.3s ease;
    }

    .jadwal-card:hover .icon-wrapper {
        transform: rotate(10deg) scale(1.1);
    }
</style>
@endsection

@section('konten')


<div class="card fade-in">
    <div class="card-body">
        <div class="filter-section">
            <h5 class="mb-3 pulse"><i class="fas fa-filter me-2"></i>Filter & Pencarian Data</h5>
            <form action="/approve" method="get" id="filterForm">
    <div class="row g-4 mb-4">
        <!-- Search Bar -->
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama mesin atau jenis maintenance..." onkeyup="filterTable()">
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-3">
            <label class="form-label fw-bold">Tanggal Awal</label>
            <div class="input-group date">
                <input type="text" name="tanggal_awal" value="{{ request('tanggal_awal') }}" placeholder="Pilih tanggal awal..." class="form-control @error('tanggal_awal')is-invalid @enderror">
                <button class="btn btn-secondary" type="button">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"/>
                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"/>
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Tanggal Akhir</label>
            <div class="input-group date">
                <input type="text" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" placeholder="Pilih tanggal akhir..." class="form-control @error('tanggal_akhir')is-invalid @enderror">
                <button class="btn btn-secondary" type="button">
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"/>
                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"/>
                        </svg>
                    </span>
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Filter Mesin</label>
            <select name="mesin_filter" class="form-select" onchange="filterTable()">
                <option value="">Semua Mesin</option>
                @foreach($jadwal as $mesinKey => $mesinVal)
                    <option value="{{ $mesinKey }}" {{ request('mesin_filter') == $mesinKey ? 'selected' : '' }}>{{ $mesinKey }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">&nbsp;</label>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="fas fa-filter me-2"></i>Filter Tanggal
                </button>
                <button type="button" class="btn btn-secondary" onclick="resetFilter()">
                    <i class="fas fa-refresh"></i>
                </button>
            </div>
        </div>
    </div>
</form>
        </div>
    </div>
</div>

<div class="card mt-4 fade-in">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 pulse"><i class="fas fa-history me-2"></i>History Laporan Pekerjaan</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="badge" style="background: var(--success-gradient); color: white; font-size: 0.9rem; padding: 8px 12px; border-radius: 20px;">
                    <i class="fas fa-chart-bar me-1"></i>Total: <span id="totalRecords">{{ $jadwal->count() }}</span> laporan
                </div>
                @if($jadwal->isNotEmpty())
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#downloadModal" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; font-weight: 600; padding: 10px 16px; font-size: 0.85rem; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-download me-2"></i>Download Laporan
                </button>
                @endif
            </div>
        </div>

@if($jadwal->isNotEmpty())
<div class="container-fluid px-1 py-4 fade-in">
    <div class="position-relative">
        <div class="row g-4" id="historyList">
            @foreach($jadwal as $jd)
            <div class="col-lg-4 col-md-6 jadwal-item" 
                 data-mesin="{{ strtolower($jd->maintenance->mesin->nama_mesin) }}" 
                 data-maintenance="{{ strtolower($jd->maintenance->nama_maintenance) }}" 
                 data-keterangan="{{ strtolower($jd->keterangan ?? '') }}" 
                 data-tanggal="{{ $jd->tanggal_realisasi }}">
                <div class="card jadwal-card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <!-- Card Header with Date Badge -->
                    <div class="card-header border-0 position-relative d-flex justify-content-between align-items-start" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem; border-radius: 16px 16px 0 0;">
                        <!-- Left side - Title -->
                        <div class="text-white">
                            <h6 class="mb-1 fw-bold text-white" style="font-size: 1.1rem;">Maintenance Report</h6>
                            <small class="text-white opacity-75" style="font-size: 0.8rem;">Completed Task</small>
                        </div>
                        
                        <!-- Right side - Date Badge -->
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 text-center" style="backdrop-filter: blur(10px);">
                            <i class="fas fa-calendar-check text-white mb-1 d-block" style="font-size: 1.2rem;"></i>
                            <small class="d-block text-white fw-semibold" style="font-size: 0.7rem;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('d M') }}</small>
                            <small class="d-block text-white opacity-75" style="font-size: 0.65rem;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('Y') }}</small>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body" style="padding: 1.5rem;">
                        <!-- Machine & Maintenance Info -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="bg-gradient rounded-3 p-3 me-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(240, 147, 251, 0.3);">
                                    <i class="fas fa-cogs text-white" style="font-size: 1.2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold" style="color: #1a202c; font-size: 1rem; line-height: 1.3;">{{ $jd->maintenance->mesin->nama_mesin }}</h6>
                                    <p class="mb-2 text-muted" style="font-size: 0.85rem; line-height: 1.4;">{{ $jd->maintenance->nama_maintenance }}</p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-light text-dark me-2" style="font-size: 0.7rem; padding: 4px 8px; border-radius: 8px;">Maintenance</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">Status: Completed</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Info -->
                        <div class="mb-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 h-100" style="border-color: #e2e8f0 !important; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar-alt text-primary me-2" style="font-size: 0.9rem;"></i>
                                            <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Rencana</small>
                                        </div>
                                        <div class="fw-bold" style="font-size: 0.9rem; color: #2d3748;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('d M Y') }}</div>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('l') }}</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 h-100" style="border-color: #10b981 !important; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check-circle text-success me-2" style="font-size: 0.9rem;"></i>
                                            <small class="text-success fw-semibold" style="font-size: 0.75rem;">Realisasi</small>
                                        </div>
                                        <div class="fw-bold text-success" style="font-size: 0.9rem;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('d M Y') }}</div>
                                        <small class="text-success" style="font-size: 0.7rem;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('l') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                   @if($jd->keterangan)
                        <div class="mb-4">
                            <div class="bg-light rounded-3 p-3" style="border-left: 4px solid #667eea;">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-sticky-note text-primary me-2" style="font-size: 0.85rem;"></i>
                                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">Keterangan</small>
                                </div>
                                <p class="mb-0" style="font-size: 0.85rem; color: #4a5568; line-height: 1.5;">{{ Str::limit($jd->keterangan, 100) }}</p>
                            </div>
                        </div>
                        @endif

                    <!-- Action Buttons -->
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary flex-fill"
                                    onclick="modal_history({{ $jd->id }}, '{{ $jd->maintenance->mesin->nama_mesin }}', '{{ $jd->maintenance->nama_maintenance }}', '{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('d-m-Y') }}', '{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('d-m-Y') }}', '{{ $jd->keterangan ?? '-' }}')"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal_history"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px; font-weight: 600; padding: 12px 16px; font-size: 0.85rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                <i class="fas fa-eye me-2"></i>Detail
                            </button>
                            <a href="/jadwal/detail/{{ $jd->id }}"
                               class="btn btn-success"
                               target="_blank"
                               style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; font-weight: 600; padding: 12px 16px; font-size: 0.85rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-external-link-alt me-2"></i>View
                            </a>
                        </div>
                    </div>

                    <!-- Card Footer with Additional Info -->
                    <div class="card-footer border-0 bg-transparent" style="padding: 0 1.5rem 1.5rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-clock text-muted" style="font-size: 0.75rem;"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem; line-height: 1.2;">Completed on</small>
                                    <small class="fw-semibold" style="font-size: 0.75rem; color: #4a5568;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('H:i, d M Y') }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                @php
                                    $rencana = Illuminate\Support\Carbon::parse($jd->tanggal_rencana);
                                    $realisasi = Illuminate\Support\Carbon::parse($jd->tanggal_realisasi);
                                    $diff = $rencana->diffInDays($realisasi, false);
                                @endphp
                                @if($diff <= 0)
                                    <span class="badge bg-success" style="font-size: 0.7rem; padding: 4px 8px; border-radius: 8px;">
                                         <i class="fas fa-check me-1"></i>On Time
                                    </span>
                                @else
                                    <span class="badge bg-warning" style="font-size: 0.7rem; padding: 4px 8px; border-radius: 8px;">
                                        <i class="fas fa-clock me-1"></i>{{ $diff }} day{{ $diff > 1 ? ' s' : '' }} late
                                    </span> 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center bg-white rounded-3 p-3 shadow-sm">
                        <div class="pagination-info">
                            <span class="text-muted">Showing <span id="currentStart">1</span>-<span id="currentEnd">6</span> of <span id="totalItems">{{ $jadwal->count() }}</span> results</span>
                        </div>
                        <div class="pagination-controls d-flex align-items-center gap-2">
                            <button class="btn btn-outline-primary btn-sm" id="prevPage" onclick="changePage('prev')">
                                <i class="fas fa-chevron-left"></i> Previous
                            </button>
                            <span class="pagination-numbers mx-3">
                                Page <span id="currentPageNum">1</span> of <span id="totalPages">1</span>
                            </span>
                            <button class="btn btn-outline-primary btn-sm" id="nextPage" onclick="changePage('next')">
                                Next <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid px-1 py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 text-center py-5" style="background: rgba(255, 255, 255, 0.95); border-radius: 16px;">
                <div class="card-body">
                    <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="text-muted mb-2">Tidak ada laporan pekerjaan</h4>
                    <p class="text-muted mb-0">Belum ada laporan pekerjaan yang selesai pada periode yang dipilih</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal History -->
<div class="modal fade" id="modal_history" tabindex="-1" aria-labelledby="modal_historyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_historyLabel">Detail Laporan Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <table class="table table-row-dashed table-row-gray-300 gy-5 gs-4">
                    <tr>
                        <th class="fw-bold">Jenis Maintenance</th>
                        <td id="approve_maintenance"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Mesin</th>
                        <td id="approve_mesin"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Rencana</th>
                        <td id="approve_tanggal_rencana"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Realisasi</th>
                        <td id="approve_tanggal_realisasi"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Keterangan</th>
                        <td id="approve_keterangan"></td>
                    </tr>
                </table>

            </div>

            <div class="modal-footer">
                <a class="btn btn-warning" id="link_detail" target="_blank">Lihat Detail</a>
                <form action="/laporan/maintenance" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="jadwal_id" id="download_jadwal_id">
                    <button type="submit" class="btn btn-success">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil009.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM13 15.4V10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10V15.4H8L11.3 18.7C11.7 19.1 12.3 19.1 12.7 18.7L16 15.4H13Z" fill="black"/>
                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        Download Laporan
                    </button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



@endsection

@section('customJs')
<script>

$('.input-group.date').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    language: "id",
    autoclose: true,
    todayHighlight: true,
    orientation: "bottom left"
});



function modal_history(jadwal_id, mesin, maintenance, tgl_rencana, tgl_realisasi, keterangan) {
    document.getElementById('approve_mesin').innerHTML = mesin;
    document.getElementById('approve_maintenance').innerHTML = maintenance;
    document.getElementById('approve_tanggal_rencana').innerHTML = tgl_rencana;
    document.getElementById('approve_tanggal_realisasi').innerHTML = tgl_realisasi;
    document.getElementById('approve_keterangan').innerHTML = keterangan;
    document.getElementById('download_jadwal_id').value = jadwal_id;
    document.getElementById('link_detail').href = '/jadwal/detail/'+jadwal_id;
}

// Fungsi untuk filter list secara real-time
    function filterTable() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const mesinFilter = document.querySelector('select[name="mesin_filter"]').value.toLowerCase();
        const listItems = document.querySelectorAll('.jadwal-item');

        let visibleItems = 0;

        listItems.forEach(function(item) {
            const namaMesin = item.getAttribute('data-mesin') || '';
            const jenisMaintenace = item.getAttribute('data-maintenance') || '';
            const keterangan = item.getAttribute('data-keterangan') || '';
            const tanggal = item.getAttribute('data-tanggal') || '';

            // Cek apakah item cocok dengan filter pencarian
            const matchesSearch = searchInput === '' ||
                namaMesin.includes(searchInput) ||
                jenisMaintenace.includes(searchInput) ||
                keterangan.includes(searchInput) ||
                tanggal.includes(searchInput);

            // Cek apakah item cocok dengan filter mesin
            const matchesMesin = mesinFilter === '' || namaMesin.includes(mesinFilter);

            // Tampilkan atau sembunyikan item dengan animasi
            if (matchesSearch && matchesMesin) {
                item.style.display = 'block';
                item.style.animation = 'fadeInUp 0.3s ease';
                visibleItems++;
            } else {
                item.style.display = 'none';
            }
        });

        // Update counter total records
        updateRecordCounter(visibleItems);

        // Tampilkan pesan jika tidak ada data yang ditemukan
        updateNoDataMessage(visibleItems);

        // Update load more button visibility
        updateLoadMoreButton(visibleItems);
    }

// Fungsi untuk update counter total records
    function updateRecordCounter(visibleItems) {
        const totalRecordsElement = document.getElementById('totalRecords');
        if (totalRecordsElement) {
            totalRecordsElement.textContent = visibleItems;
        }
    }

    // Fungsi untuk menampilkan pesan "tidak ada data"
    function updateNoDataMessage(visibleItems) {
        const listContainer = document.getElementById('historyList');

        // Hapus pesan "tidak ada data" yang sudah ada
        const existingMessage = document.getElementById('noDataMessage');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Tambahkan pesan jika tidak ada data yang terlihat
        if (visibleItems === 0) {
            const noDataDiv = document.createElement('div');
            noDataDiv.id = 'noDataMessage';
            noDataDiv.className = 'col-12';
            noDataDiv.innerHTML = `
                <div class="card border-0 text-center py-5" style="background: rgba(255, 255, 255, 0.95); border-radius: 16px;">
                    <div class="card-body">
                        <i class="fas fa-search-minus text-muted mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                        <h5 class="text-muted mb-2">Tidak ada data yang ditemukan</h5>
                        <p class="text-muted mb-0">Coba ubah kriteria pencarian atau filter yang Anda gunakan</p>
                    </div>
                </div>
            `;
            listContainer.appendChild(noDataDiv);
        }
    }

    // Fungsi untuk update visibility load more button
    function updateLoadMoreButton(visibleItems) {
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        if (loadMoreContainer) {
            if (visibleItems > 0) {
                loadMoreContainer.style.display = 'block';
            } else {
                loadMoreContainer.style.display = 'none';
            }
        }
    }

    // Fungsi untuk load more items (pagination simulation)
    function loadMoreItems() {
        // This is a placeholder for pagination functionality
        // In a real implementation, you would load more data from the server
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';

        setTimeout(() => {
            loadMoreBtn.innerHTML = '<i class="fas fa-check me-2"></i>All data loaded';
            loadMoreBtn.disabled = true;
        }, 1000);
    }

// Fungsi untuk reset filter
function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.querySelector('select[name="mesin_filter"]').value = '';
    document.getElementById('sortSelect').value = 'tanggal_desc';
    document.getElementById('itemsPerPageSelect').value = '12';
    
    // Reset global variables
    currentSort = 'tanggal_desc';
    itemsPerPage = 12;
    currentPage = 1;
    
    applyFiltersAndSort();
}

// Enhanced search function with debouncing
let searchTimeout;
function handleSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFiltersAndSort();
    }, 300); // 300ms delay for better performance
}

// Toggle view function (grid/list)
function toggleView(viewType) {
    const historyList = document.getElementById('historyList');
    const viewButtons = document.querySelectorAll('.view-toggle');
    
    // Update active button
    viewButtons.forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[onclick="toggleView('${viewType}')"]`).classList.add('active');
    
    if (viewType === 'list') {
        historyList.classList.remove('row', 'g-4');
        historyList.classList.add('list-view');
        
        // Update card classes for list view
        document.querySelectorAll('.jadwal-item').forEach(item => {
            item.className = 'jadwal-item list-item mb-3';
            const card = item.querySelector('.jadwal-card');
            if (card) {
                card.classList.add('list-card');
            }
        });
    } else {
        historyList.classList.remove('list-view');
        historyList.classList.add('row', 'g-4');
        
        // Update card classes for grid view
        document.querySelectorAll('.jadwal-item').forEach(item => {
            item.className = 'jadwal-item col-xl-4 col-lg-6 col-md-6';
            const card = item.querySelector('.jadwal-card');
            if (card) {
                card.classList.remove('list-card');
            }
        });
    }
}

// Event listener untuk pencarian real-time
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const mesinSelect = document.querySelector('select[name="mesin_filter"]');

    if (searchInput) {
        // Filter saat mengetik di search box dengan debouncing
        searchInput.addEventListener('input', handleSearch);
    }

    if (mesinSelect) {
        // Filter saat mengubah pilihan mesin
        mesinSelect.addEventListener('change', applyFiltersAndSort);
    }
    
    // Add reset button functionality
    const resetButton = document.getElementById('resetFilter');
    if (resetButton) {
        resetButton.addEventListener('click', resetFilter);
    }

    // Event listener untuk form submit
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            const tanggalAwal = document.querySelector('input[name="tanggal_awal"]').value;
            const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]').value;

            if (!tanggalAwal || !tanggalAkhir) {
                e.preventDefault();
                alert('Silakan pilih tanggal awal dan tanggal akhir terlebih dahulu!');
                return false;
            }
        });
    }

    // Add hover effects to cards
    const cards = document.querySelectorAll('.jadwal-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        });
    });

    // Add stagger animation to cards on load
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';

        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Initialize data and pagination
    initializeData();
    
    // Add event listeners for sorting and pagination controls
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            changeSort(this.value);
        });
    }
    
    const itemsPerPageSelect = document.getElementById('itemsPerPageSelect');
    if (itemsPerPageSelect) {
        itemsPerPageSelect.addEventListener('change', function() {
            changeItemsPerPage(this.value);
        });
    }
    
    // Inisialisasi filter saat halaman dimuat
    filterTable();
});




@error('salah_input')
Swal.fire({
    title: 'Inputan Tanggal Tidak Lengkap!!',
    icon: 'error',
    text: '{{ $message }}',

});
@enderror


@error('tanggal_lebih_besar')
Swal.fire({
    title: 'Input Tanggal Tidak Valid!!',
    icon: 'error',
    text: '{{ $message }}',

});
@enderror
</script>

<!-- Modal Download Laporan -->
@if($jadwal->isNotEmpty())
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title" id="downloadModalLabel">
                    <i class="fas fa-download me-2"></i>Download Laporan Harian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Search and Filter -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="modalSearchInput" placeholder="Cari berdasarkan tanggal...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="modalSortSelect">
                            <option value="date_desc">Tanggal Terbaru</option>
                            <option value="date_asc">Tanggal Terlama</option>
                            <option value="count_desc">Laporan Terbanyak</option>
                            <option value="count_asc">Laporan Tersedikit</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="modalItemsPerPage">
                            <option value="6">6 per halaman</option>
                            <option value="12" selected>12 per halaman</option>
                            <option value="18">18 per halaman</option>
                            <option value="24">24 per halaman</option>
                        </select>
                    </div>
                </div>

                <!-- Grid Layout untuk Tanggal -->
                <div class="row g-3" id="downloadGrid">
                    @php
                        $tanggalList = $jadwal->groupBy(function($item) {
                            return \Illuminate\Support\Carbon::parse($item->tanggal_realisasi)->format('Y-m-d');
                        })->sortKeysDesc();
                    @endphp
                    @foreach($tanggalList as $tanggal => $laporanHarian)
                    <div class="col-xl-3 col-lg-4 col-md-6 download-item" data-date="{{ $tanggal }}" data-count="{{ $laporanHarian->count() }}">
                        <div class="card h-100 shadow-sm border-0 download-card" style="transition: all 0.3s ease; border-radius: 15px;">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-file-pdf text-danger" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <h6 class="card-title fw-bold mb-2" style="color: #2d3748;">
                                    {{ \Illuminate\Support\Carbon::parse($tanggal)->format('d M Y') }}
                                </h6>
                                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                    {{ \Illuminate\Support\Carbon::parse($tanggal)->format('l') }}
                                </p>
                                <div class="mb-3">
                                    <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.85rem;">
                                        <i class="fas fa-list-alt me-1"></i>{{ $laporanHarian->count() }} Laporan
                                    </span>
                                </div>
                                <a href="/laporan/harian?tanggal={{ $tanggal }}" target="_blank" 
                                   class="btn btn-success btn-sm w-100" 
                                   style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 10px; font-weight: 600; padding: 8px 16px;">
                                    <i class="fas fa-download me-2"></i>Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4" id="modalPagination">
                    <div class="text-muted" id="modalShowingInfo">
                        Menampilkan <span id="modalStartItem">1</span>-<span id="modalEndItem">12</span> dari <span id="modalTotalItems">{{ $tanggalList->count() }}</span> tanggal
                    </div>
                    <nav aria-label="Download pagination">
                        <ul class="pagination pagination-sm mb-0" id="modalPaginationList">
                            <!-- Pagination akan diisi oleh JavaScript -->
                        </ul>
                    </nav>
                </div>

                <!-- No Data Message -->
                <div id="modalNoData" class="text-center py-5" style="display: none;">
                    <div class="mb-3">
                        <i class="fas fa-search text-muted" style="font-size: 48px;"></i>
                    </div>
                    <h6 class="text-muted">Tidak ada data yang ditemukan</h6>
                    <p class="text-muted mb-0">Coba ubah kata kunci pencarian Anda</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Modal Download Laporan JavaScript
document.addEventListener('DOMContentLoaded', function() {
    let modalCurrentPage = 1;
    let modalItemsPerPage = 12;
    let modalCurrentSort = 'date_desc';
    let modalSearchTerm = '';
    
    const modalSearchInput = document.getElementById('modalSearchInput');
    const modalSortSelect = document.getElementById('modalSortSelect');
    const modalItemsPerPageSelect = document.getElementById('modalItemsPerPage');
    
    // Event listeners
    if (modalSearchInput) {
        modalSearchInput.addEventListener('input', function() {
            modalSearchTerm = this.value.toLowerCase();
            modalCurrentPage = 1;
            filterAndDisplayModalItems();
        });
    }
    
    if (modalSortSelect) {
        modalSortSelect.addEventListener('change', function() {
            modalCurrentSort = this.value;
            modalCurrentPage = 1;
            filterAndDisplayModalItems();
        });
    }
    
    if (modalItemsPerPageSelect) {
        modalItemsPerPageSelect.addEventListener('change', function() {
            modalItemsPerPage = parseInt(this.value);
            modalCurrentPage = 1;
            filterAndDisplayModalItems();
        });
    }
    
    // Filter and display items
    function filterAndDisplayModalItems() {
        const allItems = document.querySelectorAll('.download-item');
        let filteredItems = Array.from(allItems);
        
        // Filter by search term
        if (modalSearchTerm) {
            filteredItems = filteredItems.filter(item => {
                const date = item.dataset.date;
                const formattedDate = new Date(date).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                return formattedDate.toLowerCase().includes(modalSearchTerm);
            });
        }
        
        // Sort items
        filteredItems.sort((a, b) => {
            const dateA = new Date(a.dataset.date);
            const dateB = new Date(b.dataset.date);
            const countA = parseInt(a.dataset.count);
            const countB = parseInt(b.dataset.count);
            
            switch (modalCurrentSort) {
                case 'date_asc':
                    return dateA - dateB;
                case 'date_desc':
                    return dateB - dateA;
                case 'count_asc':
                    return countA - countB;
                case 'count_desc':
                    return countB - countA;
                default:
                    return dateB - dateA;
            }
        });
        
        // Hide all items first
        allItems.forEach(item => item.style.display = 'none');
        
        // Show filtered and paginated items
        const startIndex = (modalCurrentPage - 1) * modalItemsPerPage;
        const endIndex = startIndex + modalItemsPerPage;
        const paginatedItems = filteredItems.slice(startIndex, endIndex);
        
        paginatedItems.forEach(item => item.style.display = 'block');
        
        // Update pagination info
        updateModalPagination(filteredItems.length);
        
        // Show/hide no data message
        const noDataDiv = document.getElementById('modalNoData');
        if (filteredItems.length === 0) {
            noDataDiv.style.display = 'block';
        } else {
            noDataDiv.style.display = 'none';
        }
    }
    
    // Update pagination
    function updateModalPagination(totalItems) {
        const totalPages = Math.ceil(totalItems / modalItemsPerPage);
        const startItem = totalItems > 0 ? (modalCurrentPage - 1) * modalItemsPerPage + 1 : 0;
        const endItem = Math.min(modalCurrentPage * modalItemsPerPage, totalItems);
        
        // Update showing info
        document.getElementById('modalStartItem').textContent = startItem;
        document.getElementById('modalEndItem').textContent = endItem;
        document.getElementById('modalTotalItems').textContent = totalItems;
        
        // Update pagination buttons
        const paginationList = document.getElementById('modalPaginationList');
        paginationList.innerHTML = '';
        
        if (totalPages > 1) {
            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${modalCurrentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changeModalPage(${modalCurrentPage - 1})">Previous</a>`;
            paginationList.appendChild(prevLi);
            
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === modalCurrentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changeModalPage(${i})">${i}</a>`;
                paginationList.appendChild(li);
            }
            
            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${modalCurrentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changeModalPage(${modalCurrentPage + 1})">Next</a>`;
            paginationList.appendChild(nextLi);
        }
    }
    
    // Change page function
    window.changeModalPage = function(page) {
        const totalItems = document.querySelectorAll('.download-item:not([style*="display: none"])').length;
        const totalPages = Math.ceil(totalItems / modalItemsPerPage);
        
        if (page >= 1 && page <= totalPages) {
            modalCurrentPage = page;
            filterAndDisplayModalItems();
        }
    };
    
    // Add hover effects to download cards
    document.querySelectorAll('.download-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        });
    });
    
    // Initialize modal when opened
    const downloadModal = document.getElementById('downloadModal');
    if (downloadModal) {
        downloadModal.addEventListener('shown.bs.modal', function() {
            filterAndDisplayModalItems();
        });
    }
});
</script>
@endif

@endsection
                                                                        