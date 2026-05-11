<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Login</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="?login">
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
        Don't have an account? <a href="?register" style="color: var(--primary);">Register here</a>.
    </p>
</div>
