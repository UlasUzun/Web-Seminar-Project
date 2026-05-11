<?php if ($submittedData): ?>
    <div class="card">
        <h2>Message Sent Successfully</h2>
        <div class="alert alert-success">Your message has been received by the owner.</div>
        <h3>Submitted Data (5th Page View)</h3>
        <table style="max-width: 600px;">
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($submittedData['name']); ?></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><?php echo nl2br(htmlspecialchars($submittedData['message'])); ?></td>
            </tr>
            <tr>
                <th>Time Sent</th>
                <td><?php echo htmlspecialchars($submittedData['time']); ?></td>
            </tr>
        </table>
        <div style="margin-top: 1rem;">
            <a href="?contact" class="btn btn-secondary">Send Another Message</a>
        </div>
    </div>
<?php else: ?>
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h2>Contact Us</h2>
        <p>Send a message to the page owner.</p>
        
        <?php if ($error): ?>
            <div class="alert alert-error" id="server-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <div class="alert alert-error" id="client-error" style="display: none;"></div>

        <form method="post" action="?contact" id="contactForm">
            <div class="form-group">
                <label for="name">Your Name</label>
                <?php 
                $defaultName = '';
                if (isLoggedIn()) {
                    $user = getUserData();
                    $defaultName = $user['family_name'] . ' ' . $user['surname'];
                }
                ?>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($defaultName); ?>">
            </div>
            <div class="form-group">
                <label for="message">Message (Min. 10 characters)</label>
                <textarea id="message" name="message" rows="5"></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const message = document.getElementById('message').value.trim();
            const errorDiv = document.getElementById('client-error');
            
            let errors = [];
            
            // Client-side validation
            if (!name) {
                errors.push("Name cannot be empty.");
            }
            if (!message) {
                errors.push("Message cannot be empty.");
            } else if (message.length < 10) {
                errors.push("Message must be at least 10 characters long.");
            }
            
            if (errors.length > 0) {
                e.preventDefault(); // Prevent form submission
                errorDiv.innerHTML = errors.join("<br>");
                errorDiv.style.display = 'block';
                
                const serverError = document.getElementById('server-error');
                if(serverError) serverError.style.display = 'none';
            }
        });
    </script>
<?php endif; ?>
