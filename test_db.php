<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Booth;
use App\Models\Session;
use App\Models\Exhibition;

try {
    // 1. Create an Exhibition (Host Here)
    $exhibition = Exhibition::create([
        'title' => 'Test Exhibition 2026',
        'description' => 'A test exhibition created via validation script.',
        'creator_id' => 'system_test',
        'hall' => '4' // Diamond Vault
    ]);
    echo "Exhibition created successfully with ID: " . $exhibition->_id . "\n";

    // 2. Create a Session
    $session = Session::create([
        'title' => 'Test Keynote',
        'time' => '10:00 AM',
        'exhibition_id' => (string)$exhibition->_id,
        'video_url' => 'https://youtube.com/test'
    ]);
    echo "Session created successfully with ID: " . $session->_id . "\n";

    // 3. Create a Booth
    $booth = Booth::create([
        'title' => 'Test Booth Alpha',
        'description' => 'A futuristic test booth.',
        'exhibition_id' => (string)$exhibition->_id,
        'image_url' => 'https://example.com/image.jpg'
    ]);
    echo "Booth created successfully with ID: " . $booth->_id . "\n";

    echo "ALL FEATURES TESTED SUCCESSFULLY!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
