<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @page{
            margin: 2cm;
        }
        html{
            font-family: Arial, Helvetica, sans-serif;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            font-size: 10pt;
        }
        .tabel1{
            width: 100%;
            margin: 20px auto;
            padding: 2px;
        }
        .detailPekerjaan{
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid black;
            border-radius: 5px;
            min-height: 120px;
            font-size: 10pt;
            padding: 10px;
            box-sizing: border-box;
            background-color: #fafafa;
        }
        .table2 {
          border-collapse: collapse;
          width: 100%;
          margin: 10px auto;
        }
        .table2 th {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }
        .detailPekerjaan p{
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 10pt;
        }
        .judul{
            text-align: center;
            margin: 2px auto;
            font-weight: bold;
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
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 8px;
            color: #333;
        }
        .photo-section {
            margin: 20px 0;
            page-break-inside: avoid;
        }
        .photo-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .photo-item {
            flex: 1 1 45%;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 3px;
        }
        .photo-item img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 3px;
        }
        .photo-caption {
            font-size: 8pt;
            margin-top: 5px;
            color: #666;
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .judul {
                font-size: 14px;
                margin: 8px auto;
                padding: 0 10px;
                text-align: center;
            }
            
            /* Adjust date positioning for mobile */
            .judul:nth-of-type(3) {
                text-align: left;
                margin-left: 20px;
                padding-left: 0;
            }
            
            .tabel1 {
                font-size: 9pt;
                margin: 15px 5px;
                width: calc(100% - 10px);
            }
            
            .tabel1 td {
                padding: 6px 4px;
                word-wrap: break-word;
                max-width: 120px;
            }
            
            .detailPekerjaan {
                margin: 15px 5px;
                padding: 8px;
                font-size: 9pt;
                min-height: 100px;
            }
            
            .section-title {
                font-size: 11pt;
                margin: 15px 5px 5px 5px;
            }
            
            .table2 {
                margin: 10px 5px;
                font-size: 9pt;
                width: calc(100% - 10px);
            }
            
            .table2 td, .table2 th {
                padding: 5px 3px;
            }
        }
        
        @media (max-width: 480px) {
            .judul {
                font-size: 12px;
                margin: 6px auto;
                padding: 0 15px;
                line-height: 1.3;
            }
            
            /* Adjust date positioning for smaller mobile screens */
            .judul:nth-of-type(3) {
                text-align: left;
                margin-left: 25px;
                padding-left: 0;
                font-size: 11px;
            }
            
            .tabel1 {
                font-size: 8pt;
                margin: 10px 8px;
                width: calc(100% - 16px);
            }
            
            .tabel1 td {
                padding: 4px 3px;
                font-size: 8pt;
                max-width: 100px;
            }
            
            .detailPekerjaan {
                margin: 10px 8px;
                padding: 6px;
                font-size: 8pt;
                min-height: 80px;
            }
            
            .section-title {
                font-size: 10pt;
                margin: 12px 8px 4px 8px;
            }
            
            .table2 {
                margin: 8px 8px;
                font-size: 8pt;
                width: calc(100% - 16px);
            }
            
            .table2 td, .table2 th {
                padding: 4px 2px;
                font-size: 8pt;
            }
            
            .photo-grid {
                gap: 5px;
                margin: 8px;
            }
            
            .photo-item {
                flex: 1 1 100%;
                margin-bottom: 5px;
            }
        }
    </style>

</head>
<body>

    <h4 class="judul">LAPORAN PENYELESAIAN PEKERJAAN HARIAN</h4>
    <h6 class="judul">PT.Parit Sembada POM</h6>
    <h6 class="judul">Tanggal: {{ \Illuminate\Support\Carbon::parse($tanggal)->formatLocalized('%d %B %Y') }}</h6>

    @php
        setlocale(LC_ALL, 'IND');
    @endphp

    @foreach($jadwal_list as $index => $jadwal)
        @if($index > 0)
            <div style="page-break-before: always;"></div>
        @endif
        
        <div style="margin-top: 20px;">
            <h4 class="judul">Laporan ke {{ $index + 1 }}: {{ $jadwal->maintenance->nama_maintenance }}</h4>
        </div>
        
        <table class="tabel1">
                <tr>
                    <td>Tanggal Selesai</td>
                    <td>@if($jadwal->tanggal_realisasi){{ \Illuminate\Support\Carbon::parse($jadwal->tanggal_realisasi)->formatLocalized('%d %B %Y') }} @else - @endif</td>
                    <td>Jenis Pekerjaan</td>
                    <td>{{ $jadwal->maintenance->nama_maintenance }}</td>
                </tr>
                <tr>
                    <td>Nama Mesin</td>
                    <td>{{ $jadwal->maintenance->mesin->nama_mesin }}</td>
                    <td>Kode Mesin</td>
                    <td>{{ $jadwal->maintenance->mesin->kode_mesin}}</td>
                </tr>
                <tr>
                    <td>Spesifikasi</td>
                    <td colspan="3">{{ $jadwal->maintenance->mesin->spesifikasi }}</td>
                </tr>
            </table>

            <h5 style="margin-bottom: 2px;" class="section-title">Detail Pekerjaan :</h5>
            <div class="detailPekerjaan">
                {!! $jadwal->keterangan !!}
            </div>

            @php
                $sparepart = $jadwal->sparepart;
            @endphp

            <h5 style="margin-bottom: 0px;" class="section-title">Penggunaan Sparepart :</h5>
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

            {{-- Foto Kerusakan Section --}}
            @if($jadwal->maintenance && $jadwal->maintenance->foto_kerusakan)
                @php
                    // Handle both single string and JSON array formats
                    if (is_string($jadwal->maintenance->foto_kerusakan)) {
                        // Try to decode as JSON first
                        $fotoKerusakan = json_decode($jadwal->maintenance->foto_kerusakan, true);
                        // If not valid JSON, treat as single file path
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            $fotoKerusakan = [$jadwal->maintenance->foto_kerusakan];
                        }
                    } else {
                        $fotoKerusakan = $jadwal->maintenance->foto_kerusakan;
                    }
                @endphp
                @if($fotoKerusakan && count($fotoKerusakan) > 0)
                <div class="photo-section">
                    <h5 class="section-title">Foto Kerusakan :</h5>
                    <div class="photo-grid">
                        @foreach($fotoKerusakan as $index => $foto)
                            @php
                                $imagePath = storage_path('app/public/' . $foto);
                                $imageData = '';
                                $mimeType = '';
                                
                                if (file_exists($imagePath)) {
                                    $imageData = base64_encode(file_get_contents($imagePath));
                                    $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                    $mimeType = 'image/' . ($extension === 'jpg' ? 'jpeg' : $extension);
                                }
                            @endphp
                            @if($imageData)
                            <div class="photo-item">
                                <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Foto Kerusakan {{ $index + 1 }}" style="max-width: 200px; max-height: 150px;">
                                <div class="photo-caption">Foto Kerusakan {{ $index + 1 }}</div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
             @endif

             {{-- Foto Hasil Perbaikan Section --}}
             @if($jadwal->foto_perbaikan)
                 @php
                     // Handle both single string and JSON array formats
                     if (is_string($jadwal->foto_perbaikan)) {
                         // Try to decode as JSON first
                         $fotoHasilPerbaikan = json_decode($jadwal->foto_perbaikan, true);
                         // If not valid JSON, treat as single file path
                         if (json_last_error() !== JSON_ERROR_NONE) {
                             $fotoHasilPerbaikan = [$jadwal->foto_perbaikan];
                         }
                     } else {
                         $fotoHasilPerbaikan = $jadwal->foto_perbaikan;
                     }
                 @endphp
                 @if($fotoHasilPerbaikan && count($fotoHasilPerbaikan) > 0)
                 <div class="photo-section">
                     <h5 class="section-title">Foto Hasil Perbaikan :</h5>
                     <div class="photo-grid">
                         @foreach($fotoHasilPerbaikan as $index => $foto)
                             @php
                                 $imagePath = storage_path('app/public/' . $foto);
                                 $imageData = '';
                                 $mimeType = '';
                                 
                                 if (file_exists($imagePath)) {
                                     $imageData = base64_encode(file_get_contents($imagePath));
                                     $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                                     $mimeType = 'image/' . ($extension === 'jpg' ? 'jpeg' : $extension);
                                 }
                             @endphp
                             @if($imageData)
                             <div class="photo-item">
                                 <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Foto Hasil Perbaikan {{ $index + 1 }}" style="max-width: 200px; max-height: 150px;">
                                 <div class="photo-caption">Foto Hasil Perbaikan {{ $index + 1 }}</div>
                             </div>
                             @endif
                         @endforeach
                     </div>
                 </div>
                 @endif
             @endif
    @endforeach

</body>
</html>
