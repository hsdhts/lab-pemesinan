@extends('layouts.tray_layout')

@section('before_content')

@if($errors->any())
    <!--begin::Alert-->

    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mx-3">
        <!--begin::Icon-->
        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen044.svg-->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
    </svg>
    <!--end::Svg Icon-->
    </span>
    <!--end::Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
        <!--begin::Title-->
        <h4 class="mb-2 text-light">Error</h4>
        <!--end::Title-->

        <!--begin::Content-->
        <span>Terjadi kesalahan, mohon cek kembali isian form. Beberapa form tidak boleh dikosongi</span>
        <br>
        <span>Mohon dicek barangkali nilai yang anda masukkan sudah ada di dalam tabel</span>
        <br>
        <span>Pesan Error: </span>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->

    <!--begin::Close-->
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <span class="svg-icon svg-icon-2x svg-icon-light">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen034.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
        <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
        </svg>
    <!--end::Svg Icon-->
        </span>
    </button>
    <!--end::Close-->
</div>
<!--end::Alert-->
@endif

@if(session('success'))
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row p-5 mb-10 mx-3">
        <!--begin::Icon-->
        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48613 15.8404 4.4407 16.8379C5.39527 17.8354 6.83118 18.6841 8.7407 19.2845C10.6502 19.8849 12.6503 19.8849 14.5598 19.2845C16.4693 18.6841 17.9052 17.8354 18.8598 16.8379C19.8143 15.8404 20.3005 14.6914 20.3005 13.569V4.93945C20.3005 4.6807 20.1193 4.45258 19.8548 4.37824L20.5543 4.37824Z" fill="black"/>
                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"/>
            </svg>
        </span>
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="mb-2 text-light">Berhasil</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>{{ session('success') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                    <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                    <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                </svg>
            </span>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
@endif

@if(session('error'))
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mx-3">
        <!--begin::Icon-->
        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
            </svg>
        </span>
        <!--end::Icon-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="mb-2 text-light">Error</h4>
            <!--end::Title-->
            <!--begin::Content-->
            <span>{{ session('error') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                    <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                    <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                </svg>
            </span>
        </button>
        <!--end::Close-->
    </div>
    <!--end::Alert-->
@endif

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

    </table>

    @canany(['superadmin', 'admin'])
            <button class="btn btn-primary mb-3 container-fluid" data-bs-toggle="modal" data-bs-target="#kt_modal_1" type="button">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen035.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"/>
                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"/>
                    </svg>
                </span>
        <!--end::Svg Icon-->
                <span>Tambah Breakdown</span>
            </button>
<!--
          <form action="/maintenance/submit/" method="post">
            @method('put')
            @csrf
            <button class="btn btn-warning mb-3 text-dark container-fluid" type="submit">
            <span class="svg-icon-dark svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"/>
                </svg>
            </span>

            <span>Simpan Perubahan</span>
            </button>
        </form>
    -->




        @endcanany


        <a href="/mesin" class="btn btn-dark container-fluid mt-3">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr046.svg-->
            <span class="svg-icon svg-icon-muted svg-icon-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M14 6H9.60001V8H14C15.1 8 16 8.9 16 10V21C16 21.6 16.4 22 17 22C17.6 22 18 21.6 18 21V10C18 7.8 16.2 6 14 6Z" fill="black"/>
                    <path opacity="0.3" d="M9.60002 12L5.3 7.70001C4.9 7.30001 4.9 6.69999 5.3 6.29999L9.60002 2V12Z" fill="black"/>
                </svg>
            </span>
    <!--end::Svg Icon-->

            <span>Kembali</span>
        </a>

@endsection




@section('content_right')

@if($maintenance && $maintenance->count() > 0)
<table class="table gs-7 align-middle">


    @foreach ($maintenance as $m)

    <tr class="table-primary">
        <td class="fw-bold fs-6">
            {{-- DEBUG: Tampilkan nama maintenance --}}
            @if(empty($m->nama_maintenance))
                <span class="text-danger">[KOSONG - ID: {{ $m->id }}]</span>
            @else
                {{ $m->nama_maintenance }}
            @endif
        </td>

        <td class="text-end">
            @canany(['superadmin', 'admin'])

            <form action="/mesin/maintenance/delete/" method="post" onSubmit="return hapusSetup(this);" style ="display:inline-block;">
                @method('delete')
                @csrf
                <input type="hidden" name="maintenance_id" value="{{ $m->id }}">
                <input type="hidden" name="mesin_id" value="{{ $mesin->id }}">
                <button class="btn btn-sm btn-danger text-nowrap" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path fill="white" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path fill="white" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>
            </form>

            <button type="button" class="btn btn-sm btn-dark text-nowrap d-inline" data-bs-toggle="modal" data-bs-target="#kt_modal_edit" onclick="setEdit({{ json_encode($m->id) }}, {{ json_encode($m->nama_maintenance) }}, {{ json_encode($m->warna) }}, {{ $m->foto_kerusakan ? json_encode(asset('storage/' . $m->foto_kerusakan)) : 'null' }})">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen055.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="white"/>
                        <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="white"/>
                        <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="white"/>
                    </svg>
            <!--end::Svg Icon-->
            </button>

            @endcanany

        </td>
    </tr>

    <tr>
        <td>
            <table class="table g-1">
                @if($m->foto_kerusakan)
                <tr>
                    <td colspan="3">
                        <b>Foto Kerusakan:</b><br>
                        @php
                            $fotoArray = is_string($m->foto_kerusakan) ? json_decode($m->foto_kerusakan, true) : $m->foto_kerusakan;
                            if (!is_array($fotoArray)) {
                                $fotoArray = [$m->foto_kerusakan];
                            }
                        @endphp
                        <div class="row mt-2">
                            @foreach($fotoArray as $index => $foto)
                                @if($foto)
                                <div class="col-md-3 col-sm-4 col-6 mb-2">
                                    <img src="{{ asset('storage/' . $foto) }}" alt="Foto Kerusakan {{ $index + 1 }}" class="img-fluid" style="width: 100%; height: 120px; object-fit: cover; border-radius: 5px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage({{ json_encode(asset('storage/' . $foto)) }}, {{ json_encode($m->nama_maintenance . ' - Foto ' . ($index + 1)) }})">
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endif

                <tr>
                    <td>
                        <b>Warna</b>
                    </td>
                    <td>
                        <b>:</b>
                    </td>
                    <td>
                        <span style="color: {{ $m->warna }};"><b>{{ $m->warna }}</b></span>
                    </td>
                </tr>

            </table>
        </td>
        <td></td>
    </tr>

    @endforeach

</table>
@else

<h2 class="text-center my-7">*Masih Kosong*</h2>

@endif

@endsection


<!-- Modal untuk Tambah Breakdown -->
<div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Breakdown</h5>

                <!--begin::Close-->
                <div onclick="clearValue()" class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
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

            <form action="/mesin/maintenance/create/" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mesin_id" value="{{ $mesin->id }}">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="maintenance_form" class="form-label float-start">Nama Breakdown</label>
                        <input type="text" class="form-control @error('nama_maintenance') is-invalid @enderror clear-form" id="maintenance_form" value="{{ old('nama_maintenance') }}" name="nama_maintenance" onkeyup="updateCreatePreview()">
                    </div>

                    <div class="mb-3">
                        <label for="foto_kerusakan" class="form-label float-start">Foto Kerusakan</label>
                        <input type="file" class="form-control @error('foto_kerusakan') is-invalid @enderror clear-form" id="foto_kerusakan" name="foto_kerusakan[]" accept="image/*" multiple onchange="previewCreateMultipleImages(this)">
                        <div class="form-text">Upload foto kerusakan - Bisa pilih beberapa foto sekaligus</div>
                        <!-- Preview multiple images -->
                        <div id="create_image_preview_container" class="mt-2" style="display: none;">
                            <div class="row" id="create_image_previews"></div>
                        </div>
                    </div>

                    <div class="my-5">
                        <div class="p-2 fw-bold">Warna</div>
                        <div class="p-2 d-inline"><input type="color" name="warna" id="create_warna" value="{{ old('warna','#0095E8') }}" onchange="updateCreatePreview()">
                        </div>
                        <!-- Preview warna -->
                        <div class="p-2">
                            <span id="create_color_preview" style="color: #0095E8; font-weight: bold;">Preview Warna</span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" onclick="clearValue()" class="btn btn-secondary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen034.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-3 text-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <span class="text-nowrap">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary text-nowrap" id="simpan">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil025.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"/>
                                <path d="M10.3629 14.0084L8.92108 12.6429C8.57518 12.3153 8.03352 12.3153 7.68761 12.6429C7.31405 12.9967 7.31405 13.5915 7.68761 13.9453L10.2254 16.3488C10.6111 16.714 11.215 16.714 11.6007 16.3488L16.3124 11.8865C16.6859 11.5327 16.6859 10.9379 16.3124 10.5841C15.9665 10.2565 15.4248 10.2565 15.0789 10.5841L11.4631 14.0084C11.1546 14.3006 10.6715 14.3006 10.3629 14.0084Z" fill="black"/>
                                <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal untuk Edit Breakdown -->
<div class="modal fade" tabindex="-1" id="kt_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Breakdown</h5>

                <!--begin::Close-->
                <div onclick="clearEditValue()" class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
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

            <form action="/mesin/maintenance/edit/direct" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mesin_id" value="{{ $mesin->id }}">
            <input type="hidden" name="maintenance_id" id="edit_index" value="">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="edit_maintenance_form" class="form-label float-start">Nama Breakdown</label>
                        <input type="text" class="form-control @error('nama_maintenance') is-invalid @enderror clear-edit-form" id="edit_maintenance_form" name="nama_maintenance" required onkeyup="updatePreview()">
                    </div>

                    <div class="mb-3">
                        <label for="edit_foto_kerusakan" class="form-label float-start">Foto Kerusakan</label>
                        <input type="file" class="form-control @error('foto_kerusakan') is-invalid @enderror clear-edit-form" id="edit_foto_kerusakan" name="foto_kerusakan[]" accept="image/*" multiple onchange="previewEditMultipleImages(this)">
                        <div class="form-text">Upload foto kerusakan baru (opsional) - Bisa pilih beberapa foto sekaligus</div>
                        <!-- Preview existing images -->
                        <div id="existing_images_container" class="mt-2" style="display: none;">
                            <label class="form-label">Foto yang sudah ada:</label>
                            <div class="row" id="existing_images"></div>
                        </div>
                        <!-- Preview new images -->
                        <div id="edit_image_preview_container" class="mt-2" style="display: none;">
                            <label class="form-label">Preview foto baru:</label>
                            <div class="row" id="edit_image_previews"></div>
                        </div>
                    </div>

                    <div class="my-5">
                        <div class="p-2 fw-bold">Warna</div>
                        <div class="p-2 d-inline"><input type="color" name="warna" id="edit_warna" value="#0095E8" onchange="updatePreview()">
                        </div>
                        <!-- Preview warna -->
                        <div class="p-2">
                            <span id="color_preview" style="color: #0095E8; font-weight: bold;">Preview Warna</span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" onclick="clearEditValue()" class="btn btn-secondary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen034.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-3 text-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <span class="text-nowrap">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary text-nowrap" id="update">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil025.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"/>
                                <path d="M10.3629 14.0084L8.92108 12.6429C8.57518 12.3153 8.03352 12.3153 7.68761 12.6429C7.31405 12.9967 7.31405 13.5915 7.68761 13.9453L10.2254 16.3488C10.6111 16.714 11.215 16.714 11.6007 16.3488L16.3124 11.8865C16.6859 11.5327 16.6859 10.9379 16.3124 10.5841C15.9665 10.2565 15.4248 10.2565 15.0789 10.5841L11.4631 14.0084C11.1546 14.3006 10.6715 14.3006 10.3629 14.0084Z" fill="black"/>
                                <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        Update Breakdown
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal untuk Melihat Foto Kerusakan -->
<div class="modal fade" tabindex="-1" id="imageModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Foto Kerusakan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-muted svg-icon-2hx">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Foto Kerusakan" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

@section('customJs')
    <script>

let createSelectedFiles = [];
let editSelectedFiles = [];

function setEdit(index, nama_maintenance, warna, foto_kerusakan = null){
    document.getElementById('edit_index').value = index;
    document.getElementById('edit_maintenance_form').value = nama_maintenance;
    document.getElementById('edit_warna').value = warna;

    // Tampilkan foto yang sudah ada jika tersedia
    const existingContainer = document.getElementById('existing_images_container');
    const existingImages = document.getElementById('existing_images');

    // Clear existing images
    existingImages.innerHTML = '';

    if (foto_kerusakan) {
        // Handle multiple images or single image
        let fotoArray;
        try {
            fotoArray = JSON.parse(foto_kerusakan);
            if (!Array.isArray(fotoArray)) {
                fotoArray = [foto_kerusakan];
            }
        } catch (e) {
            fotoArray = [foto_kerusakan];
        }

        fotoArray.forEach((foto, index) => {
            if (foto) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6 mb-2';
                colDiv.innerHTML = `
                    <div class="position-relative">
                        <img src="${foto}" alt="Existing ${index + 1}" class="img-fluid" style="width: 100%; height: 120px; object-fit: cover; border-radius: 5px; cursor: pointer;" onclick="showImage('${foto}', 'Foto ${index + 1}')">
                        <div class="text-center mt-1">
                            <small class="text-muted">Foto ${index + 1}</small>
                        </div>
                    </div>
                `;
                existingImages.appendChild(colDiv);
            }
        });

        existingContainer.style.display = 'block';
    } else {
        existingContainer.style.display = 'none';
    }

    // Clear new image previews
    document.getElementById('edit_image_preview_container').style.display = 'none';
    document.getElementById('edit_image_previews').innerHTML = '';
    
    // Reset selected files array for edit
    editSelectedFiles = [];

    updatePreview(); // Update preview saat modal dibuka
    }

function clearValue(){
    x = document.getElementsByClassName('clear-form');
    x.forEach(element => {
        element.value = ""
    });
    // Reset preview untuk create modal
    document.getElementById('create_image_preview_container').style.display = 'none';
    document.getElementById('create_image_previews').innerHTML = '';
    document.getElementById('create_warna').value = '#0095E8';
    document.getElementById('create_color_preview').style.color = '#0095E8';
    document.getElementById('create_color_preview').textContent = 'Preview Warna';
    // Reset selected files array
    createSelectedFiles = [];
}

function clearEditValue(){
    x = document.getElementsByClassName('clear-edit-form');
    x.forEach(element => {
        element.value = ""
    });
    document.getElementById('edit_index').value = "";
    document.getElementById('edit_warna').value = "#0095E8";
    // Reset preview
    document.getElementById('existing_images_container').style.display = 'none';
    document.getElementById('existing_images').innerHTML = '';
    document.getElementById('edit_image_preview_container').style.display = 'none';
    document.getElementById('edit_image_previews').innerHTML = '';
    document.getElementById('color_preview').style.color = '#0095E8';
    document.getElementById('color_preview').textContent = 'Preview Warna';
    // Reset selected files array
    editSelectedFiles = [];
}

function showImage(imageSrc, maintenanceName) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalTitle').textContent = 'Foto Kerusakan - ' + maintenanceName;
}

function previewCreateMultipleImages(input) {
    const previewContainer = document.getElementById('create_image_previews');
    const containerDisplay = document.getElementById('create_image_preview_container');

    if (input.files && input.files.length > 0) {
        // Add new files to existing array
        Array.from(input.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                createSelectedFiles.push(file);
            }
        });

        // Clear input to allow selecting same files again
        input.value = '';

        // Re-render all previews
        renderCreatePreviews();
    }
}

function renderCreatePreviews() {
    const previewContainer = document.getElementById('create_image_previews');
    const containerDisplay = document.getElementById('create_image_preview_container');
    
    // Clear previous previews
    previewContainer.innerHTML = '';
    
    if (createSelectedFiles.length > 0) {
        containerDisplay.style.display = 'block';
        
        createSelectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6 mb-3';
                colDiv.setAttribute('data-file-index', index);

                colDiv.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid rounded" style="width: 100%; height: 120px; object-fit: cover; cursor: pointer;" onclick="showImageModal('${e.target.result}', 'Preview ${index + 1}')">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removeCreatePreviewImage(this, ${index})" style="width: 25px; height: 25px; padding: 0; border-radius: 50%;">
                            <i class="fas fa-times" style="font-size: 12px;"></i>
                        </button>
                        <div class="text-center mt-1">
                            <small class="text-muted">${file.name}</small>
                        </div>
                    </div>
                `;

                previewContainer.appendChild(colDiv);
            };
            reader.readAsDataURL(file);
        });
    } else {
        containerDisplay.style.display = 'none';
    }
}

function previewEditMultipleImages(input) {
    const previewContainer = document.getElementById('edit_image_previews');
    const containerDisplay = document.getElementById('edit_image_preview_container');

    if (input.files && input.files.length > 0) {
        // Add new files to existing array
        Array.from(input.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                editSelectedFiles.push(file);
            }
        });

        // Clear input to allow selecting same files again
        input.value = '';

        // Re-render all previews
        renderEditPreviews();
    }
}

function renderEditPreviews() {
    const previewContainer = document.getElementById('edit_image_previews');
    const containerDisplay = document.getElementById('edit_image_preview_container');
    
    // Clear previous previews
    previewContainer.innerHTML = '';
    
    if (editSelectedFiles.length > 0) {
        containerDisplay.style.display = 'block';
        
        editSelectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6 mb-3';
                colDiv.setAttribute('data-file-index', index);

                colDiv.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid rounded" style="width: 100%; height: 120px; object-fit: cover; cursor: pointer;" onclick="showImageModal('${e.target.result}', 'Preview ${index + 1}')">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removeEditPreviewImage(this, ${index})" style="width: 25px; height: 25px; padding: 0; border-radius: 50%;">
                            <i class="fas fa-times" style="font-size: 12px;"></i>
                        </button>
                        <div class="text-center mt-1">
                            <small class="text-muted">${file.name}</small>
                        </div>
                    </div>
                `;

                previewContainer.appendChild(colDiv);
            };
            reader.readAsDataURL(file);
        });
    } else {
        containerDisplay.style.display = 'none';
    }
}

// Function to remove preview image from create form
function removeCreatePreviewImage(button, fileIndex) {
    // Remove file from array
    createSelectedFiles.splice(fileIndex, 1);
    
    // Re-render previews
    renderCreatePreviews();
}

// Function to remove preview image from edit form
function removeEditPreviewImage(button, fileIndex) {
    // Remove file from array
    editSelectedFiles.splice(fileIndex, 1);
    
    // Re-render previews
    renderEditPreviews();
}

// Function to show image in modal
function showImageModal(src, title) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('imagePreviewModal');
    if (!modal) {
        const modalHtml = `
            <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imagePreviewModalLabel">Preview Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="imagePreviewModalImg" src="" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        modal = document.getElementById('imagePreviewModal');
    }

    document.getElementById('imagePreviewModalLabel').textContent = title;
    document.getElementById('imagePreviewModalImg').src = src;

    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
}

function updatePreview() {
    const namaBreakdown = document.getElementById('edit_maintenance_form').value;
    const warna = document.getElementById('edit_warna').value;
    const colorPreview = document.getElementById('color_preview');

    colorPreview.style.color = warna;

    if (namaBreakdown.trim() !== '') {
        colorPreview.textContent = namaBreakdown;
    } else {
        colorPreview.textContent = 'Preview Warna';
    }
}

function updateCreatePreview() {
    const namaBreakdown = document.getElementById('maintenance_form').value;
    const warna = document.getElementById('create_warna').value;
    const colorPreview = document.getElementById('create_color_preview');

    colorPreview.style.color = warna;

    if (namaBreakdown.trim() !== '') {
        colorPreview.textContent = namaBreakdown;
    } else {
        colorPreview.textContent = 'Preview Warna';
    }
}

$('.input-group.date').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    language: "id",
    autoclose: true,
    todayHighlight: true
});

// Handle form submission to include selected files
document.addEventListener('DOMContentLoaded', function() {
    // Handle create form submission
    const createForm = document.querySelector('form[action="/mesin/maintenance/create/"]');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            console.log('Create form submitted, selected files:', createSelectedFiles.length);
            const fileInput = document.getElementById('foto_kerusakan');
            if (createSelectedFiles.length > 0) {
                // Create new DataTransfer object to hold files
                const dt = new DataTransfer();
                createSelectedFiles.forEach(file => {
                    console.log('Adding file:', file.name, file.type);
                    dt.items.add(file);
                });
                fileInput.files = dt.files;
                console.log('Files transferred to input:', fileInput.files.length);
            }
        });
    }
    
    // Handle edit form submission
    const editForm = document.querySelector('form[action="/mesin/maintenance/edit/direct"]');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            console.log('Edit form submitted, selected files:', editSelectedFiles.length);
            const fileInput = document.getElementById('edit_foto_kerusakan');
            if (editSelectedFiles.length > 0) {
                // Create new DataTransfer object to hold files
                const dt = new DataTransfer();
                editSelectedFiles.forEach(file => {
                    console.log('Adding file:', file.name, file.type);
                    dt.items.add(file);
                });
                fileInput.files = dt.files;
                console.log('Files transferred to input:', fileInput.files.length);
            }
        });
    }
});



    </script>
@endsection
