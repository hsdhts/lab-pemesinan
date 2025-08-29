@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Nama Stasiun</th>
    <th>Kode Stasiun</th>
    <th>Deskripsi</th>
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
                target:[-1]
            }
        ],
        pageLength: 25,
        responsive: true,
        processing: true,
        dom:'<"top"lf>rtip<"bottom"><"clear">',
        serverSide: true,
        ajax: "/stasiun",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_stasiun', name: 'nama_stasiun' },
            { data: 'kode_stasiun', name: 'kode_stasiun' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });
</script>
@endsection
