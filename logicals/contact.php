<?php
$error = '';
$success = '';
$submittedData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Server-side validation
    $name = trim($_POST['name'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($message)) {
        $error = 'All fields are required (Server validation failed).';
    } else if (strlen($message) < 10) {
        $error = 'Message must be at least 10 characters long.';
    } else {
        $sender_id = isLoggedIn() ? $_SESSION['user_id'] : null;
        $sender_name = $name;
        
        $stmt = $db->prepare("INSERT INTO messages (sender_id, sender_name, message) VALUES (:sender_id, :sender_name, :message)");
        if ($stmt->execute([
            ':sender_id' => $sender_id,
            ':sender_name' => $sender_name,
            ':message' => $message
        ])) {
            $submittedData = [
                'name' => $sender_name,
                'message' => $message,
                'time' => date('Y-m-d H:i:s')
            ];
        } else {
            $error = 'Failed to send message. Please try again later.';
        }
    }
}
?>
