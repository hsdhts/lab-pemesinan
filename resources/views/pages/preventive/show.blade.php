@extends('layouts.header')

@section('title', 'Detail Preventive Maintenance')

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Preventive Maintenance</h3>
                    <div class="card-tools">
                        <a href="{{ url('/preventive') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ url('/preventive/' . $jadwalPreventive->id . '/edit') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Nama Preventive:</strong></td>
                                    <td>{{ $jadwalPreventive->nama_preventive }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mesin:</strong></td>
                                    <td>{{ $jadwalPreventive->mesin->nama_mesin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Stasiun:</strong></td>
                                    <td>{{ $jadwalPreventive->stasiun->nama_stasiun ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Deskripsi:</strong></td>
                                    <td>{{ $jadwalPreventive->deskripsi ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Periode:</strong></td>
                                    <td>{{ $jadwalPreventive->periode }} {{ $jadwalPreventive->satuan_periode }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Mulai:</strong></td>
                                    <td>{{ $jadwalPreventive->tanggal_mulai ? $jadwalPreventive->tanggal_mulai->format('d/m/Y') : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Jadwal Berikutnya:</strong></td>
                                    <td>
                                        @if($jadwalPreventive->jadwal_berikutnya)
                                            <span class="badge badge-{{ $jadwalPreventive->jadwal_berikutnya->isPast() ? 'danger' : 'success' }}">
                                                {{ $jadwalPreventive->jadwal_berikutnya->format('d/m/Y') }}
                                            </span>
                                            @if($jadwalPreventive->jadwal_berikutnya->isPast())
                                                <small class="text-danger d-block">Sudah jatuh tempo</small>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">Belum dihitung</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Dilakukan:</strong></td>
                                    <td>{{ $jadwalPreventive->jadwal_terakhir_dilakukan ? $jadwalPreventive->jadwal_terakhir_dilakukan->format('d/m/Y') : 'Belum pernah' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Prioritas:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $jadwalPreventive->prioritas_color }}">
                                            {{ $jadwalPreventive->prioritas_text }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $jadwalPreventive->is_active ? 'success' : 'secondary' }}">
                                            {{ $jadwalPreventive->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Catatan:</strong></td>
                                    <td>{{ $jadwalPreventive->catatan ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $jadwalPreventive->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($jadwalPreventive->jadwal_berikutnya && $jadwalPreventive->jadwal_berikutnya->isPast())
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Perhatian!</strong> Jadwal preventive maintenance ini sudah jatuh tempo. 
                            Silakan generate jadwal maintenance untuk melakukan tindakan preventive.
                        </div>
                    @endif

                    <!-- Riwayat Jadwal yang Dibuat -->
                    @if($riwayatJadwal && $riwayatJadwal->count() > 0)
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Riwayat Jadwal Maintenance</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Rencana</th>
                                                <th>Status</th>
                                                <th>Tanggal Realisasi</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($riwayatJadwal as $jadwal)
                                                <tr>
                                                    <td>{{ $jadwal->tanggal_rencana ? $jadwal->tanggal_rencana->format('d/m/Y') : '-' }}</td>
                                                    <td>
                                                        @if($jadwal->status == 1)
                                                            <span class="badge badge-secondary">Belum Dikerjakan</span>
                                                        @elseif($jadwal->status == 2)
                                                            <span class="badge badge-warning">Dalam Pekerjaan</span>
                                                        @elseif($jadwal->status == 3)
                                                            <span class="badge badge-success">Selesai</span>
                                                        @else
                                                            <span class="badge badge-danger">Status Tidak Dikenal</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $jadwal->tanggal_realisasi ? $jadwal->tanggal_realisasi->format('d/m/Y') : '-' }}</td>
                                                    <td>{{ $jadwal->keterangan ?: '-' }}</td>
                                                    <td>
                                                        <a href="{{ url('/jadwal/detail/' . $jadwal->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection