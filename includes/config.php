<?php
// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to get logged in user data
function getUserData() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'family_name' => $_SESSION['family_name'],
            'surname' => $_SESSION['surname'],
            'username' => $_SESSION['username']
        ];
    }
    return null;
}
