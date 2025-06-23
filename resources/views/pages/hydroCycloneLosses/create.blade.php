@extends('layouts.header')

@section('konten')
<form action="/hydrocyclone-losses/create" method="post" enctype="multipart/form-data">
@csrf
<div class="container-lg mt-5">
    <div class="mb-3">
        <label for="image_HydroCycloneLosses" class="form-label">Gambar Sample</label>
        <input type="file" class="form-control @error('image_HydroCycloneLosses') is-invalid @enderror" id="image_HydroCycloneLosses" name="image_HydroCycloneLosses">
        @error('image_HydroCycloneLosses')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="shift" class="form-label">Shift</label>
        <input type="text" class="form-control @error('shift') is-invalid @enderror" id="shift" placeholder="Shift" value="{{ old('shift') }}" name="shift">
        @error('shift')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_operator" class="form-label">Nama Operator</label>
        <input type="text" class="form-control @error('nama_operator') is-invalid @enderror" id="nama_operator" placeholder="Nama Operator" value="{{ old('nama_operator') }}" name="nama_operator">
        @error('nama_operator')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="sample_weight" class="form-label">Sample Weight</label>
        <input type="text" class="form-control @error('sample_weight') is-invalid @enderror" id="sample_weight" placeholder="Sample Weight" value="{{ old('sample_weight') }}" name="sample_weight">
        @error('sample_weight')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="whole_kernel" class="form-label">Whole Kernel</label>
        <input type="text" class="form-control @error('whole_kernel') is-invalid @enderror" id="whole_kernel" placeholder="Whole Kernel" value="{{ old('whole_kernel') }}" name="whole_kernel">
        @error('whole_kernel')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="broken_kernel" class="form-label">Broken Kernel</label>
        <input type="text" class="form-control @error('broken_kernel') is-invalid @enderror" id="broken_kernel" placeholder="Broken Kernel" value="{{ old('broken_kernel') }}" name="broken_kernel">
        @error('broken_kernel')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="whole_nut" class="form-label">Whole Nut</label>
        <input type="text" class="form-control @error('whole_nut') is-invalid @enderror" id="whole_nut" placeholder="Whole Nut" value="{{ old('whole_nut') }}" name="whole_nut">
        @error('whole_nut')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="broken_nut" class="form-label">Broken Nut</label>
        <input type="text" class="form-control @error('broken_nut') is-invalid @enderror" id="broken_nut" placeholder="Broken Nut" value="{{ old('broken_nut') }}" name="broken_nut">
        @error('broken_nut')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <a href="/hydrocyclone-losses">
        <button type="button" class="btn btn-lg btn-secondary d-inline">
            <span class="svg-icon svg-icon-muted svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M14 6H9.60001V8H14C15.1 8 16 8.9 16 10V21C16 21.6 16.4 22 17 22C17.6 22 18 21.6 18 21V10C18 7.8 16.2 6 14 6Z" fill="black"/>
                    <path opacity="0.3" d="M9.60002 12L5.3 7.70001C4.9 7.30001 4.9 6.69999 5.3 6.29999L9.60002 2V12Z" fill="black"/>
                </svg>
            </span>
            <span>Kembali</span>
        </button>
    </a>

    <button type="submit" class="btn btn-lg btn-primary d-inline">
        <span class="svg-icon svg-icon-muted svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16.7 12.7C17.1 12.3 17.1 11.7 16.7 11.3C16.3 10.9 15.7 10.9 15.3 11.3L11 15.6L8.70001 13.3C8.30001 12.9 7.69999 12.9 7.29999 13.3C6.89999 13.7 6.89999 14.3 7.29999 14.7L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z" fill="black"/>
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
            </svg>
        </span>
        Simpan Data
    </button>
</div>
</form>
@endsection
