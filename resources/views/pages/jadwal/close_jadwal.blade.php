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
    /* Clean Modern UI */
    :root {
        --primary-color: #3b82f6;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-500: #6b7280;
        --gray-900: #111827;
    }

    body {
        background-color: var(--gray-50);
        font-family: 'Inter', system-ui, sans-serif;
    }

    .card {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .filter-section {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-section h5 {
        color: var(--gray-900);
        font-weight: 600;
        font-size: 1.125rem;
        margin-bottom: 1rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--gray-200);
        border-radius: 6px;
        padding: 0.75rem;
        background: white;
        transition: border-color 0.2s ease;
        font-size: 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: var(--gray-500);
    }

    .form-label {
        font-weight: 500;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .input-group-text {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        color: white;
        border-radius: 6px 0 0 6px;
    }

    .btn {
        border-radius: 6px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        font-size: 0.875rem;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
        border-color: #2563eb;
    }

    .btn-secondary {
        background: var(--gray-500);
        border-color: var(--gray-500);
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
        border-color: #4b5563;
    }

    .btn-success {
        background: var(--success-color);
        border-color: var(--success-color);
        color: white;
    }

    .btn-info {
        background: #06b6d4;
        border-color: #06b6d4;
        color: white;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        min-width: 70px;
    }

    .table-responsive {
        border-radius: 8px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
        background: white;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background: var(--gray-100);
        color: var(--gray-900);
        font-weight: 600;
        border-bottom: 1px solid var(--gray-200);
        padding: 1rem;
        font-size: 0.875rem;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-100);
        font-size: 0.875rem;
    }

    .table tbody tr:hover {
        background: var(--gray-50);
    }

    .no-data-message {
        color: var(--gray-500);
        padding: 2rem;
        text-align: center;
        background: var(--gray-50);
        border-radius: 8px;
        margin: 1rem;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-radius: 8px;
    }

    .spinner {
        width: 32px;
        height: 32px;
        border: 3px solid var(--gray-200);
        border-top: 3px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Scrollbar */
    .table-responsive::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--gray-500);
        border-radius: 3px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: var(--gray-900);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .filter-section {
            padding: 1rem;
        }

        .table th, .table td {
            padding: 0.75rem 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
    }

    /* Badge Styling */
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }

    /* Jadwal Card Simple */
    .jadwal-card {
        transition: box-shadow 0.2s ease;
        border: 1px solid var(--gray-200);
    }

    .jadwal-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('konten')


<div class="card">
    <div class="card-body">
        <div class="filter-section">
            <h5><i class="fas fa-search me-2"></i>Pencarian & Filter</h5>
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

<div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 pulse"><i class="fas fa-history me-2"></i>History Laporan Pekerjaan</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="badge" style="background: var(--success-gradient); color: black; font-size: 0.9rem; padding: 8px 12px; border-radius: 20px;">
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
                <div class="card jadwal-card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; background: white; border: 1px solid #e5e7eb;">
                    <!-- Card Header - Simplified -->
                    <div class="card-header border-0 bg-primary text-white" style="padding: 1.25rem; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold text-white" style="font-size: 1rem;">Laporan Breakdwon</h6>
                                <small class="text-white opacity-90" style="font-size: 0.85rem;">Status: Selesai</small>
                            </div>
                            <div class="text-end" style="margin-left: 8rem;">
                                <div class="badge bg-white text-primary fw-semibold" style="font-size: 0.75rem; padding: 8px 12px; border-radius: 8px;">
                                    <i class="fas fa-calendar me-2"></i>{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body - Simplified Layout -->
                    <div class="card-body" style="padding: 1.25rem;">
                        <!-- Main Info Section -->
                        <div class="mb-3">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-cogs text-primary" style="font-size: 1.1rem;"></i>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 1rem;">{{ $jd->maintenance->mesin->nama_mesin }}</h6>
                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">{{ $jd->maintenance->nama_maintenance }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Info - Simplified -->
                        <div class="mb-3">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="bg-light rounded p-2">
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Tanggal Breakdown</small>
                                        <div class="fw-semibold" style="font-size: 0.85rem; color: #374151;">{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('d M Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2">
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Tanggal Selesai</small>
                                        <div class="fw-semibold" style="font-size: 0.85rem; color: #374151;">{{ $jd->tanggal_realisasi ? Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('d M Y') : '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description - Simplified -->
                        @if($jd->keterangan)
                        <div class="mb-3">
                            <div class="bg-light rounded p-2">
                                <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">Keterangan:</small>
                                <p class="mb-0" style="font-size: 0.85rem; color: #374151; line-height: 1.4;">{{ Str::limit($jd->keterangan, 80) }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Foto Perbaikan - Simplified -->
                        @if($jd->foto_perbaikan)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2" style="font-size: 0.75rem;">Foto Hasil Perbaikan:</small>
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/' . $jd->foto_perbaikan) }}"
                                     alt="Foto Perbaikan"
                                     class="img-fluid rounded border"
                                     style="max-width: 120px; max-height: 90px; object-fit: cover; cursor: pointer;"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal"
                                     onclick="showImage('{{ asset('storage/' . $jd->foto_perbaikan) }}', 'Foto Perbaikan - {{ $jd->maintenance->nama_maintenance }}')">
                                <div class="position-absolute top-0 end-0 bg-primary text-white rounded-circle" style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px; margin: 4px;">
                                    <i class="fas fa-expand-alt"></i>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="d-flex justify-content-between align-items-center">
                            @php
                                $rencana = Illuminate\Support\Carbon::parse($jd->tanggal_rencana);
                                $realisasi = Illuminate\Support\Carbon::parse($jd->tanggal_realisasi);
                                $diff = $rencana->diffInDays($realisasi, false);
                            @endphp
                            <div>
                                @if($diff <= 0)
                                    <span class="badge bg-success" style="font-size: 0.75rem; padding: 6px 10px;">
                                        <i class="fas fa-check me-1"></i>Tepat Waktu
                                    </span>
                                @else
                                    <span class="badge bg-warning" style="font-size: 0.75rem; padding: 6px 10px;">
                                        <i class="fas fa-clock me-1"></i>Terlambat {{ $diff }} hari
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-primary btn-sm"
                                    onclick="modal_history({{ $jd->id }}, '{{ $jd->maintenance->mesin->nama_mesin }}', '{{ $jd->maintenance->nama_maintenance }}', '{{ Illuminate\Support\Carbon::parse($jd->tanggal_rencana)->format('d-m-Y') }}', '{{ $jd->keterangan ?? '-' }}', '{{ $jd->tanggal_realisasi ? Illuminate\Support\Carbon::parse($jd->tanggal_realisasi)->format('d-m-Y') : '-' }}', '{{ $jd->foto_perbaikan ? asset('storage/' . $jd->foto_perbaikan) : '' }}')"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal_history"
                                    style="padding: 8px 16px; font-size: 0.8rem; border-radius: 6px;">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </button>
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
                        <th class="fw-bold">Jenis Breakdown</th>
                        <td id="approve_maintenance"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Mesin</th>
                        <td id="approve_mesin"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Breakdown</th>
                        <td id="approve_tanggal_rencana"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Selesai</th>
                        <td id="approve_tanggal_realisasi"></td>
                    </tr>
                    <tr>
                        <th class="fw-bold">Keterangan</th>
                        <td id="approve_keterangan"></td>
                    </tr>
                    <tr id="foto_perbaikan_row" style="display: none;">
                        <th class="fw-bold">Foto Perbaikan</th>
                        <td id="approve_foto_perbaikan"></td>
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
            </div>
        </div>
    </div>
</div>



<!-- Modal untuk Foto Perbaikan -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Foto Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 8px;">
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

function showImage(imageSrc, imageTitle) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImage').alt = imageTitle;
    document.getElementById('imageModalLabel').textContent = imageTitle;
}

function modal_history(jadwal_id, mesin, maintenance, tgl_rencana, keterangan, tgl_realisasi, foto_perbaikan) {
    console.log('Modal history called with:', {
        jadwal_id, mesin, maintenance, tgl_rencana, keterangan, tgl_realisasi, foto_perbaikan
    });

    // Check if elements exist
    const elements = {
        approve_mesin: document.getElementById('approve_mesin'),
        approve_maintenance: document.getElementById('approve_maintenance'),
        approve_tanggal_rencana: document.getElementById('approve_tanggal_rencana'),
        approve_tanggal_realisasi: document.getElementById('approve_tanggal_realisasi'),
        approve_keterangan: document.getElementById('approve_keterangan'),
        download_jadwal_id: document.getElementById('download_jadwal_id'),
        link_detail: document.getElementById('link_detail')
    };

    // Log missing elements
    Object.keys(elements).forEach(key => {
        if (!elements[key]) {
            console.error(`Element with ID '${key}' not found`);
        }
    });

    // Set values if elements exist
    if (elements.approve_mesin) elements.approve_mesin.innerHTML = mesin || '-';
    if (elements.approve_maintenance) elements.approve_maintenance.innerHTML = maintenance || '-';
    if (elements.approve_tanggal_rencana) elements.approve_tanggal_rencana.innerHTML = tgl_rencana || '-';
    if (elements.approve_tanggal_realisasi) elements.approve_tanggal_realisasi.innerHTML = tgl_realisasi || '-';
    if (elements.approve_keterangan) elements.approve_keterangan.innerHTML = keterangan || '-';
    if (elements.download_jadwal_id) elements.download_jadwal_id.value = jadwal_id;
    if (elements.link_detail) elements.link_detail.href = '/jadwal/detail/'+jadwal_id;

    // Handle foto perbaikan
    const fotoRow = document.getElementById('foto_perbaikan_row');
    const fotoCell = document.getElementById('approve_foto_perbaikan');

    if (fotoRow && fotoCell) {
        if (foto_perbaikan && foto_perbaikan !== '') {
            fotoRow.style.display = 'table-row';
            fotoCell.innerHTML = `
                <img src="${foto_perbaikan}"
                     alt="Foto Perbaikan"
                     class="img-fluid rounded"
                     style="max-width: 200px; max-height: 150px; object-fit: cover; cursor: pointer;"
                     onclick="showImage('${foto_perbaikan}', 'Foto Perbaikan - ${maintenance}')"
                     data-bs-toggle="modal"
                     data-bs-target="#imageModal">
            `;
        } else {
            fotoRow.style.display = 'none';
            fotoCell.innerHTML = '';
        }
    } else {
        console.error('Foto perbaikan elements not found');
    }
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

        updateRecordCounter(visibleItems);

        updateNoDataMessage(visibleItems);

        updateLoadMoreButton(visibleItems);
    }

    function updateRecordCounter(visibleItems) {
        const totalRecordsElement = document.getElementById('totalRecords');
        if (totalRecordsElement) {
            totalRecordsElement.textContent = visibleItems;
        }
    }

    function updateNoDataMessage(visibleItems) {
        const listContainer = document.getElementById('historyList');

        const existingMessage = document.getElementById('noDataMessage');
        if (existingMessage) {
            existingMessage.remove();
        }

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

    function loadMoreItems() {
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';

        setTimeout(() => {
            loadMoreBtn.innerHTML = '<i class="fas fa-check me-2"></i>All data loaded';
            loadMoreBtn.disabled = true;
        }, 1000);
    }

function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.querySelector('select[name="mesin_filter"]').value = '';
    document.getElementById('sortSelect').value = 'tanggal_desc';
    document.getElementById('itemsPerPageSelect').value = '12';

    currentSort = 'tanggal_desc';
    itemsPerPage = 12;
    currentPage = 1;

    filterTable();
}

let searchTimeout;
function handleSearch() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        filterTable();
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
        mesinSelect.addEventListener('change', filterTable);
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="downloadModalLabel">
                    <i class="fas fa-download text-primary me-2"></i>Download Laporan Harian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <!-- Simple Search -->
                <div class="mb-4">
                    <input type="text" class="form-control form-control-lg" id="modalSearchInput"
                           placeholder="Cari tanggal laporan..." style="border-radius: 10px;">
                </div>

                <!-- Simple List Layout -->
                <div class="list-group list-group-flush" id="downloadList">
                    @php
                        $tanggalList = $jadwal->groupBy(function($item) {
                            return \Illuminate\Support\Carbon::parse($item->tanggal_realisasi)->format('Y-m-d');
                        })->sortKeysDesc();
                    @endphp
                    @foreach($tanggalList as $tanggal => $laporanHarian)
                    <div class="list-group-item border-0 px-0 py-3 download-item" data-date="{{ $tanggal }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-file-pdf text-danger" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ \Illuminate\Support\Carbon::parse($tanggal)->format('d M Y') }}</h6>
                                    <small class="text-muted">{{ $laporanHarian->count() }} laporan tersedia</small>
                                </div>
                            </div>
                            <a href="/laporan/harian?tanggal={{ $tanggal }}" target="_blank"
                               class="btn btn-primary btn-sm px-3" style="border-radius: 8px;">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Data Message -->
                <div id="modalNoData" class="text-center py-5" style="display: none;">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 48px;"></i>
                    <h6 class="text-muted">Tidak ada data yang ditemukan</h6>
                    <p class="text-muted mb-0">Coba kata kunci lain</p>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Simple Modal Download JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const modalSearchInput = document.getElementById('modalSearchInput');

    // Simple search functionality
    if (modalSearchInput) {
        modalSearchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const allItems = document.querySelectorAll('.download-item');
            let visibleCount = 0;

            allItems.forEach(item => {
                const date = item.dataset.date;
                const formattedDate = new Date(date).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                if (formattedDate.toLowerCase().includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide no data message
            const noDataDiv = document.getElementById('modalNoData');
            if (visibleCount === 0) {
                noDataDiv.style.display = 'block';
            } else {
                noDataDiv.style.display = 'none';
            }
        });
    }

    // Simple hover effects
    document.querySelectorAll('.download-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.transition = 'background-color 0.2s ease';
        });

        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });
});
</script>
@endif

@endsection
