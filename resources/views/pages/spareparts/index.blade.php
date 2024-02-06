@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Item Number</th>
    <th>Sparepart</th>
    <th>Jumlah</th>
    <th>Deskripsi</th>
    <th>Aksi</th>

@endsection



@section('data')
<script>
			//makan bang
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

{data: 'item_number', name: 'item_number'},
{data: 'nama_sparepart', name: 'nama_sparepart'},
{data: 'jumlah', name: 'jumlah'},
{data: 'deskripsi', name: 'deskripsi'},
{data: 'aksi', name: 'aksi', orderable: false, searchable: false},
//{data: 'kategori', name: 'kategori', orderable: false, searchable: false},
        ]

    });
  

</script>
@endsection