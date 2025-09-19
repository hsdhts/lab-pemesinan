@extends('layouts.tray_layout')

@section('customCss')
<link href="{{ asset('assets/js-year-calendar/dist/js-year-calendar.min.css') }}" rel="stylesheet" type="text/css" />


@endsection


@section('content_left')
@if($mesin)
<table class="table table-row-dashed table-row-gray-400 gs-1">
  <<tr>
        <td><b>Nama Mesin</b></td>
        <td>{{ $mesin->nama_mesin ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td><b>Kode Mesin</b></td>
      <td>{{ $mesin->kode_mesin ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td><b>Stasiun </b></td>
      <td>
        @if($mesin->stasiun)
          <span class="badge badge-light-primary">{{ $mesin->stasiun->nama_stasiun }}</span>
        @else
          <span class="badge badge-light-secondary">Belum Ditentukan</span>
        @endif
      </td>
    </tr>

    <tr>
 </tr>
    <tr>
      <td colspan="2">
        <b>Spesifikasi</b><br>
        {!! $mesin->spesifikasi ?? 'Tidak ada spesifikasi' !!}
      </td>
    </tr>
</table>
@else
<div class="alert alert-warning">
    <strong>Peringatan!</strong> Data mesin tidak ditemukan.
</div>
@endif
@endsection


@section('content_right')
<!--Start Modal-->


<div id='tampil_jadwal' class="modal fade" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Maintenance</h4>

               <!--begin::Close-->
               <div class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen034.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-2hx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
          </div>

          <div class="modal-body">

            <h4 id="tanggal_jadwal" class="mb-5 pb-2"></h4>

            <table id="tabel_jadwal_maintenance" class="table fs-4 table-row-dashed table-row-gray-300 gy-2">

            </table>

          </div>



          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>

<!--End Modal-->


  <div id="calendar"></div>
@endsection

@section('customJs')
<script src="{{ asset('assets/js-year-calendar/dist/js-year-calendar.min.js') }}"></script>
<script src="{{ asset('assets/js-year-calendar/locales/js-year-calendar.id.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if Calendar library is loaded
            if (typeof Calendar === 'undefined') {
                console.error('Calendar library not loaded!');
                alert('Error: Calendar library tidak dapat dimuat. Silakan refresh halaman.');
                return;
            }

            // Check if calendar element exists
            const calendarElement = document.querySelector('#calendar');
            if (!calendarElement) {
                console.error('Calendar element not found!');
                alert('Error: Element calendar tidak ditemukan.');
                return;
            }

            // Debug: Log maintenance data
            console.log('Maintenance data:', @json($maintenance));
            console.log('Maintenance count:', {{ $maintenance->count() }});
            
            // Prepare calendar data
            const calendarData = [
                @foreach($maintenance as $m)
                    @if($m->jadwal && $m->jadwal->count() > 0)
                        @foreach($m->jadwal as $j)
                             {
                              @php
                               $tanggal_rencana = Illuminate\Support\Carbon::parse($j->tanggal_rencana);
                              @endphp
                              startDate: new Date({{ $tanggal_rencana->year }}, {{ ($tanggal_rencana->month) - 1 }}, {{ $tanggal_rencana->day }}),
                              endDate: new Date({{ $tanggal_rencana->year }}, {{ ($tanggal_rencana->month) - 1 }}, {{ $tanggal_rencana->day }}),
                              nama: '{{ addslashes($m->nama_maintenance) }}',
                              color: '{{ $m->warna ?? "#007bff" }}',
                              id: {{ $j->id }},
                            },
                        @endforeach
                    @endif
                @endforeach
            ];

            console.log('Calendar data prepared:', calendarData);

            try {
                // Initialize calendar
                const calendar = new Calendar('#calendar', {
                  language: 'id',
                  dataSource: calendarData,
                  enableRangeSelection: false,
                  startYear: {{ now()->year }},
                  minDate: new Date({{ now()->year }}, 0, 1),
                  maxDate: new Date({{ now()->year }}, 11, 31)
                });

                console.log('Calendar initialized successfully');

                // Register events
                calendarElement.addEventListener('clickDay', function(e) {
                  console.log('Day clicked:', e.date, 'Events:', e.events);
                  
                  if (!e.events || e.events.length === 0) {
                    console.log('No events for this day');
                    return;
                  }

                  var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

                  $('#tampil_jadwal').modal('show');

                  var a = e.events;
                  var tanggal = e.date.getDate() + ' ' + bulan[e.date.getMonth()] + ' ' + e.date.getFullYear();
                  var maintenance = '';

                  a.forEach(element => {
                    // Use proper route generation with route() helper
                    var detailUrl = '{{ route("jadwal.detail", ":id") }}'.replace(':id', element.id);
                    maintenance += '<tr><td><a style="color:' + element.color + ';" href="' + detailUrl + '">' + element.nama + '</a></td></tr>';
                  });

                  document.getElementById('tabel_jadwal_maintenance').innerHTML = maintenance;
                  document.getElementById('tanggal_jadwal').innerHTML = tanggal;
                });

            } catch (error) {
                console.error('Error initializing calendar:', error);
                alert('Error: Gagal menginisialisasi calendar - ' + error.message);
            }
        });
    </script>
@endsection
