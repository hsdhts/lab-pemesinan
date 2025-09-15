@extends('layouts.tabel')

@section('tableHead')
    <th>No</th>
    <th>Mesin</th>
    <th>Stasiun</th>
    <th>Gambar Mesin</th>
    <th>Aksi</th>
@endsection

@section('konten')
<!-- Custom Search Bar -->
<div class="d-flex justify-content-end mb-3 mt-5">
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" id="customSearch" placeholder="Cari mesin/stasiun...">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>
</div>

@parent
@endsection

@section('data')
<script>
    var table = $('#tabelTemplate').DataTable({
        columnDefs: [
            {
                class:'all',
                target: 1
            },
            {
                responsivePriority:11005,
                class:'min-tablet-l',
                target:[-1,-2]
            }
        ],
        pageLength: 25,
        responsive: true,
        processing: true,
        dom:'<"top"l>rtip<"bottom"><"clear">',
        serverSide: true,
        ajax: "/mesin",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_mesin', name: 'nama_mesin', searchable: true },
            {
                data: 'stasiun',
                name: 'stasiun',
                searchable: true,
                render: function(data, type, full, meta) {
                    if (data && data !== 'Belum Ditentukan' && data !== '') {
                        return '<span class="badge badge-info">' + data + '</span>';
                    } else {
                        return '<span class="badge badge-secondary">Belum Ditentukan</span>';
                    }
                }
            },
            {
                data: 'mesin_image',
                name: 'mesin_image',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset("storage") }}/'+data+'" alt="Gambar Mesin" style="max-width: 100px; max-height: 100px; cursor: pointer;" onclick="setModalImage(\'' + data + '\', \'gambarMesinModal\')">';
                }
            },
           
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
        ]
    });

    // Custom search functionality with debouncing
    let searchTimeout;
    $('#customSearch').on('keyup', function() {
        var searchValue = this.value;
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        // Add visual feedback
        $(this).addClass('searching');
        
        // Debounce search to improve performance
        searchTimeout = setTimeout(function() {
            table.search(searchValue).draw();
            $('#customSearch').removeClass('searching');
        }, 300);
    });
    
    // Clear search functionality
    $('#customSearch').on('input', function() {
        if (this.value === '') {
            table.search('').draw();
        }
    });

    function setModalImage(src, modalId) {
        document.getElementById(modalId + 'Image').src = '{{ asset('storage') }}/' + src;
        $('#' + modalId).modal('show'); 
    }
</script>

<!-- Modal Gambar Mesin -->
<div class="modal fade" id="gambarMesinModal" tabindex="-1" role="dialog" aria-labelledby="gambarMesinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gambarMesinModalLabel">Gambar Mesin</h5>
            </div>
            <div class="modal-body">
                <img id="gambarMesinModalImage" src="" alt="Gambar Mesin" class="img-fluid">
            </div>
        </div>
    </div>
</div>


@endsection
