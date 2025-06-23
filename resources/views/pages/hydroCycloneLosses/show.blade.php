@extends('layouts.header')

@section('konten')
<div class="container-lg mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Hydrocyclone Losses</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/'.$hydroCycloneLosses->image_HydroCycloneLosses) }}" alt="Sample Hydrocyclone" class="img-fluid mb-3" style="max-height: 300px;">
                    <h5>Gambar Sample</h5>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Shift</th>
                            <td>{{ $hydroCycloneLosses->shift }}</td>
                        </tr>
                        <tr>
                            <th>Nama Operator</th>
                            <td>{{ $hydroCycloneLosses->nama_operator }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h5>Data Pengukuran</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Sample Weight</th>
                            <td>{{ $hydroCycloneLosses->sample_weight }}</td>
                        </tr>
                        <tr>
                            <th>Whole Kernel</th>
                            <td>{{ $hydroCycloneLosses->whole_kernel }}</td>
                        </tr>
                        <tr>
                            <th>Broken Kernel</th>
                            <td>{{ $hydroCycloneLosses->broken_kernel }}</td>
                        </tr>
                        <tr>
                            <th>Whole Nut</th>
                            <td>{{ $hydroCycloneLosses->whole_nut }}</td>
                        </tr>
                        <tr>
                            <th>Broken Nut</th>
                            <td>{{ $hydroCycloneLosses->broken_nut }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="/hydrocyclone-losses" class="btn btn-secondary">
                    <span class="svg-icon svg-icon-muted svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14 6H9.60001V8H14C15.1 8 16 8.9 16 10V21C16 21.6 16.4 22 17 22C17.6 22 18 21.6 18 21V10C18 7.8 16.2 6 14 6Z" fill="black"/>
                            <path opacity="0.3" d="M9.60002 12L5.3 7.70001C4.9 7.30001 4.9 6.69999 5.3 6.29999L9.60002 2V12Z" fill="black"/>
                        </svg>
                    </span>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
