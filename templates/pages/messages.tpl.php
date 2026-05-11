<div class="card">
    <h2>Messages</h2>
    <p>All messages sent to the page owner.</p>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Sender</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($messages) > 0): ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td style="white-space: nowrap;"><?php echo htmlspecialchars($msg['created_at']); ?></td>
                            <td>
                                <?php 
                                if ($msg['sender_id'] === null) {
                                    echo "Guest (" . htmlspecialchars($msg['sender_name']) . ")";
                                } else {
                                    echo htmlspecialchars($msg['sender_name']);
                                }
                                ?>
                            </td>
                            <td><?php echo nl2br(htmlspecialchars($msg['message'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
