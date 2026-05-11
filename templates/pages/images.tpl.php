<div class="card">
    <h2>Image Gallery</h2>
    
    <?php if (isLoggedIn()): ?>
        <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid var(--border);">
            <h3>Upload New Image</h3>
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <form method="post" action="?images" enctype="multipart/form-data" style="flex-direction: row; align-items: flex-end;">
                <div class="form-group" style="flex: 1;">
                    <label for="image">Choose Image (JPG, PNG, GIF)</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn">Upload</button>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Please <a href="?login" style="color: var(--primary);">log in</a> to upload images.</div>
    <?php endif; ?>

    <div class="gallery">
        <?php if (count($images) > 0): ?>
            <?php foreach ($images as $img): ?>
                <div class="gallery-item">
                    <img src="uploads/<?php echo htmlspecialchars($img['filename']); ?>" alt="Uploaded by <?php echo htmlspecialchars($img['username']); ?>">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); color: white; padding: 0.5rem; font-size: 0.8rem; text-align: center;">
                        By: <?php echo htmlspecialchars($img['username']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images have been uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>
