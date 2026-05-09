<?php
require_once 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['family_name'] = $user['family_name'];
            $_SESSION['surname'] = $user['surname'];
            
            header("Location: ?page=main");
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    }
}

require_once VIEW_PATH . 'header.php';
?>

<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Login</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="?page=login">
        <div class="form-group">
            <label for="username">Login Name (Username)</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    
    <p style="margin-top: 1rem; text-align: center;">
        Don't have an account? <a href="?page=register" style="color: var(--primary);">Register here</a>.
    </p>
</div>

<?php
require_once VIEW_PATH . 'footer.php';
?>
