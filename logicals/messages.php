<?php
if (!isLoggedIn()) {
    header("Location: ?login");
    exit;
}

// Fetch messages
$stmt = $db->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
