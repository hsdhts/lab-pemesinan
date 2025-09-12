@extends('layouts.tray_layout')


@section('customCss')

@endsection

@section('before_content')
<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <form action="/sparepart/jadwal/" method="post">
        @csrf
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sparepart</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen034.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                                    <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                    <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
            </div>

            <div class="modal-body">

                <input type="hidden" id="jadwal_id" name="jadwal_id" value="{{ $jadwal->id }}">

                <div class="mb-3">
                    <label for="id_sparepart" class="form-label">Sparepart</label>
                    <select class="form-select" id="id_sparepart" @error('sparepart_id') is-invalid @enderror name="sparepart_id">
                    <option selected> -- Silahkan Pilih -- </option>

                    @foreach ($sparepart as $s)

                    <option value="{{ $s->id }}">{{ $s->nama_sparepart }} -- {{ $s->id }}</option>

                    @endforeach
                </select>
                </div>


                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" placeholder="Jumlah" value="{{ old('jumlah', 1) }}" name="jumlah">
                    @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection

@section('content_left')
<table class="table table-row-dashed table-row-gray-400 gs-1">
    <tr>
        <td><b>Nama Mesin</b></td>
        <td>{{ $mesin->nama_mesin }}</td>
    </tr>
    <tr>
      <td><b>Kode Mesin</b></td>
      <td>{{ $mesin->kode_mesin }}</td>
    </tr>
    <tr>
      <td><b>Stasiun</b></td>
      <td>
        @if($mesin->stasiun)
          <span class="badge badge-light-primary">{{ $mesin->stasiun->nama_stasiun }}</span>
        @else
          <span class="badge badge-light-secondary">Belum Ditentukan</span>
        @endif
      </td>
    </tr>


    <tr>
      <td colspan="2">
        <b>Spesifikasi</b><br>
        {!! $mesin->spesifikasi !!}
      </td>
    </tr>
  </table>

  @if($jadwal->trashed())
  <div class="p-5 bg-warning h2 fw-bolder text-center rounded">
    Jadwal Sudah dihapus
  </div>
  @elseif($jadwal->status == 2)
  <div class="p-4 bg-warning text-white h5 fw-bolder text-center rounded">
    Konfirmasi Pekerjaan
  </div>
  @elseif($jadwal->status == 3)
  <div class="p-4 bg-success text-white h5 fw-bolder text-center rounded">
    Sudah selesai, <br> dan verifikasi oleh Superadmin
  </div>

  @endif

@canany(['admin'])
<form action="/laporan/maintenance" class="text-center" method="POST">
@csrf

<input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
<button class="btn btn-lg btn-primary" type="submit">
    <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil009.svg-->
    <span class="svg-icon svg-icon-muted svg-icon-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM13 15.4V10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10V15.4H8L11.3 18.7C11.7 19.1 12.3 19.1 12.7 18.7L16 15.4H13Z" fill="black"/>
        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
        </svg>
    </span>
    <!--end::Svg Icon-->
    LAPORAN
</button>

</form>
@endcanany

@endsection


@section('content_right')


<form action="/jadwal/update/" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="my-4">
        <h1 class="display-6">{{ $maintenance->nama_maintenance }}</h1>
        <h4 class="text-muted">Periode : {{ $maintenance->periode }} {{ $maintenance->satuan_periode }}</h4>
    </div>
        <input type="hidden" name="id" value="{{ old('id', $jadwal->id)}}">
        <input type="hidden" name="tanggal_rencana" value="{{ Illuminate\Support\Carbon::parse($jadwal->tanggal_rencana)->format('d-m-Y') }}">

<div class="input-group my-4">
    <span class="form-label float-start">Tanggal Breakdown</span>
    <div class="input-group">
        <input type="text" class="form-control" value="{{ Illuminate\Support\Carbon::parse($jadwal->tanggal_rencana)->format('d-m-Y') }}" readonly disabled>
    </div>
</div>

@if($jadwal->tanggal_realisasi)
<div class="input-group my-4">
    <span class="form-label float-start">Tanggal Selesai</span>
    <div class="input-group">
        <input type="text" class="form-control" value="{{ Illuminate\Support\Carbon::parse($jadwal->tanggal_realisasi)->format('d-m-Y H:i') }}" readonly disabled>
    </div>
</div>
@endif




<div class="mb-3">
    <label for="kt_docs_tinymce_basic" class="form-label">Keterangan</label>
    <p>Isian tidak boleh mengandung karakter petik (") maupun (')</p>
    <p class="text-danger">
        @error('keterangan')
         {{ $message }}
        @enderror
    </p>
    <textarea id="kt_docs_tinymce_basic" name="keterangan" class="tox-target" @if($jadwal->status > 2) disabled @endif>{{ old('keterangan', $jadwal->keterangan) }}</textarea>

</div>

<div class="mb-3">
    <label for="foto_perbaikan" class="form-label">Foto Hasil Perbaikan</label>
    <input type="file" class="form-control @error('foto_perbaikan') is-invalid @enderror" id="foto_perbaikan" name="foto_perbaikan" accept="image/*" @if($jadwal->status > 2) disabled @endif>
    @error('foto_perbaikan')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if($jadwal->foto_perbaikan)
    <div class="mt-2">
        <small class="text-muted">Foto saat ini:</small><br>
        <img src="{{ asset('storage/' . $jadwal->foto_perbaikan) }}" alt="Foto Perbaikan" class="img-thumbnail" style="max-width: 200px; cursor: pointer;" onclick="showImage('{{ asset('storage/' . $jadwal->foto_perbaikan) }}', 'Foto Hasil Perbaikan - {{ $maintenance->nama_maintenance }}')">
    </div>
    @endif
</div>














<div class="container-fluid text-end">

    <a href="/mesin">
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


@if(!$jadwal->trashed() && (Gate::allows('superadmin', 'admin') || Gate::allows('admin')))

<button type="submit" class="btn btn-lg btn-primary d-inline" @if($jadwal->status > 2 && !$jadwal->trashed()) disabled @endif>
    <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil008.svg-->
    <span class="svg-icon svg-icon-muted svg-icon-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16.7 12.7C17.1 12.3 17.1 11.7 16.7 11.3C16.3 10.9 15.7 10.9 15.3 11.3L11 15.6L8.70001 13.3C8.30001 12.9 7.69999 12.9 7.29999 13.3C6.89999 13.7 6.89999 14.3 7.29999 14.7L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z" fill="black"/>
            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
    </svg></span>
    <!--end::Svg Icon-->
    Simpan Perubahan
</button>

@endif

</div>

</form>

<table class="table gs-5 my-9">

    <tr class="table-primary">
        <td class="fw-bold fs-1">Pemakaian Sparepart</td>

        <td class="text-end">
            @if($jadwal->status < 3 && !$jadwal->trashed() && (Gate::allows('superadmin') || Gate::allows('admin')))
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="white"/>
                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="white"/>
                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="white"/>
                </svg>
            </button>
            @endif

        </td>
    </tr>

    <tr>
        <td colspan="2">

            @if($jadwal->sparepart->isNotEmpty())
            <table class="table align-middle fs-5 table-row-dashed table-row-gray-400 gs-7 g-3">

                <tr class="fw-bolder text-gray-800">
                    <td>Item Number</td>
                    <td>Nama Sparepart</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Satuan</td>
                    <td>Aksi</td>
                </tr>

            @foreach ($jadwal->sparepart as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama_sparepart }}</td>
                    <td>{{ $s->harga }}</td>
                    <td>{{ $s->pivot->jumlah }}</td>
                    <td>{{ $s->satuan }}</td>
                    <td>
                        @if($jadwal->status < 3)
                        <form action="/sparepart/jadwal/delete" method="post" onSubmit="return hapusSetup(this);" style ="display:inline-block;">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                        <input type="hidden" name="sparepart_id" value="{{ $s->id }}">
                        <button class="btn btn-sm py-1 btn-danger text-nowrap" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path fill="white" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path fill="white" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </button>
                    </form>
                    @endif
                </td>
                </tr>


                @endforeach



            </table>
            @else
                <b>Tidak ada pemakaian sparepart</b>
            @endif


        </td>
    </tr>


    </table>


@endsection



@section('customJs')
<script src="/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>

    <script>

var options = {
    selector: "#kt_docs_tinymce_basic",
    forced_root_block: false,
    newline_behavior: 'block',
    toolbar: false,
    menubar: false,
};

tinymce.init(options);

// Handle form submission with AJAX to prevent page refresh
$(document).ready(function() {
    $('form[action="/jadwal/update/"]').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.html();

        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

        // Get TinyMCE content
        const keteranganContent = tinymce.get('kt_docs_tinymce_basic').getContent();

        // Create FormData object
        const formData = new FormData(this);
        formData.set('keterangan', keteranganContent);

        // Add status update to mark as verified by superadmin
        formData.append('status', '3');
        formData.append('auto_verify', '1');

        // Send AJAX request
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Show success message
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan dan telah diverifikasi oleh superadmin.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // Optionally reload the page or redirect
                    window.location.reload();
                });
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan saat menyimpan data.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors).flat().join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            },
            complete: function() {
                // Restore button state
                submitBtn.prop('disabled', false);
                submitBtn.html(originalText);
            }
        });
    });
});

@error('sparepart')
Swal.fire({
		title: 'Sparepart sudah pernah ditambahkan, tidak perlu ditambahkan lagi!',
		confirmButtonText: 'OK',
		confirmButtonColor : '#F14182',
		icon: 'error',
	});
@enderror
    </script>
@endsection
