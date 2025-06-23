@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Gambar Sample</th>
    <th>Shift</th>
    <th>Nama Operator</th>
    <th>Hydrocyclone</th>
    <th>Aksi</th>
@endsection

@section('data')
<script>
    $('#tabelTemplate').DataTable({
        columnDefs: [
            {
                class:'all',
                target: 1
            },
            {
                responsivePriority: 11005,
                class:'min-tablet-l',
                target:[-1,-2]
            },
            {
                targets: [2,3,4],
                className: 'dt-center'
            }
        ],
        pageLength: 25,
        responsive: true,
        processing: true,
        dom:'<"top"lf>rtip<"bottom"><"clear">',
        serverSide: true,
        ajax: "/kernel-hydrocyclone",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'image_kernelHydroCyclone', name: 'image_kernelHydroCyclone',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Sample Kernel" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\''+data+'\', \'gambarSampleKernelModal\')">'
                }
            },
            {data: 'shift', name: 'shift'},
            {data: 'nama_operator', name: 'nama_operator'},
            {data: 'hydrocyclone', name: 'hydrocyclone'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false,
                render: function(data, type, full, meta) {
                    return data;
                }
            }
        ]
    });

    function setModalImage(src, modalId) {
        document.getElementById(modalId + 'Image').src = '{{ asset('storage') }}/' + src;
        $('#' + modalId).modal('show');
    }
</script>

<!-- Modal Gambar Sample Kernel -->
<div class="modal fade" id="gambarSampleKernelModal" tabindex="-1" role="dialog" aria-labelledby="gambarSampleKernelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarSampleKernelModalLabel">Gambar Sample Kernel Hydrocyclone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="gambarSampleKernelModalImage" src="" alt="Gambar Sample Kernel Hydrocyclone" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
