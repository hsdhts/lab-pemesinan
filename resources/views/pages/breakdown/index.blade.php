@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Stasiun</th>
    <th>Tanggal Kejadian</th>
    <th>Tanggal Selesai</th>
    <th>Deskripsi Masalah</th>
    <th>Tindakan Perbaikan</th>
    <th>Status</th>
    <th>Foto Kerusakan</th>
    <th>Foto Perbaikan</th>
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
},


],
pageLength: 25,
responsive: true,
processing: true,
dom:'<"top"lf>rtip<"bottom"><"clear">',
serverSide: true,
ajax: "/pelumas",
columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
{data: 'nama_kaetori', name: 'nama_kategori'},
{data: 'tanggal_selesai', name: 'tanggal_kejadian'},
{data: 'deskripsi_masalah', name: 'deskripsi_masalah'},
{data: 'tindakan_perbaikan', name: 'tindakan_perbaikan'},
{data: 'status', name: 'status'},
{data: 'foto_kerusakan', name: 'foto_kerusakan'},
{data: 'foto_perbaikan', name: 'foto_perbaikan'},
{data: 'status', name: 'status'},
{data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ]
    });

</script>
@endsection
