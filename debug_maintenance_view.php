<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mesin;

$mesin = Mesin::with(['maintenance', 'form'])->find(3);

if ($mesin) {
    echo "=== DEBUG MAINTENANCE VIEW DATA ===\n";
    echo "Mesin: " . $mesin->nama_mesin . "\n";
    echo "Mesin ID: " . $mesin->id . "\n";
    
    $maintenance = $mesin->maintenance;
    echo "\nMaintenance Collection Type: " . get_class($maintenance) . "\n";
    echo "Maintenance Count: " . $maintenance->count() . "\n";
    echo "Is Empty: " . ($maintenance->isEmpty() ? 'true' : 'false') . "\n";
    echo "Is Not Empty: " . ($maintenance->isNotEmpty() ? 'true' : 'false') . "\n";
    
    echo "\n=== MAINTENANCE DATA ===\n";
    foreach($maintenance as $m) {
        echo "ID: " . $m->id . "\n";
        echo "Nama: " . $m->nama_maintenance . "\n";
        echo "Warna: " . $m->warna . "\n";
        echo "Mesin ID: " . $m->mesin_id . "\n";
        echo "Created At: " . $m->created_at . "\n";
        echo "Deleted At: " . ($m->deleted_at ?? 'null') . "\n";
        echo "---\n";
    }
    
    $form = $mesin->form;
    echo "\n=== FORM DATA ===\n";
    echo "Form Collection Type: " . get_class($form) . "\n";
    echo "Form Count: " . $form->count() . "\n";
    
} else {
    echo "Mesin dengan ID 3 tidak ditemukan\n";
}