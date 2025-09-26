@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Nama Sparepart</th>
    <th>Deskripsi</th>
    <th>Aksi</th>
@endsection


@section('data')

<style>
    tr.red-row td {
        background-color: red;
        vertical-align: middle;
        padding-top: 1px;
        padding-bottom: 1px;
    }
</style>


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
                targets: 2,
                className: 'dt-right'
            },
            {
                targets: 3,
                className: 'dt-right'
            }
        ],
        pageLength: 25,
        responsive: true,
        processing: true,
        dom:'<"top"lf>rtip<"bottom"><"clear">',
        serverSide: true,
        ajax: "/sparepart",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_sparepart', name: 'nama_sparepart' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
</script>


<!-- Modal Gambar Sparepart -->
<div class="modal fade" id="gambarSparepartModal" tabindex="-1" role="dialog" aria-labelledby="gambarSparepartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarSparepartModalLabel">Gambar Sparepart</h5>
            </div>
            <div class="modal-body">
                <img id="gambarSparepartModalImage" src="" alt="Gambar Sparepart" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection
