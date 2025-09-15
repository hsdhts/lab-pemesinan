# Image Optimization System

Sistem optimasi gambar yang telah diimplementasikan untuk meningkatkan performa aplikasi dalam menangani penyimpanan dan loading gambar.

## Fitur yang Telah Diimplementasikan

### 1. Image Optimization Service
- **Lokasi**: `app/Services/ImageOptimizationService.php`
- **Fitur**:
  - Kompresi gambar otomatis dengan kualitas yang dapat disesuaikan
  - Resize gambar dengan mempertahankan aspect ratio
  - Konversi format gambar ke JPEG untuk ukuran file yang lebih kecil
  - Pembuatan thumbnail otomatis
  - Struktur folder terorganisir berdasarkan tanggal (YYYY/MM)
  - Penghapusan gambar dan thumbnail secara bersamaan

### 2. Controller Updates
- **JadwalController**: Menggunakan service optimasi untuk `foto_perbaikan`
- **UpdateMaintenanceController**: Menggunakan service optimasi untuk `foto_kerusakan`
- Semua upload gambar sekarang melalui proses optimasi otomatis

### 3. Image Helper
- **Lokasi**: `app/Helpers/ImageHelper.php`
- **Fitur**:
  - Lazy loading HTML generator
  - Responsive image dengan multiple sizes
  - Placeholder image untuk loading state
  - Format file size helper

### 4. Frontend Lazy Loading
- **Lokasi**: `public/js/lazy-loading.js`
- **Fitur**:
  - Intersection Observer API untuk lazy loading
  - Fallback untuk browser lama
  - Auto-detection untuk konten dinamis
  - Loading states dan error handling
  - CSS transitions untuk smooth loading

### 5. Image Cleanup Command
- **Lokasi**: `app/Console/Commands/CleanupUnusedImages.php`
- **Usage**: 
  ```bash
  php artisan images:cleanup --dry-run  # Preview apa yang akan dihapus
  php artisan images:cleanup            # Hapus gambar yang tidak terpakai
  ```

### 6. Middleware Optimization
- **Lokasi**: `app/Http/Middleware/OptimizeImages.php`
- **Fitur**:
  - Auto-inject lazy loading attributes
  - Responsive image classes
  - WebP support detection

## Konfigurasi

### Image Quality Settings
- **Default**: 85% (balance antara kualitas dan ukuran file)
- **Thumbnail**: 80%
- **High Quality**: 95%
- **Low Quality**: 60%

### Image Size Limits
- **Large**: 1200x800px
- **Medium**: 800x600px
- **Small**: 400x300px
- **Thumbnail**: 300x200px

### Folder Structure
```
storage/app/public/
├── foto_perbaikan/
│   ├── 2025/
│   │   ├── 01/
│   │   │   ├── 15_143022_abc123.jpg
│   │   │   └── thumb_15_143022_abc123.jpg
│   │   └── 02/
│   └── 2024/
└── maintenance_photos/
    ├── 2025/
    │   ├── 01/
    │   └── 02/
    └── 2024/
```

## Cara Penggunaan

### 1. Upload Gambar di Controller
```php
use App\Services\ImageOptimizationService;

$imageService = new ImageOptimizationService();
$imagePath = $imageService->optimizeAndStore(
    $request->file('image'),
    'folder_name',
    1200, // max width
    800,  // max height
    85    // quality
);
```

### 2. Menampilkan Gambar dengan Lazy Loading
```php
use App\Helpers\ImageHelper;

// Lazy loading image
echo ImageHelper::lazyImage($imagePath, 'Alt text', ['class' => 'custom-class']);

// Responsive image
echo ImageHelper::responsiveImage($imagePath, 'Alt text');
```

### 3. Menggunakan di Blade Template
```html
<!-- Manual lazy loading -->
<img data-src="{{ Storage::url($imagePath) }}" 
     src="data:image/svg+xml;base64,..." 
     loading="lazy" 
     class="img-fluid lazy-image" 
     alt="Description">

<!-- Dengan helper -->
{!! App\Helpers\ImageHelper::lazyImage($imagePath, 'Description') !!}
```

### 4. Cleanup Gambar Tidak Terpakai
```bash
# Cek gambar yang akan dihapus tanpa menghapus
php artisan images:cleanup --dry-run

# Hapus gambar yang tidak terpakai
php artisan images:cleanup
```

## Performance Benefits

1. **Ukuran File Lebih Kecil**:
   - Kompresi otomatis mengurangi ukuran file hingga 60-80%
   - Format JPEG untuk semua gambar
   - Thumbnail untuk preview cepat

2. **Loading Lebih Cepat**:
   - Lazy loading mengurangi initial page load
   - Progressive loading dengan placeholder
   - Responsive images untuk device yang tepat

3. **Storage Terorganisir**:
   - Folder struktur berdasarkan tanggal
   - Cleanup otomatis untuk gambar tidak terpakai
   - Thumbnail management

4. **SEO Friendly**:
   - Proper alt attributes
   - Loading attributes untuk Core Web Vitals
   - WebP support detection

## Monitoring & Maintenance

### Scheduled Cleanup (Opsional)
Tambahkan ke `app/Console/Kernel.php`:
```php
protected function schedule(Schedule $schedule)
{
    // Cleanup unused images setiap minggu
    $schedule->command('images:cleanup')
             ->weekly()
             ->sundays()
             ->at('02:00');
}
```

### Storage Monitoring
```bash
# Cek ukuran storage
du -sh storage/app/public/foto_perbaikan/
du -sh storage/app/public/maintenance_photos/

# Cek jumlah file
find storage/app/public/ -name "*.jpg" | wc -l
```

## Troubleshooting

### Jika Gambar Tidak Muncul
1. Pastikan symbolic link sudah dibuat: `php artisan storage:link`
2. Cek permission folder storage
3. Pastikan GD extension terinstall

### Jika Lazy Loading Tidak Bekerja
1. Pastikan JavaScript file ter-load
2. Cek browser support untuk Intersection Observer
3. Periksa console untuk error JavaScript

### Performance Issues
1. Monitor ukuran gambar yang di-upload
2. Adjust quality settings jika diperlukan
3. Implementasi CDN untuk static assets