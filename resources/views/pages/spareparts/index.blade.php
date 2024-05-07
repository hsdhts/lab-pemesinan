@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Gambar Sparepart</th>
    <th>Sparepart</th>
    <th>Jumlah</th>
    <th>Estimasi</th>
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
            {
                data: 'sparepart_image',
                name: 'sparepart_image',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Gambar Sparepart" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\'' + data + '\')">';
                }
            },
            { data: 'nama_sparepart', name: 'nama_sparepart' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'estimasi', name: 'estimasi' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ],
        createdRow: function(row, data, dataIndex) {
            if (data.jumlah == 0) {
                $(row).children('td:not(:last-child)').css({
                    'background-color': 'red', 
                    'padding-top': '5px', 
                    'padding-bottom': '5px' 
                });
            }
        }
    });

    function setModalImage(src) {
        document.getElementById('gambarSparepartModalImage').src = '{{ asset('storage') }}/' + src;
        $('#gambarSparepartModal').modal('show');
    }
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
