<div class="card" style="max-width: 500px; margin: 0 auto;">
    <h2>Register</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" action="?register">
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
        Already have an account? <a href="?login" style="color: var(--primary);">Login here</a>.
    </p>
</div>
