<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @page{
            margin-left: 2.5cm;
            margin-right: 2cm;
            margin-top: 2cm;
            margin-bottom: 2cm;
        }
        html{
            font-family: Arial, Helvetica, sans-serif;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            font-size: 8pt;
        }
        .tabel1{
            width: 100%;
            margin: 20px auto;
            padding: 2px;
        }
        .detailPekerjaan{
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid black;
            border-radius: 3px;
            min-height: 100px;
            font-size: 8pt;
            padding: 6px;
            box-sizing: border-box;
        }
        .table2 {
          border-collapse: collapse;
          width: 100%;
          margin: 5px auto;
          margin-bottom: 20px;
        }
        .detailPekerjaan p{
            margin-top: 3px;
            margin-bottom: 3px;
            font-size: 8pt;
        }
        .judul{
            text-align: center;
            margin: 2px auto;
        }
        .laporan-item {
            page-break-inside: avoid;
            margin-bottom: 30px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
        }
        .laporan-item:last-child {
            border-bottom: none;
        }
        .laporan-header {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .page-break {
            page-break-before: always;
        }
    </style>

</head>
<body>

    <h3 class="judul">LAPORAN PENYELESAIAN PEKERJAAN HARIAN</h3>
    <h5 class="judul">PT.Parit Sembada POM</h5>
    <h6 class="judul">Tanggal: {{ \Illuminate\Support\Carbon::parse($tanggal)->formatLocalized('%d %B %Y') }}</h6>
    <hr style="margin-bottom: 30px;">

    @php
        setlocale(LC_ALL, 'IND');
    @endphp

    @foreach($jadwal_list as $index => $jadwal)
        @if($index > 0)
            <div class="page-break"></div>
        @endif
        
        <div class="laporan-item">
            <div class="laporan-header">
                <h4 style="margin: 0;">LAPORAN {{ $index + 1 }} - {{ $jadwal->maintenance->mesin->nama_mesin }}</h4>
            </div>
            
            <table class="tabel1">
                <tr>
                    <td>Tanggal Realisasi</td>
                    <td>@if($jadwal->tanggal_realisasi){{ \Illuminate\Support\Carbon::parse($jadwal->tanggal_realisasi)->formatLocalized('%d %B %Y') }} @else - @endif</td>
                    <td>Internal Servis</td>
                    <td>{{ $jadwal->maintenance->periode }} {{ $jadwal->maintenance->satuan_periode }}</td>
                </tr>
                <tr>
                    <td>Nama Mesin</td>
                    <td>{{ $jadwal->maintenance->mesin->nama_mesin }}</td>
                    <td>Jenis Pekerjaan</td>
                    <td>{{ $jadwal->maintenance->nama_maintenance }}</td>
                </tr>
                <tr>
                    <td>Kode Mesin</td>
                    <td>{{ $jadwal->maintenance->mesin->kode_mesin}}</td>
                    <td>Lama Pekerjaan</td>
                    <td>{{ $jadwal->lama_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Spesifikasi</td>
                    <td>{{ $jadwal->maintenance->mesin->spesifikasi }}</td>
                    <td>Personel</td>
                    <td>{{ $jadwal->personel }}</td>
                </tr>
            </table>

            <h5 style="margin-bottom: 2px;">Detail Pekerjaan:</h5>
            <div class="detailPekerjaan">
                {!! $jadwal->keterangan !!}
            </div>

            @php
                $sparepart = $jadwal->sparepart;
            @endphp

            <h5 style="margin-bottom: 0px;">Penggunaan Sparepart:</h5>
            <table class="table2">
                <tr>
                    <th>Sparepart</th>
                    <th>Jumlah</th>
                </tr>
                @foreach ($sparepart as $s)
                    <tr>
                        <td>{{ $s->nama_sparepart }}</td>
                        <td>{{ $s->pivot->jumlah }}</td>
                    </tr>
                @endforeach
                @if($sparepart->isEmpty())
                    <tr>
                        <td style="padding: 10px; text-align: center;" colspan="2">Tidak Ada Penggunaan Spareparts</td>
                    </tr>
                @endif
            </table>
        </div>
    @endforeach

    <div style="margin-top: 30px; text-align: center; border-top: 2px solid #333; padding-top: 15px;">
        <p><strong>Total Laporan: {{ count($jadwal_list) }}</strong></p>
        <p>Dicetak pada: {{ \Illuminate\Support\Carbon::now()->formatLocalized('%d %B %Y, %H:%M') }}</p>
    </div>

</body>
</html>