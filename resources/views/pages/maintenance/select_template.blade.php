@extends('layouts.tray_layout')

@section('content_left')

<table class="table table-row-dashed table-row-gray-400 gs-1">
    <tr>
        <td><b>Nama Mesin</b></td>
        <td>{{ $mesin['nama_mesin'] }}</td>
    </tr>
    <tr>
        <td><b>Kode Mesin</b></td>
        <td>{{ $mesin['kode_mesin'] }}</td>
    </tr>
</table>

@canany(['superadmin','admin'])
<button type="button" class="btn btn-primary container-fluid mt-8 mb-4" data-bs-toggle="modal" data-bs-target="#kt_modal_add_maintenance">
    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr075.svg-->
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="white"/>
            <rect x="4.364" y="11.364" width="16" height="2" rx="1" fill="white"/>
        </svg>
    </span>
    <!--end::Svg Icon-->
    Tambah Breakdown
</button>
@endcanany

<a href="/mesin" class="btn btn-dark container-fluid mt-4">
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

@canany(['superadmin','admin'])
<h3>Tambah Breakdown Baru</h3>
<p>Anda dapat menambahkan breakdown baru untuk mesin ini secara langsung menggunakan tombol di sebelah kiri.</p>
@else
<h3>Mesin ini tidak punya jadwal breakdown</h3>
<p>Silahkan hubungi PIC dari mesin ini atau admin untuk dibuatkan jadwal</p>
@endcanany

@endsection

<!-- Modal untuk Tambah Breakdown -->
<div class="modal fade" tabindex="-1" id="kt_modal_add_maintenance">
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

            <form action="{{ route('mesin.maintenance.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mesin_id" value="{{ $mesin['id'] }}">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="maintenance_form" class="form-label float-start">Nama Breakdown</label>
                        <input type="text" class="form-control @error('nama_maintenance') is-invalid @enderror clear-form" id="maintenance_form" value="{{ old('nama_maintenance') }}" name="nama_maintenance" required>
                    </div>



                    <div class="mb-3">
                        <label for="foto_kerusakan" class="form-label float-start">Foto Kerusakan</label>
                        <input type="file" class="form-control @error('foto_kerusakan') is-invalid @enderror clear-form" id="foto_kerusakan" name="foto_kerusakan[]" accept="image/*" multiple onchange="previewMultipleImages(this)">
                        <div class="form-text">Upload foto kerusakan - Bisa pilih beberapa foto sekaligus</div>
                        <!-- Preview multiple images -->
                        <div id="image_preview_container" class="mt-2" style="display: none;">
                            <div class="row" id="image_previews"></div>
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
                        Simpan Maintenance
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('customJs')
    <script>

// Global variables to store selected files
let selectedFiles = [];

function clearValue(){
    x = document.getElementsByClassName('clear-form');
    x.forEach(element => {
        element.value = ""
    });
    // Reset preview
    document.getElementById('image_preview_container').style.display = 'none';
    document.getElementById('image_previews').innerHTML = '';
    // Reset selected files array
    selectedFiles = [];
}

// Function to preview multiple images
function previewMultipleImages(input) {
    if (input.files && input.files.length > 0) {
        // Add new files to existing array
        Array.from(input.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                selectedFiles.push(file);
            }
        });

        // Clear input to allow selecting same files again
        input.value = '';

        // Re-render all previews
        renderPreviews();
    }
}

// Function to render previews
function renderPreviews() {
    const previewContainer = document.getElementById('image_previews');
    const containerDisplay = document.getElementById('image_preview_container');
    
    // Clear previous previews
    previewContainer.innerHTML = '';
    
    if (selectedFiles.length > 0) {
        containerDisplay.style.display = 'block';
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-3 col-sm-4 col-6 mb-3';
                colDiv.setAttribute('data-file-index', index);

                colDiv.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="img-fluid rounded" style="width: 100%; height: 120px; object-fit: cover; cursor: pointer;" onclick="showImageModal('${e.target.result}', 'Preview ${index + 1}')">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removePreviewImage(this, ${index})" style="width: 25px; height: 25px; padding: 0; border-radius: 50%;">
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

// Function to remove preview image
function removePreviewImage(button, index) {
    // Remove file from array
    selectedFiles.splice(index, 1);
    
    // Re-render all previews
    renderPreviews();
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

// Handle form submission to transfer files from array to input
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="/mesin/maintenance/create/"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitted, selected files:', selectedFiles.length);
            const fileInput = document.getElementById('foto_kerusakan');
            if (selectedFiles.length > 0) {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => {
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
