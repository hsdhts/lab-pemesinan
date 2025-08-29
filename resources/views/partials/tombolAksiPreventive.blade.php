<div class="dropdown">
    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $jadwal->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cog"></i>
        <span class="d-none d-md-inline ms-1">Aksi</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $jadwal->id }}">
        <li>
            <a class="dropdown-item" href="{{ route('preventive.show', $jadwal->id) }}">
                <i class="fas fa-eye text-info me-2"></i>
                Lihat Detail
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('preventive.edit', $jadwal->id) }}">
                <i class="fas fa-edit text-warning me-2"></i>
                Edit
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $jadwal->id }})">
                <i class="fas fa-trash me-2"></i>
                Hapus
            </a>
        </li>
    </ul>
</div>