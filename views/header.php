<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Kingdom</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <div class="header-content">
        <h1>Animal Kingdom</h1>
        <?php $user = getUserData(); if ($user): ?>
            <div class="user-info">
                Logged-in: <?php echo htmlspecialchars($user['family_name'] . ' ' . $user['surname'] . ' (' . $user['username'] . ')'); ?>
            </div>
        <?php endif; ?>
    </div>
    <nav>
        <ul class="horizontal-menu">
            <li><a href="?page=main">Mainpage</a></li>
            <li><a href="?page=images">Images</a></li>
            <li><a href="?page=contact">Contact</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="?page=messages">Messages</a></li>
            <?php endif; ?>
            <li><a href="?page=crud">CRUD</a></li>
            
            <?php if (isLoggedIn()): ?>
                <li><a href="?page=logout">Logout</a></li>
            <?php else: ?>
                <li><a href="?page=login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main class="container">
