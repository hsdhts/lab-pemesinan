<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @page{
            margin-left: 2.5cm;
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
            margin: 30px auto;
            padding: 2px;
        }
        .detailPekerjaan{
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid black;
            border-radius: 3px;
            min-height: 150px;
            font-size: 11pt;
            padding: 6px;
            box-sizing: border-box;
            font-size: 8pt;
        }
        .table2 {
          border-collapse: collapse;
          width: 100%;
          margin: 5px auto;
        }
        .detailPekerjaan p{
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 8pt;
        }
        .judul{
            text-align: center;
            margin: 2px auto;
        }
    </style>

</head>
<body>

    <h4 class="judul">LAPORAN PENYELESAIAN PEKERJAAN</h4>
    <h6 class="judul">PT.Parit Sembada POM</h6>
    <table class="tabel1">

        @php
            setlocale(LC_ALL, 'IND');
        @endphp
        <tr>
            <td>Tanggal Selesai</td><td>@if($jadwal->tanggal_realisasi){{ Illuminate\Support\Carbon::parse($jadwal->tanggal_realisasi)->formatLocalized('%d %B %Y') }} @else - @endif </td><td>Internal Servis</td><td>{{ $jadwal->maintenance->periode }} {{ $jadwal->maintenance->satuan_periode }}</td>
        </tr>
        <tr>
            <td>Nama Mesin</td><td>{{ $jadwal->maintenance->mesin->nama_mesin }}</td><td>Jenis Pekerjaan</td><td>{{ $jadwal->maintenance->nama_maintenance }}</td>
        </tr>
        <tr>
            <td>Kode Mesin</td><td>{{ $jadwal->maintenance->mesin->kode_mesin}}</td><td>Lama Pekerjaan</td><td>{{ $jadwal->lama_pekerjaan }}</td>
        </tr>

        <tr>
            <td>spesifikasi</td><td>{{ $jadwal->maintenance->mesin->spesifikasi }}</td><td>Personel</td><td>{{ $jadwal->personel }}</td>
        </tr>
    </table>

    <h5 style="margin-bottom: 2px;">Detail Pekerjaan : </h5>
    <div class="detailPekerjaan">
        {!! $jadwal->keterangan !!}
    </div>

    @if($jadwal->isi_form && $jadwal->isi_form->isNotEmpty())
    <h5 style="margin-bottom: 2px;">Hasil Pemeriksaan Form : </h5>
    <table class="table2">
        <tr>
            <th>No</th>
            <th>Nama Form</th>
            <th>Syarat</th>
            <th>Hasil</th>
        </tr>
        @foreach($jadwal->isi_form as $isi)
            @if($isi->form)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $isi->form->nama_form }}</td>
                <td>{{ $isi->form->syarat }}</td>
                <td>{{ $isi->nilai ?? '-' }}</td>
            </tr>
            @endif
        @endforeach
    </table>
    @endif

    @php
        $sparepart = $jadwal->sparepart;
    @endphp


    <h5 style="margin-bottom: 0px;">Penggunaan Sparepart : </h5>
    <table class="table2">

        <tr>
            <th>Sparepart</th><th>Jumlah</th>
        </tr>


        @foreach ($sparepart as $s)

            <tr>
                <td>{{ $s->nama_sparepart }}</td><td>{{ $s->pivot->jumlah }}</td>
            </tr>
        @endforeach

        @if($sparepart->isEmpty())
            <tr>
                <td style="padding: 10px; text-align: center;" colspan="2">Tidak Ada Penggunaan Spareparts</td>
            </tr>
        @endif
    </table>


</body>
</html>
