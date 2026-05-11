<?php
require_once 'includes/db.php';

$animalsFile = __DIR__ . '/animals.txt';

if (file_exists($animalsFile)) {
    $lines = file($animalsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    $stmt = $db->prepare("INSERT IGNORE INTO animals (id, aname, species) VALUES (:id, :aname, :species)");
    
    $isFirstLine = true;
    foreach ($lines as $line) {
        if ($isFirstLine) {
            $isFirstLine = false;
            continue; // Skip header
        }
        $parts = explode("\t", $line);
        if (count($parts) >= 3) {
            $stmt->execute([
                ':id' => trim($parts[0]),
                ':aname' => trim($parts[1]),
                ':species' => trim($parts[2])
            ]);
        }
    }
    echo "Animals imported successfully.\n";
} else {
    echo "animals.txt not found at $animalsFile\n";
}
