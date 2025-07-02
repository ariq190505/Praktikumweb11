<?php
// Check MySQL connection and provide troubleshooting
echo "=== MySQL Connection Check ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n";

// Test 1: Check if MySQL port is open
echo "\n1. Checking MySQL port 3306...\n";
$connection = @fsockopen('localhost', 3306, $errno, $errstr, 5);
if ($connection) {
    echo "   ✅ MySQL port 3306 is open\n";
    fclose($connection);
} else {
    echo "   ❌ MySQL port 3306 is closed\n";
    echo "   Error: $errstr ($errno)\n";
}

// Test 2: Try to connect to MySQL
echo "\n2. Testing MySQL connection...\n";
try {
    $pdo = new PDO('mysql:host=localhost;port=3306', 'root', '', [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "   ✅ MySQL connection successful\n";
    
    // Test 3: Check if database exists
    echo "\n3. Checking database 'sukses'...\n";
    $stmt = $pdo->query("SHOW DATABASES LIKE 'sukses'");
    if ($stmt->rowCount() > 0) {
        echo "   ✅ Database 'sukses' exists\n";
        
        // Test 4: Check if artikel table exists
        echo "\n4. Checking table 'artikel'...\n";
        $pdo->exec("USE sukses");
        $stmt = $pdo->query("SHOW TABLES LIKE 'artikel'");
        if ($stmt->rowCount() > 0) {
            echo "   ✅ Table 'artikel' exists\n";
            
            // Test 5: Count articles
            echo "\n5. Counting articles...\n";
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM artikel");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "   📊 Total articles: " . $result['count'] . "\n";
        } else {
            echo "   ❌ Table 'artikel' does not exist\n";
            echo "   💡 You need to create the artikel table\n";
        }
    } else {
        echo "   ❌ Database 'sukses' does not exist\n";
        echo "   💡 You need to create the database 'sukses'\n";
    }
    
} catch (PDOException $e) {
    echo "   ❌ MySQL connection failed\n";
    echo "   Error: " . $e->getMessage() . "\n";
    
    if (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "\n🚨 MySQL is not running!\n";
        echo "\nTroubleshooting steps:\n";
        echo "1. Open XAMPP Control Panel\n";
        echo "2. Click 'Start' button next to MySQL\n";
        echo "3. Wait for MySQL status to turn green\n";
        echo "4. Run this script again\n";
        
        // Try to start MySQL automatically (Windows)
        echo "\n🔧 Attempting to start MySQL automatically...\n";
        $output = [];
        $return_var = 0;
        
        // Try different methods to start MySQL
        $commands = [
            'net start mysql',
            'sc start mysql',
            '"C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone --console',
        ];
        
        foreach ($commands as $cmd) {
            echo "Trying: $cmd\n";
            exec($cmd . ' 2>&1', $output, $return_var);
            if ($return_var === 0) {
                echo "✅ MySQL started successfully!\n";
                break;
            } else {
                echo "❌ Command failed: " . implode("\n", $output) . "\n";
                $output = []; // Reset for next command
            }
        }
    }
}

echo "\n=== Check Complete ===\n";

// Provide next steps
echo "\n📋 Next Steps:\n";
echo "1. If MySQL is not running, start it in XAMPP Control Panel\n";
echo "2. If database 'sukses' doesn't exist, create it in phpMyAdmin\n";
echo "3. If table 'artikel' doesn't exist, run the migration\n";
echo "4. Test the Vue.js application: http://localhost/lab8_vuejs/\n";
?>
