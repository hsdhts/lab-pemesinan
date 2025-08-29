@extends('layouts.header')

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $halaman }}</h4>
                    <a href="{{ route('preventive.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('preventive.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mesin_id" class="form-label">Mesin <span class="text-danger">*</span></label>
                                    <select class="form-select" id="mesin_id" name="mesin_id" required>
                                        <option value="">Pilih Mesin</option>
                                        @foreach($mesins as $mesin)
                                            <option value="{{ $mesin->id }}" {{ old('mesin_id') == $mesin->id ? 'selected' : '' }}>
                                                {{ $mesin->nama_mesin }}{{ $mesin->stasiun ? ' - ' . $mesin->stasiun->nama_stasiun : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="stasiun_id" class="form-label">Stasiun <span class="text-danger">*</span></label>
                                    <select class="form-select" id="stasiun_id" name="stasiun_id" required>
                                        <option value="">Pilih Stasiun</option>
                                        @foreach($stasiuns as $stasiun)
                                            <option value="{{ $stasiun->id }}" {{ old('stasiun_id') == $stasiun->id ? 'selected' : '' }}>
                                                {{ $stasiun->nama_stasiun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_preventive" class="form-label">Nama Preventive Maintenance <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_preventive" name="nama_preventive"
                                           value="{{ old('nama_preventive') }}" required
                                           placeholder="Contoh: Penggantian Oli Rutin">
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                              placeholder="Deskripsi detail tentang preventive maintenance ini">{{ old('deskripsi') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="periode" class="form-label">Periode <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="periode" name="periode"
                                                   value="{{ old('periode') }}" required min="1"
                                                   placeholder="Contoh: 7">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="satuan_periode" class="form-label">Satuan Periode <span class="text-danger">*</span></label>
                                            <select class="form-select" id="satuan_periode" name="satuan_periode" required>
                                                <option value="hari" {{ old('satuan_periode') == 'hari' ? 'selected' : '' }}>Hari</option>
                                                <option value="minggu" {{ old('satuan_periode') == 'minggu' ? 'selected' : '' }}>Minggu</option>
                                                <option value="bulan" {{ old('satuan_periode') == 'bulan' ? 'selected' : '' }}>Bulan</option>
                                                <option value="tahun" {{ old('satuan_periode') == 'tahun' ? 'selected' : '' }}>Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                           value="{{ old('tanggal_mulai') }}" required>
                                    <div class="form-text">Tanggal mulai berlakunya preventive maintenance ini</div>
                                </div>

                                <div class="mb-3">
                                    <label for="prioritas" class="form-label">Prioritas <span class="text-danger">*</span></label>
                                    <select class="form-select" id="prioritas" name="prioritas" required>
                                        <option value="1" {{ old('prioritas') == '1' ? 'selected' : '' }}>Rendah</option>
                                        <option value="2" {{ old('prioritas') == '2' ? 'selected' : '' }}>Sedang</option>
                                        <option value="3" {{ old('prioritas') == '3' ? 'selected' : '' }}>Tinggi</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                              placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                </div>

                                <!-- Preview Jadwal Berikutnya -->
                                <div class="mb-3">
                                    <label class="form-label">Preview Jadwal Berikutnya</label>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div id="preview-jadwal">
                                                <span class="text-muted">Pilih tanggal mulai dan periode untuk melihat preview</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('preventive.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Function to calculate next schedule
function calculateNextSchedule() {
    const tanggalMulai = document.getElementById('tanggal_mulai').value;
    const periode = document.getElementById('periode').value;
    const satuanPeriode = document.getElementById('satuan_periode').value;

    if (tanggalMulai && periode && satuanPeriode) {
        const startDate = new Date(tanggalMulai);
        let nextDate = new Date(startDate);

        switch (satuanPeriode) {
            case 'hari':
                nextDate.setDate(nextDate.getDate() + parseInt(periode));
                break;
            case 'minggu':
                nextDate.setDate(nextDate.getDate() + (parseInt(periode) * 7));
                break;
            case 'bulan':
                nextDate.setMonth(nextDate.getMonth() + parseInt(periode));
                break;
            case 'tahun':
                nextDate.setFullYear(nextDate.getFullYear() + parseInt(periode));
                break;
        }

        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };

        const formattedDate = nextDate.toLocaleDateString('id-ID', options);

        document.getElementById('preview-jadwal').innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-calendar-check text-success me-2"></i>
                <div>
                    <strong>Jadwal Berikutnya:</strong><br>
                    <span class="text-primary">${formattedDate}</span>
                </div>
            </div>
        `;
    } else {
        document.getElementById('preview-jadwal').innerHTML = `
            <span class="text-muted">Pilih tanggal mulai dan periode untuk melihat preview</span>
        `;
    }
}

// Event listeners
document.getElementById('tanggal_mulai').addEventListener('change', calculateNextSchedule);
document.getElementById('periode').addEventListener('input', calculateNextSchedule);
document.getElementById('satuan_periode').addEventListener('change', calculateNextSchedule);

// Set default datetime to now
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    const defaultDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    if (!document.getElementById('tanggal_mulai').value) {
        document.getElementById('tanggal_mulai').value = defaultDateTime;
    }

    // Calculate initial preview if values exist
    calculateNextSchedule();
});
</script>
@endpush
