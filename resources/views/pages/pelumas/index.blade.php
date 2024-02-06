@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Sparepart</th>
    <th>Metode Pelumas</th>
    <th>Lubricant</th>
    <th>Lubricating Interval</th>
    <th>Pelumasan Terakhir</th>
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


],
pageLength: 25,
responsive: true,
processing: true,
dom:'<"top"lf>rtip<"bottom"><"clear">',
serverSide: true,
ajax: "/pelumas",
columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
{data: 'nama_sparepart', name: 'nama_sparepart'},
{data: 'metode_pelumasan', name: 'metode_pelumasan'},
{data: 'lubricant', name: 'lubricant'},
{data: 'lubricating_interval', name: 'lubricating_interval'},
{data: 'pelumasan_terakhir', name: 'pelumasan_terakhir'},
{data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ]

    });
  

</script>
@endsection