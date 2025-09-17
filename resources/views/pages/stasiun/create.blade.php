@extends('layouts.header')


@section('konten')

<form action="{{ route('stasiun.store') }}" method="post">

@csrf
<div class="container-lg mt-5">


<div class="mb-3">
    <label for="nama_stasiun" class="form-label">Nama Stasiun</label>
    <input type="text" class="form-control @error('nama_stasiun') is-invalid @enderror" id="nama_stasiun" placeholder="Nama Stasiun" value="{{ old('nama_stasiun') }}" name="nama_stasiun">
    @error('nama_stasiun')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="kode_stasiun" class="form-label">Kode Stasiun</label>
    <input type="text" class="form-control @error('kode_stasiun') is-invalid @enderror" id="kode_stasiun" placeholder="Kode Stasiun" value="{{ old('kode_stasiun') }}" name="kode_stasiun">
    @error('kode_stasiun')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi') }}" name="deskripsi">
    @error('deskripsi')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>




        <a href="/stasiun">
            <button type="button" class="btn btn-lg btn-secondary d-inline">

                <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr046.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M14 6H9.60001V8H14C15.1 8 16 8.9 16 10V21C16 21.6 16.4 22 17 22C17.6 22 18 21.6 18 21V10C18 7.8 16.2 6 14 6Z" fill="black"/>
                        <path opacity="0.3" d="M9.60002 12L5.3 7.70001C4.9 7.30001 4.9 6.69999 5.3 6.29999L9.60002 2V12Z" fill="black"/>
                    </svg>
                </span>
                <span>Kembali</span>
                <!--end::Svg Icon-->
            </button>

            </a>

    <button type="submit" class="btn btn-lg btn-primary d-inline">
    <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil008.svg-->
    <span class="svg-icon svg-icon-muted svg-icon-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16.7 12.7C17.1 12.3 17.1 11.7 16.7 11.3C16.3 10.9 15.7 10.9 15.3 11.3L11 15.6L8.70001 13.3C8.30001 12.9 7.69999 12.9 7.29999 13.3C6.89999 13.7 6.89999 14.3 7.29999 14.7L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z" fill="black"/>
    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
    </svg></span>
    <!--end::Svg Icon-->
    Simpan Perubahan
    </button>
</form>

</div>



@endsection
