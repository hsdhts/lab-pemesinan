@extends('layouts.tabel')


@section('tableHead')
    <th>No</th>
    <th>Mesin</th>
    <th>Gambar Mesin</th>
    <th>PIC</th>
    <th>Serial No.</th>
    <!-- <th>Kategori</th> -->
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
                responsivePriority:11005,
                class:'min-tablet-l',
                target:[-1,-2]
            }
        ],
        pageLength: 25,
        responsive: true,
        processing: true,
        dom:'<"top"lf>rtip<"bottom"><"clear">',
        serverSide: true,
        ajax: "/mesin",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_mesin', name: 'nama_mesin' },
            {
                data: 'mesin_image',
                name: 'mesin_image',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Gambar Mesin" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\'' + data + '\')">';
                }
            },
            { data: 'user', name: 'user.nama' },
            { data: 'no_asset', name: 'no_asset' },
            // { data: 'kategori', name: 'kategori.nama_kategori' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });

    
    function setModalImage(src) {
        document.getElementById('gambarMesinModalImage').src = '{{ asset('storage') }}/' + src;
        $('#gambarMesinModal').modal('show'); 
    }
</script>

<!-- Modal Gambar Mesin -->
<div class="modal fade" id="gambarMesinModal" tabindex="-1" role="dialog" aria-labelledby="gambarMesinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarMesinModalLabel">Gambar Mesin</h5>
                            </div>
            <div class="modal-body">
                <img id="gambarMesinModalImage" src="" alt="Gambar Mesin" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection
