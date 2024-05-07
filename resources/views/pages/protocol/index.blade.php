@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Sparepart</th>
    <th>Mesin</th>
    <th>Inspection Item</th>
    <th>Tolerance</th>
    <th>Data</th>
    <th>Validation Data</th>
    <th>Last Protocol</th>
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
ajax: "/protocol",
columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
{data: 'nama_sparepart', name: 'nama_sparepart'},
{data: 'nama_mesin', name: 'nama_mesin'},
{data: 'inspection_item', name: 'inspection_item'},
{data: 'tolerance', name: 'tolerance'},
{data: 'data', name: 'data'},
{data: 'validation_data', name: 'validation_data'},
{data: 'last_protocol', name: 'last_protocol'},
{data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ]
        
    });
  

</script>
@endsection