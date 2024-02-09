@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Mesin</th>
    <th>Gambar Mesin</th>
    <th>Name Tag</th>
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
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Gambar Mesin" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\'' + data + '\', \'gambarMesinModal\')">';
                }
            },

            {
                data: 'nameTag_image',
                name: 'nameTag_image',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Gambar Name Tag" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\'' + data + '\', \'gambarMesinModal\')">';
                }
            },
           
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });

    function setModalImage(src, modalId) {
        document.getElementById(modalId + 'Image').src = '{{ asset('storage') }}/' + src;
        $('#' + modalId).modal('show'); 
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

<!-- Modal Name Tag Mesin -->
<div class="modal fade" id="nameTagMesinModal" tabindex="-1" role="dialog" aria-labelledby="nameTagMesinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameTagMesinModalLabel">Name Tag Mesin</h5>
            </div>
            <div class="modal-body">
                <img id="nameTagMesinModalImage" src="" alt="Name Tag Mesin" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection
