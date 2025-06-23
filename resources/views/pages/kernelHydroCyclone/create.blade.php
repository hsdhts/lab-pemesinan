@extends('layouts.header')

@section('konten')
<form action="/kernel-hydrocyclone/create" method="post" enctype="multipart/form-data">
@csrf
<div class="container-lg mt-5">

<div class="mb-3">
        <label for="image_kernelHydroCyclone" class="form-label">Gambar Kernel</label>
        <input type="file" class="form-control @error('image_kernelHydroCyclone') is-invalid @enderror" id="image_kernelHydroCyclone" name="image_kernelHydroCyclone">
        @error('image_kernelHydroCyclone')
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
        <label for="hydrocyclone" class="form-label">Hydrocyclone</label>
        <input type="text" class="form-control @error('hydrocyclone') is-invalid @enderror" id="hydrocyclone" placeholder="Hydrocyclone" value="{{ old('hydrocyclone') }}" name="hydrocyclone">
        @error('hydrocyclone')
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
        <label for="whole_nut" class="form-label">Whole Nut</label>
        <input type="text" class="form-control @error('whole_nut') is-invalid @enderror" id="whole_nut" placeholder="Whole Nut" value="{{ old('whole_nut') }}" name="whole_nut">
        @error('whole_nut')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="shell_from_whole_nut" class="form-label">Shell from Whole Nut</label>
        <input type="text" class="form-control @error('shell_from_whole_nut') is-invalid @enderror" id="shell_from_whole_nut" placeholder="Shell from Whole Nut" value="{{ old('shell_from_whole_nut') }}" name="shell_from_whole_nut">
        @error('shell_from_whole_nut')
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

    <div class="mb-3">
        <label for="shell_from_broken_nut" class="form-label">Shell from Broken Nut</label>
        <input type="text" class="form-control @error('shell_from_broken_nut') is-invalid @enderror" id="shell_from_broken_nut" placeholder="Shell from Broken Nut" value="{{ old('shell_from_broken_nut') }}" name="shell_from_broken_nut">
        @error('shell_from_broken_nut')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="loose_shell" class="form-label">Loose Shell</label>
        <input type="text" class="form-control @error('loose_shell') is-invalid @enderror" id="loose_shell" placeholder="Loose Shell" value="{{ old('loose_shell') }}" name="loose_shell">
        @error('loose_shell')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="stone" class="form-label">Stone</label>
        <input type="text" class="form-control @error('stone') is-invalid @enderror" id="stone" placeholder="Stone" value="{{ old('stone') }}" name="stone">
        @error('stone')
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

    <a href="/kernel-hydrocyclone">
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
