<?php
// Petit script pour créer la base `forge` via la configuration Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::statement("CREATE DATABASE IF NOT EXISTS `forge` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "CREATED\n";
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
