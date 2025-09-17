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

            <form action="{{ url('/maintenance/create/') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="maintenance_form" class="form-label float-start">Nama Breakdown</label>
                        <input type="text" class="form-control @error('nama_maintenance') is-invalid @enderror clear-form" id="maintenance_form" value="{{ old('nama_maintenance') }}" name="nama_maintenance">
                    </div>

                    <div class="mb-3">
                        <label for="foto_kerusakan" class="form-label float-start">Foto Kerusakan</label>
                        <input type="file" class="form-control @error('foto_kerusakan') is-invalid @enderror clear-form" id="foto_kerusakan" name="foto_kerusakan[]" accept="image/*" multiple>
                        <div class="form-text">Upload foto kerusakan (opsional) - Anda dapat memilih beberapa foto sekaligus</div>
                        <!-- Preview container untuk multiple images -->
                        <div id="create_image_preview_container" class="mt-3" style="display: none;">
                            <div class="row" id="create_image_previews"></div>
                        </div>
                    </div>

                    <div class="my-5">
                        <div class="p-2 fw-bold">Warna</div>
                        <div class="p-2 d-inline"><input type="color" name="warna" id="create_warna" value="{{ old('warna','#0095E8') }}">
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




<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Breakdown</h5>

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

            <form action="{{ url('/maintenance/edit/') }}" method="POST" enctype="multipart/form-data">

                @csrf
            <div class="modal-body">

                <input type="hidden" class="clear-form" name="index" id="edit_index">
                    <div class="mb-3">
                        <label for="nama_maintenance_form" class="form-label float-start">Nama Breakdown</label>
                        <input type="text" class="form-control clear-form" id="edit_maintenance_form" name="nama_maintenance">
                    </div>




                    <div class="mb-3">
                        <label for="edit_foto_kerusakan" class="form-label float-start">Foto Kerusakan</label>
                        <input type="file" class="form-control clear-form" id="edit_foto_kerusakan" name="foto_kerusakan[]" accept="image/*" multiple>
                        <div class="form-text">Upload foto kerusakan baru - Anda dapat memilih beberapa foto sekaligus</div>
                        <!-- Preview container untuk multiple images -->
                        <div id="edit_image_preview_container" class="mt-3" style="display: none;">
                            <div class="row" id="edit_image_previews"></div>
                        </div>
                        <!-- Container untuk foto yang sudah ada -->
                        <div id="existing_images_container" class="mt-3" style="display: none;">
                            <label class="form-label">Foto yang sudah ada:</label>
                            <div class="row" id="existing_images"></div>
                        </div>
                    </div>

                    <div class="my-5">
                        <div class="p-2 fw-bold">Warna</div>
                            <div class="p-2 d-inline"><input type="color" name="warna" id="edit_warna">
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
                <button type="submit" class="btn btn-primary text-nowrap">
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
@endsection

@section('content_left')


    <table class="table table-row-dashed table-row-gray-400 gs-1">
        <tr>
            <td><b>Nama Mesin</b></td>
            <td>{{ $mesin->get('nama_mesin') }}</td>
        </tr>
        <tr>
            <td><b>Kode Mesin</b></td>
            <td>{{ $mesin->get('kode_mesin') }}</td>
        </tr>


    </table>

    @if($attach->get('aksi') != 'edit')
            <button class="btn btn-primary mb-3 container-fluid" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen035.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"/>
                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"/>
                    </svg>
                </span>
        <!--end::Svg Icon-->
                <span>Breakdown</span>
            </button>
    @endif


          <form action="@if($attach->isEmpty()) {{ url('/maintenance/submit/') }} @elseif($attach->get('aksi') == 'tambah') {{ url('/mesin/maintenance/create/submit') }} @else {{ url('/mesin/maintenance/edit/submit') }} @endif" method="post">
            @method('put')
            @csrf
            <button class="btn btn-warning mb-3 text-dark container-fluid" type="submit">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen037.svg-->
                <span class="svg-icon-dark svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"/>
                    </svg>
                </span>
                <!--end::Svg Icon-->

                <span>Simpan Perubahan</span>
            </button>
        </form>




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
    @if($attach->get('aksi') == 'tambah')
        <div class="p-5 bg-primary h1 text-light fw-bolder text-center rounded">
            Tambahkan Breakdown
        </div>
    @elseif($attach->get('aksi') == 'edit')
    <div class="p-5 bg-primary h1 text-light fw-bolder text-center rounded">
        Ubah Breakdown
    </div>
    @endif
@if($setup->isNotEmpty())
<table class="table gs-7 align-middle">


    @foreach ($setup as $s)

    <tr class="table-primary">
        <td class="fw-bold fs-1">{{ $s->get('nama_setup') }}</td>

        <td class="text-end">

            <form action="{{ url('/maintenance/delete/') }}" method="post" onSubmit="return hapusSetup(this);" style ="display:inline-block;">

                @csrf
                <input type="hidden" name="index" value="{{ $loop->index }}">
                <button class="btn btn-sm btn-danger text-nowrap" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path fill="white" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path fill="white" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>
            </form>


            <button class="btn btn-sm btn-dark text-nowrap d-inline" data-bs-toggle="modal" data-bs-target="#kt_modal_2" onclick="setEdit({{ $loop->index }}, '{{ $s->get('nama_setup') }}', '{{ $s->get('warna') }}')">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen055.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="white"/>
                        <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="white"/>
                        <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="white"/>
                    </svg>
            <!--end::Svg Icon-->
            </button>




        </td>
    </tr>
    <tr>
        <td>
            <table class="table g-1">



                <tr>
                    <td>
                        <b>Warna</b>
                    </td>
                    <td>
                        <b>:</b>
                    </td>
                    <td>
                        <span style="color: {{ $s->get('warna') }};"><b>{{ $s->get('warna') }}</b></span>
                    </td>
                </tr>

            </table>
        </td>
        <td></td>
    </tr>

    </tr>




    @endforeach

</table>
@else

<h2 class="text-center my-7">*Masih Kosong*</h2>

@endif

@endsection


@section('customJs')
    <script>


        function setEdit(index, nama_setup_maintenance, warna){
            document.getElementById('edit_index').value = index;
            document.getElementById('edit_maintenance_form').value = nama_setup_maintenance;
            document.getElementById('edit_warna').value = warna;
        }

        function indexMaintenance(index) {
            document.getElementById('maintenance_index').value = index;
        }

        function indexEditMaintenance(indexMaintenance, index, form, syarat){
            document.getElementById('edit_maintenance_index').value = indexMaintenance;
            document.getElementById('edit_form_index').value = index;
            document.getElementById('edit_form_form').value = form;
            document.getElementById('edit_form_syarat').value = syarat;
        }


        // Global variables to store selected files
        let createSelectedFiles = [];
        let editSelectedFiles = [];

        function clearValue(){
            x = document.getElementsByClassName('clear-form');
            x.forEach(element => {
                element.value = ""
            });
            // Reset preview
            document.getElementById('create_image_preview_container').style.display = 'none';
            document.getElementById('create_image_previews').innerHTML = '';
            document.getElementById('edit_image_preview_container').style.display = 'none';
            document.getElementById('edit_image_previews').innerHTML = '';
            // Reset selected files arrays
            createSelectedFiles = [];
            editSelectedFiles = [];
        }


        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            todayBtn: "linked",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });
        $('.datepicker.finish').datepicker({
            format: "dd-mm-yyyy",
            todayBtn: "linked",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });

        $('.time').datetimepicker({
            format: 'LT'
        });

        document.getElementById('foto_kerusakan').addEventListener('change', function(e) {
            previewCreateMultipleImages(e.target);
        });

        document.getElementById('edit_foto_kerusakan').addEventListener('change', function(e) {
            previewEditMultipleImages(e.target);
        });

        // Function to preview multiple images for create form
        function previewCreateMultipleImages(input) {
            if (input.files && input.files.length > 0) {
                // Add new files to existing array
                Array.from(input.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        createSelectedFiles.push(file);
                    }
                });

                input.value = '';

                // Re-render all previews
                renderCreatePreviews();
            }
        }

        // Function to preview multiple images for edit form
        function previewEditMultipleImages(input) {
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        editSelectedFiles.push(file);
                    }
                });

                input.value = '';

                // Re-render all previews
                renderEditPreviews();
            }
        }

        // Function to render create previews
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
                                <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover; cursor: pointer;" onclick="showImageModal('${e.target.result}', 'Preview ${index + 1}')">
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

        // Function to render edit previews
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
                                <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover; cursor: pointer;" onclick="showImageModal('${e.target.result}', 'Preview ${index + 1}')">
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

        // Function to remove create preview image
        function removeCreatePreviewImage(button, index) {
            createSelectedFiles.splice(index, 1);

            renderCreatePreviews();
        }

        function removeEditPreviewImage(button, index) {
            editSelectedFiles.splice(index, 1);

            renderEditPreviews();
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            const createForm = document.querySelector('form[action="{{ url('/maintenance/create/') }}"]');
            const editForm = document.querySelector('form[action="{{ url('/maintenance/edit/') }}"]');

            if (createForm) {
                createForm.addEventListener('submit', function(e) {
                    const fileInput = document.getElementById('foto_kerusakan');
                    if (createSelectedFiles.length > 0) {
                        const dt = new DataTransfer();
                        createSelectedFiles.forEach(file => {
                            dt.items.add(file);
                        });
                        fileInput.files = dt.files;
                    }
                });
            }

            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    const fileInput = document.getElementById('edit_foto_kerusakan');
                    if (editSelectedFiles.length > 0) {
                        const dt = new DataTransfer();
                        editSelectedFiles.forEach(file => {
                            dt.items.add(file);
                        });
                        fileInput.files = dt.files;
                    }
                });
            }
        });

    </script>
@endsection
