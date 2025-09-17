@extends('layouts.header')

@section('title', 'Edit Preventive Maintenance')

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Preventive Maintenance</h3>
                    <div class="card-tools">
                        <a href="{{ url('/preventive') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('preventive.update', $jadwalPreventive->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mesin_id">Mesin <span class="text-danger">*</span></label>
                                    <select class="form-control" id="mesin_id" name="mesin_id" required>
                                        <option value="">Pilih Mesin</option>
                                        @foreach($mesins as $mesin)
                                            <option value="{{ $mesin->id }}" {{ old('mesin_id', $jadwalPreventive->mesin_id) == $mesin->id ? 'selected' : '' }}>
                                                {{ $mesin->nama_mesin }}{{ $mesin->stasiun ? ' - ' . $mesin->stasiun->nama_stasiun : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="stasiun_id">Stasiun <span class="text-danger">*</span></label>
                                    <select class="form-control" id="stasiun_id" name="stasiun_id" required>
                                        <option value="">Pilih Stasiun</option>
                                        @foreach($stasiuns as $stasiun)
                                            <option value="{{ $stasiun->id }}"
                                                {{ old('stasiun_id', $jadwalPreventive->stasiun_id) == $stasiun->id ? 'selected' : '' }}>
                                                {{ $stasiun->nama_stasiun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_preventive">Nama Preventive <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_preventive" name="nama_preventive"
                                           value="{{ old('nama_preventive', $jadwalPreventive->nama_preventive) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $jadwalPreventive->deskripsi) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="periode">Periode <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="periode" name="periode"
                                           value="{{ old('periode', $jadwalPreventive->periode) }}" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuan_periode">Satuan Periode <span class="text-danger">*</span></label>
                                    <select class="form-control" id="satuan_periode" name="satuan_periode" required>
                                        <option value="Hari" {{ old('satuan_periode', $jadwalPreventive->satuan_periode) == 'Hari' ? 'selected' : '' }}>Hari</option>
                                        <option value="Minggu" {{ old('satuan_periode', $jadwalPreventive->satuan_periode) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                        <option value="Bulan" {{ old('satuan_periode', $jadwalPreventive->satuan_periode) == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                        <option value="Tahun" {{ old('satuan_periode', $jadwalPreventive->satuan_periode) == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                           value="{{ old('tanggal_mulai', $jadwalPreventive->tanggal_mulai ? $jadwalPreventive->tanggal_mulai->format('Y-m-d') : '') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prioritas">Prioritas <span class="text-danger">*</span></label>
                                    <select class="form-control" id="prioritas" name="prioritas" required>
                                        <option value="Rendah" {{ old('prioritas', $jadwalPreventive->prioritas) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                        <option value="Sedang" {{ old('prioritas', $jadwalPreventive->prioritas) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                        <option value="Tinggi" {{ old('prioritas', $jadwalPreventive->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="Kritis" {{ old('prioritas', $jadwalPreventive->prioritas) == 'Kritis' ? 'selected' : '' }}>Kritis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option value="1" {{ old('is_active', $jadwalPreventive->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $jadwalPreventive->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', $jadwalPreventive->catatan) }}</textarea>
                        </div>

                        <!-- Preview Jadwal Berikutnya -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title">Preview Jadwal Berikutnya</h5>
                                <p class="card-text" id="preview-jadwal">
                                    @if($jadwalPreventive->jadwal_berikutnya)
                                        {{ $jadwalPreventive->jadwal_berikutnya->format('d/m/Y') }}
                                    @else
                                        Belum dihitung
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Preventive Maintenance
                            </button>
                            <a href="{{ url('/preventive') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function hitungJadwalBerikutnya() {
    const tanggalMulai = document.getElementById('tanggal_mulai').value;
    const periode = document.getElementById('periode').value;
    const satuanPeriode = document.getElementById('satuan_periode').value;

    if (tanggalMulai && periode && satuanPeriode) {
        const mulai = new Date(tanggalMulai);
        let jadwalBerikutnya = new Date(mulai);

        switch(satuanPeriode) {
            case 'Hari':
                jadwalBerikutnya.setDate(jadwalBerikutnya.getDate() + parseInt(periode));
                break;
            case 'Minggu':
                jadwalBerikutnya.setDate(jadwalBerikutnya.getDate() + (parseInt(periode) * 7));
                break;
            case 'Bulan':
                jadwalBerikutnya.setMonth(jadwalBerikutnya.getMonth() + parseInt(periode));
                break;
            case 'Tahun':
                jadwalBerikutnya.setFullYear(jadwalBerikutnya.getFullYear() + parseInt(periode));
                break;
        }

        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        document.getElementById('preview-jadwal').textContent = jadwalBerikutnya.toLocaleDateString('id-ID', options);
    } else {
        document.getElementById('preview-jadwal').textContent = 'Belum dihitung';
    }
}

// Event listeners untuk menghitung jadwal berikutnya secara real-time
document.getElementById('tanggal_mulai').addEventListener('change', hitungJadwalBerikutnya);
document.getElementById('periode').addEventListener('input', hitungJadwalBerikutnya);
document.getElementById('satuan_periode').addEventListener('change', hitungJadwalBerikutnya);

// Hitung jadwal saat halaman dimuat
document.addEventListener('DOMContentLoaded', hitungJadwalBerikutnya);
</script>
@endsection
