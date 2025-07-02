<?php
// Test connection to CodeIgniter
echo "=== CodeIgniter Connection Test ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n";
echo "PHP Version: " . phpversion() . "\n";

// Test 1: Check if CI4 directory exists
$ci4Path = __DIR__;
echo "\nCI4 Path: " . $ci4Path . "\n";
echo "CI4 Directory exists: " . (is_dir($ci4Path) ? "YES" : "NO") . "\n";

// Test 2: Check if public directory exists
$publicPath = $ci4Path . '/public';
echo "Public Directory exists: " . (is_dir($publicPath) ? "YES" : "NO") . "\n";

// Test 3: Check if index.php exists
$indexPath = $publicPath . '/index.php';
echo "Index.php exists: " . (file_exists($indexPath) ? "YES" : "NO") . "\n";

// Test 4: Check if app directory exists
$appPath = $ci4Path . '/app';
echo "App Directory exists: " . (is_dir($appPath) ? "YES" : "NO") . "\n";

// Test 5: Check if Post controller exists
$postControllerPath = $appPath . '/Controllers/Post.php';
echo "Post Controller exists: " . (file_exists($postControllerPath) ? "YES" : "NO") . "\n";

// Test 6: Check if .env file exists
$envPath = $ci4Path . '/.env';
echo "Environment file exists: " . (file_exists($envPath) ? "YES" : "NO") . "\n";

// Test 7: Try to access the URL
echo "\n=== URL Access Test ===\n";
$testUrls = [
    'http://localhost/ci4/public',
    'http://localhost/ci4/public/post',
    'http://127.0.0.1/ci4/public',
    'http://127.0.0.1/ci4/public/post'
];

foreach ($testUrls as $url) {
    echo "Testing: $url\n";
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 10,
            'method' => 'GET',
            'header' => "Accept: application/json\r\n"
        ]
    ]);
    
    $result = @file_get_contents($url, false, $context);
    
    if ($result !== false) {
        echo "  Status: SUCCESS\n";
        echo "  Response length: " . strlen($result) . " bytes\n";
        if (strlen($result) < 500) {
            echo "  Response: " . substr($result, 0, 200) . "...\n";
        }
    } else {
        echo "  Status: FAILED\n";
        $error = error_get_last();
        if ($error) {
            echo "  Error: " . $error['message'] . "\n";
        }
    }
    echo "\n";
}

echo "=== Test Complete ===\n";
?>
