@extends('layouts.header')

@section('konten')
<div class="container-lg mt-5">
    <form action="{{ route('breakdown.update', $breakdown->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mesin: {{ $breakdown->mesin->nama_mesin }}</label>
        </div>

        <div class="mb-3">
            <label>Tanggal Kejadian: {{ $breakdown->tanggal_kejadian }}</label>
        </div>

        <div class="mb-3">
            <label>Deskripsi Masalah: {{ $breakdown->deskripsi_masalah }}</label>
        </div>

        @if($breakdown->foto_kerusakan)
        <div class="mb-3">
            <label>Foto Kerusakan:</label>
            <img src="{{ asset('storage/' . $breakdown->foto_kerusakan) }}" alt="Foto Kerusakan" style="max-width: 200px;">
        </div>
        @endif

        <div class="mb-3">
            <label for="tindakan_perbaikan" class="form-label">Tindakan Perbaikan</label>
            <textarea class="form-control @error('tindakan_perbaikan') is-invalid @enderror" id="tindakan_perbaikan" name="tindakan_perbaikan" rows="3">{{ old('tindakan_perbaikan', $breakdown->tindakan_perbaikan) }}</textarea>
            @error('tindakan_perbaikan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                <option value="on_going" {{ old('status', $breakdown->status) == 'on_going' ? 'selected' : '' }}>On Going</option>
                <option value="selesai" {{ old('status', $breakdown->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto_perbaikan" class="form-label">Foto Perbaikan</label>
            <input type="file" class="form-control @error('foto_perbaikan') is-invalid @enderror" id="foto_perbaikan" name="foto_perbaikan">
            @error('foto_perbaikan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="spareparts" class="form-label">Sparepart yang Digunakan</label>
            <select class="form-control" id="spareparts" name="spareparts[]" multiple>
                @foreach($spareparts as $sparepart)
                    <option value="{{ $sparepart->id }}" {{ in_array($sparepart->id, $breakdown->spareparts->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $sparepart->nama_sparepart }}</option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('breakdown.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection