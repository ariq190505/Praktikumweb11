<?php
// Check database structure for artikel table
echo "=== Database Structure Check ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n\n";

try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=sukses', 'root', '', [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✅ Database connection successful\n\n";
    
    // Check if artikel table exists
    echo "1. Checking artikel table structure...\n";
    $stmt = $pdo->query("DESCRIBE artikel");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Current columns in artikel table:\n";
    foreach ($columns as $column) {
        echo "  - {$column['Field']} ({$column['Type']}) {$column['Null']} {$column['Key']}\n";
    }
    
    // Check if slug column exists
    $hasSlug = false;
    $hasCreatedAt = false;
    $hasUpdatedAt = false;
    
    foreach ($columns as $column) {
        if ($column['Field'] === 'slug') $hasSlug = true;
        if ($column['Field'] === 'created_at') $hasCreatedAt = true;
        if ($column['Field'] === 'updated_at') $hasUpdatedAt = true;
    }
    
    echo "\n2. Column check results:\n";
    echo "  - slug column: " . ($hasSlug ? "✅ EXISTS" : "❌ MISSING") . "\n";
    echo "  - created_at column: " . ($hasCreatedAt ? "✅ EXISTS" : "❌ MISSING") . "\n";
    echo "  - updated_at column: " . ($hasUpdatedAt ? "✅ EXISTS" : "❌ MISSING") . "\n";
    
    // Generate SQL to add missing columns
    $alterStatements = [];
    
    if (!$hasSlug) {
        $alterStatements[] = "ALTER TABLE artikel ADD COLUMN slug VARCHAR(255) UNIQUE AFTER judul";
    }
    
    if (!$hasCreatedAt) {
        $alterStatements[] = "ALTER TABLE artikel ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    }
    
    if (!$hasUpdatedAt) {
        $alterStatements[] = "ALTER TABLE artikel ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
    }
    
    if (!empty($alterStatements)) {
        echo "\n3. SQL statements to add missing columns:\n";
        foreach ($alterStatements as $sql) {
            echo "  " . $sql . ";\n";
        }
        
        echo "\n4. Executing ALTER statements...\n";
        foreach ($alterStatements as $sql) {
            try {
                $pdo->exec($sql);
                echo "  ✅ " . $sql . "\n";
            } catch (Exception $e) {
                echo "  ❌ " . $sql . " - Error: " . $e->getMessage() . "\n";
            }
        }
    } else {
        echo "\n3. ✅ All required columns exist!\n";
    }
    
    // Check existing articles and generate slugs if missing
    echo "\n5. Checking existing articles for missing slugs...\n";
    $stmt = $pdo->query("SELECT id, judul, slug FROM artikel WHERE slug IS NULL OR slug = ''");
    $articlesWithoutSlug = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($articlesWithoutSlug)) {
        echo "Found " . count($articlesWithoutSlug) . " articles without slug. Generating slugs...\n";
        
        foreach ($articlesWithoutSlug as $article) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $article['judul'])));
            $slug = preg_replace('/-+/', '-', $slug);
            $slug = trim($slug, '-');
            
            // Make sure slug is unique
            $counter = 1;
            $originalSlug = $slug;
            while (true) {
                $checkStmt = $pdo->prepare("SELECT id FROM artikel WHERE slug = ? AND id != ?");
                $checkStmt->execute([$slug, $article['id']]);
                if ($checkStmt->rowCount() === 0) {
                    break;
                }
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            // Update article with slug
            $updateStmt = $pdo->prepare("UPDATE artikel SET slug = ? WHERE id = ?");
            $updateStmt->execute([$slug, $article['id']]);
            
            echo "  ✅ Article ID {$article['id']}: '{$article['judul']}' -> slug: '{$slug}'\n";
        }
    } else {
        echo "  ✅ All articles have slugs!\n";
    }
    
    // Show final table structure
    echo "\n6. Final table structure:\n";
    $stmt = $pdo->query("DESCRIBE artikel");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($columns as $column) {
        echo "  - {$column['Field']} ({$column['Type']}) {$column['Null']} {$column['Key']}\n";
    }
    
    // Show sample articles with slugs
    echo "\n7. Sample articles with slugs:\n";
    $stmt = $pdo->query("SELECT id, judul, slug FROM artikel ORDER BY id DESC LIMIT 5");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($articles as $article) {
        echo "  - ID {$article['id']}: '{$article['judul']}' -> slug: '{$article['slug']}'\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    
    if (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "\n🚨 MySQL is not running!\n";
        echo "Please start MySQL in XAMPP Control Panel.\n";
    }
}

echo "\n=== Check Complete ===\n";
?>
