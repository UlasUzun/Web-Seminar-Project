<?php
require_once 'config.php';

// INFINITYFREE MYSQL DATABASE SETTINGS
// You need to find these details in your InfinityFree Control Panel -> MySQL Databases
$db_host = 'sql309.infinityfree.com'; // usually looks like 'sql123.epizy.com'
$db_user = 'if0_41829598'; // usually looks like 'epiz_12345678'
$db_pass = 'xmJfBWK7RUT'; // your vPanel password or custom DB password
$db_name = 'if0_41829598_animals'; // usually looks like 'epiz_12345678_animals'

try {
    // If you are testing locally on XAMPP and haven't set up MySQL, you can temporarily 
    // keep using SQLite by commenting out the MySQL lines and uncommenting the SQLite line below.
    // For InfinityFree, MUST use the MySQL line below:
    
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    //$db = new PDO('sqlite:' . __DIR__ . '/../data/database.sqlite');
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables if they don't exist
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        family_name VARCHAR(255) NOT NULL,
        surname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender_id INT NULL,
        sender_name VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        filename VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(user_id) REFERENCES users(id)
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS animals (
        id INT PRIMARY KEY,
        aname VARCHAR(255) NOT NULL,
        species VARCHAR(255) NOT NULL
    )");

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
