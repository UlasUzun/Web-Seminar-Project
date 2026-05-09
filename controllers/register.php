<?php
require_once 'includes/db.php';

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

require_once VIEW_PATH . 'header.php';
?>

<div class="card" style="max-width: 500px; margin: 0 auto;">
    <h2>Register</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" action="?page=register">
        <div class="form-group">
            <label for="family_name">Family Name (Last Name)</label>
            <input type="text" id="family_name" name="family_name" required>
        </div>
        <div class="form-group">
            <label for="surname">Surname (First Name)</label>
            <input type="text" id="surname" name="surname" required>
        </div>
        <div class="form-group">
            <label for="username">Login Name (Username)</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    
    <p style="margin-top: 1rem; text-align: center;">
        Already have an account? <a href="?page=login" style="color: var(--primary);">Login here</a>.
    </p>
</div>

<?php
require_once VIEW_PATH . 'footer.php';
?>
