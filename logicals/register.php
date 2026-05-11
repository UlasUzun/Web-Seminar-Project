<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $family_name = trim($_POST['family_name']);
    $surname = trim($_POST['surname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($family_name) || empty($surname) || empty($username) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        // Check if username exists
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Username already taken.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO users (family_name, surname, username, password) VALUES (:family_name, :surname, :username, :password)");
            if ($stmt->execute([
                ':family_name' => $family_name,
                ':surname' => $surname,
                ':username' => $username,
                ':password' => $hashed
            ])) {
                $success = 'Registration successful! You can now login.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
