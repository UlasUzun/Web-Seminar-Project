<?php
$error = '';
$success = '';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLoggedIn()) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $uploadPath = __DIR__ . '/../uploads/' . $filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $stmt = $db->prepare("INSERT INTO images (user_id, filename) VALUES (:user_id, :filename)");
                $stmt->execute([
                    ':user_id' => $_SESSION['user_id'],
                    ':filename' => $filename
                ]);
                $success = 'Image uploaded successfully!';
            } else {
                $error = 'Failed to save the uploaded image.';
            }
        } else {
            $error = 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
        }
    } else {
        $error = 'Please select a valid image file.';
    }
}

// Fetch images
$stmt = $db->query("SELECT i.filename, i.created_at, u.username FROM images i JOIN users u ON i.user_id = u.id ORDER BY i.created_at DESC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
