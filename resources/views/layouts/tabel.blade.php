@extends('layouts.header')

@section('customCss')
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>

    <style>
    .tombolAksi{
    min-width: 180px;
    }.dataTables_filter input[type="search"]{
      background-color: white;
    }

    .dataTables_filter input[type="search"]:focus{
      background-color: #e0e0e0;
    }

    .dataTables_wrapper .dataTables_length select{
      background-color: white !important;
    }
    .dataTables_processing{
            z-index: 5;
    }
    
    /* Custom search styling */
    .searching {
        background-color: #fff3cd !important;
        border-color: #ffeaa7 !important;
        transition: all 0.3s ease;
    }
    
    #customSearch {
        transition: all 0.3s ease;
    }
    
    #customSearch:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    </style>

@endsection

@section('konten')
    
<div class="my-3">

        
    <table id="tabelTemplate" class="table align-middle fs-6 table-row-bordered table-row-gray-400 gs-7">
        <thead>
                <tr class="fw-bolder fs-6 text-gray-800">
                    @yield('tableHead')
                </tr>
        </thead>
        
    </table>

</div>

@endsection


@section('customJs')

@yield('data')
    
@endsection