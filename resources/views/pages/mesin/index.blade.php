@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Mesin</th>
    <th>Gambar Mesin</th>
    <th>PIC</th>
    <th>Serial No.</th>
    <th>Kategori</th>
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
                    return '<img src="{{ asset('storage') }}/'+data+'" alt="Gambar Mesin" style="max-width: 100px; max-height: 100px;">';
                }
            },
            { data: 'user', name: 'user.nama' },
            { data: 'no_asset', name: 'no_asset' },
            { data: 'kategori', name: 'kategori.nama_kategori' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
</script>
@endsection
