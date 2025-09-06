<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mesin;

$mesin = Mesin::with('maintenance')->find(3);

if ($mesin) {
    echo "Mesin: " . $mesin->nama_mesin . "\n";
    echo "Jumlah maintenance: " . $mesin->maintenance->count() . "\n";
    
    foreach($mesin->maintenance as $m) {
        echo "Maintenance: " . $m->nama_maintenance . " - Warna: " . $m->warna . "\n";
    }
} else {
    echo "Mesin dengan ID 3 tidak ditemukan\n";
}