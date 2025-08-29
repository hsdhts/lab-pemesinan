@extends('layouts.header')

@push('styles')
<style>
/* Responsive Design for Preventive Maintenance */
.preventive-container {
    padding: 0.5rem;
}

/* Header responsive */
.card-header {
    flex-direction: column;
    gap: 1rem;
}

@media (min-width: 768px) {
    .card-header {
        flex-direction: row;
    }
    .preventive-container {
        padding: 1rem;
    }
}

/* Button group responsive */
.header-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    width: 100%;
}

@media (min-width: 576px) {
    .header-buttons {
        flex-direction: row;
        width: auto;
    }
}

/* Table responsive improvements */
.table-responsive {
    border-radius: 0.375rem;
    box-shadow: 0 0 0 1px rgba(0,0,0,.125);
}

.table {
    margin-bottom: 0;
    font-size: 0.875rem;
}

@media (max-width: 767px) {
    .table {
        font-size: 0.75rem;
    }
    
    .table th,
    .table td {
        padding: 0.5rem 0.25rem;
        vertical-align: top;
    }
    
    /* Table improvements */
        .table td {
            vertical-align: middle;
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            position: sticky;
            top: 0;
            background-color: var(--bs-dark);
            z-index: 10;
        }
        
        /* Horizontal scroll improvements for tablet */
        @media (min-width: 768px) and (max-width: 1199.98px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: #6c757d #f8f9fa;
            }
            
            .table-responsive::-webkit-scrollbar {
                height: 8px;
            }
            
            .table-responsive::-webkit-scrollbar-track {
                background: #f8f9fa;
                border-radius: 4px;
            }
            
            .table-responsive::-webkit-scrollbar-thumb {
                background: #6c757d;
                border-radius: 4px;
            }
            
            .table-responsive::-webkit-scrollbar-thumb:hover {
                background: #495057;
            }
            
            .table {
                min-width: 800px;
            }
            
            .table th:first-child,
            .table td:first-child {
                position: sticky;
                left: 0;
                background-color: inherit;
                z-index: 5;
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            }
            
            .table th:first-child {
                z-index: 15;
            }
        }
    
    /* Hide less important columns on mobile */
    .table .d-none-mobile {
        display: none;
    }
    
    /* Mobile Card Styling */
        .preventive-card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e9ecef;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        
        .preventive-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        
        .preventive-card:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .preventive-card.border-warning {
            border-left: 4px solid #ffc107 !important;
            background: linear-gradient(135deg, #fff8e1 0%, #ffffff 100%);
            animation: pulse-warning 2s infinite;
        }
        
        @keyframes pulse-warning {
            0%, 100% { box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2); }
            50% { box-shadow: 0 4px 16px rgba(255, 193, 7, 0.4); }
        }
        
        .preventive-card .badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .preventive-card .badge:hover {
            transform: scale(1.05);
        }
        
        .preventive-card .card-title {
            font-size: 1.1rem;
            line-height: 1.3;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .preventive-card .row {
            margin-bottom: 0.75rem;
        }
        
        .preventive-card .row:last-child {
            margin-bottom: 0;
        }
        
        .preventive-card .card-body {
            padding: 1.25rem;
        }
        
        /* Touch-friendly button improvements */
        .preventive-card .btn {
            min-height: 44px;
            min-width: 44px;
            touch-action: manipulation;
        }
        
        /* Loading state for cards */
        .preventive-card.loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        .preventive-card.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    
    /* Dropdown responsif */
    .dropdown-menu {
        min-width: auto;
    }
    
    .dropdown-item {
        padding: 0.5rem 0.75rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
}

/* Action buttons responsive */
.btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
}

/* Responsive improvements */
@media (max-width: 767.98px) {
    .preventive-container {
        padding: 0.5rem;
    }
    
    .card {
        margin-bottom: 1rem;
    }
    
    .header-buttons {
        gap: 0.5rem;
    }
    
    .header-buttons .btn {
        padding: 0.375rem 0.75rem;
    }
}

@media (max-width: 575.98px) {
    .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-group .btn {
        width: 100%;
        justify-content: center;
    }
    
    .preventive-card {
        margin-bottom: 1rem;
    }
    
    .preventive-card .card-body {
        padding: 1rem;
    }
    
    .preventive-card .badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
    
    .preventive-card .card-title {
        font-size: 0.9rem;
    }
}

/* Badge responsive */
.badge {
    font-size: 0.75em;
    white-space: nowrap;
}

@media (max-width: 576px) {
    .badge {
        font-size: 0.65em;
        padding: 0.25em 0.5em;
    }
}

/* Alert responsive */
.alert {
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

/* Modal responsive */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .modal-content {
        border-radius: 0.5rem;
    }
}

/* Pagination responsive */
.pagination {
    flex-wrap: wrap;
    justify-content: center;
}

@media (max-width: 576px) {
    .pagination .page-item .page-link {
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
    }
}

/* Empty state responsive */
.empty-state {
    padding: 2rem 1rem;
}

@media (min-width: 768px) {
    .empty-state {
        padding: 3rem 2rem;
    }
}

/* Loading state for buttons */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Hover effects for interactive elements */
@media (hover: hover) {
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.075);
    }
    
    .btn:hover:not(:disabled) {
        transform: translateY(-1px);
        transition: transform 0.2s ease;
    }
}

/* Focus states for accessibility */
.btn:focus,
.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Print styles */
@media print {
    .btn, .pagination, .modal {
        display: none !important;
    }
    
    .table {
        font-size: 0.75rem;
    }
    
    .card {
        border: none;
        box-shadow: none;
    }
}
</style>
@endpush

@section('konten')
<div class="container-fluid preventive-container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $halaman }}</h4>
                    <div class="header-buttons">
                        <button class="btn btn-success" onclick="generateJadwal()">
                            <i class="fas fa-sync-alt"></i> <span class="d-none d-sm-inline">Generate Jadwal</span>
                        </button>
                        <a href="{{ route('preventive.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah Preventive</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Desktop Table View (hidden on mobile) -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Preventive</th>
                                    <th class="d-none d-lg-table-cell">Mesin</th>
                                    <th class="d-none d-lg-table-cell">Stasiun</th>
                                    <th>Periode</th>
                                    <th>Jadwal Berikutnya</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalPreventive as $index => $jadwal)
                                    <tr class="{{ $jadwal->jadwal_berikutnya <= now() ? 'table-warning' : '' }}">
                                        <td>{{ $jadwalPreventive->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $jadwal->nama_preventive }}</strong>
                                            @if($jadwal->deskripsi)
                                                <br><small class="text-muted">{{ Str::limit($jadwal->deskripsi, 50) }}</small>
                                            @endif
                                        </td>
                                        <td class="d-none d-lg-table-cell">
                                            <span class="badge bg-info">{{ $jadwal->mesin->nama_mesin}}</span>
                                        </td>
                                        <td class="d-none d-lg-table-cell">
                                            <span class="badge bg-primary">{{ $jadwal->stasiun->nama_stasiun }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $jadwal->periode }} {{ $jadwal->satuan_periode }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{ $jadwal->jadwal_berikutnya <= now() ? 'text-danger fw-bold' : 'text-muted' }}">
                                                {{ $jadwal->jadwal_berikutnya->format('d M Y H:i') }}
                                            </span>
                                            @if($jadwal->jadwal_berikutnya <= now())
                                                <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Jatuh Tempo</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $jadwal->prioritas_color }}">
                                                {{ $jadwal->prioritas_text }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $jadwal->is_active ? 'success' : 'secondary' }}">
                                                {{ $jadwal->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            @include('partials.tombolAksiPreventive')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <p>Belum ada jadwal preventive maintenance</p>
                                                <a href="{{ route('preventive.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Preventive Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View (visible only on mobile) -->
                    <div class="d-md-none">
                        @forelse($jadwalPreventive as $index => $jadwal)
                            <div class="card mb-3 preventive-card {{ $jadwal->jadwal_berikutnya <= now() ? 'border-warning' : '' }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0 flex-grow-1">
                                            <strong>{{ $jadwal->nama_preventive }}</strong>
                                        </h6>
                                        <div class="ms-2">
                                            @include('partials.tombolAksiPreventive')
                                        </div>
                                    </div>
                                    
                                    @if($jadwal->deskripsi)
                                        <p class="card-text text-muted small mb-2">{{ Str::limit($jadwal->deskripsi, 80) }}</p>
                                    @endif
                                    
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Mesin:</small>
                                            <span class="badge bg-info">{{ $jadwal->mesin->nama_mesin}}</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Stasiun:</small>
                                            <span class="badge bg-primary">{{ $jadwal->stasiun->nama_stasiun }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Periode:</small>
                                            <span class="badge bg-secondary">{{ $jadwal->periode }} {{ $jadwal->satuan_periode }}</span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Prioritas:</small>
                                            <span class="badge bg-{{ $jadwal->prioritas_color }}">{{ $jadwal->prioritas_text }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Status:</small>
                                            <span class="badge bg-{{ $jadwal->is_active ? 'success' : 'secondary' }}">
                                                {{ $jadwal->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted d-block">Jadwal Berikutnya:</small>
                                            <div class="{{ $jadwal->jadwal_berikutnya <= now() ? 'text-danger fw-bold' : 'text-dark' }}">
                                                <small>{{ $jadwal->jadwal_berikutnya->format('d/m/Y H:i') }}</small>
                                                @if($jadwal->jadwal_berikutnya <= now())
                                                    <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Jatuh Tempo</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                    <p>Belum ada jadwal preventive maintenance</p>
                                    <a href="{{ route('preventive.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Preventive Pertama
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($jadwalPreventive->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $jadwalPreventive->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus jadwal preventive maintenance ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = `/preventive/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function generateJadwal() {
    // Show loading state
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
    btn.disabled = true;

    fetch('/preventive/generate-jadwal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat generate jadwal'
        });
    })
    .finally(() => {
        // Restore button state
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}
</script>
@endpush
