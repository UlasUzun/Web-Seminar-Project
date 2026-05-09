<?php
require_once 'includes/db.php';

$action = $_GET['action'] ?? 'read';
$error = '';
$success = '';

// Handle Delete
if ($action === 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM animals WHERE id = :id");
    if ($stmt->execute([':id' => $_GET['id']])) {
        header("Location: ?page=crud&success=deleted");
        exit;
    } else {
        $error = "Failed to delete.";
    }
}

// Handle Form Submissions (Create / Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aname = trim($_POST['aname'] ?? '');
    $species = trim($_POST['species'] ?? '');

    if (empty($aname) || empty($species)) {
        $error = "All fields are required.";
    } else {
        if ($action === 'create') {
            $stmt = $db->prepare("INSERT INTO animals (aname, species) VALUES (:aname, :species)");
            if ($stmt->execute([':aname' => $aname, ':species' => $species])) {
                header("Location: ?page=crud&success=created");
                exit;
            } else {
                $error = "Failed to create.";
            }
        } elseif ($action === 'update' && isset($_GET['id'])) {
            $stmt = $db->prepare("UPDATE animals SET aname = :aname, species = :species WHERE id = :id");
            if ($stmt->execute([':aname' => $aname, ':species' => $species, ':id' => $_GET['id']])) {
                header("Location: ?page=crud&success=updated");
                exit;
            } else {
                $error = "Failed to update.";
            }
        }
    }
}

// Success messages from redirect
if (isset($_GET['success'])) {
    if ($_GET['success'] === 'created') $success = "Animal created successfully.";
    if ($_GET['success'] === 'updated') $success = "Animal updated successfully.";
    if ($_GET['success'] === 'deleted') $success = "Animal deleted successfully.";
}

require_once VIEW_PATH . 'header.php';
?>

<div class="card">
    <h2>Animals (CRUD Application)</h2>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <?php if ($action === 'read'): ?>
        <div style="margin-bottom: 1rem;">
            <a href="?page=crud&action=create" class="btn">Add New Animal</a>
        </div>
        
        <?php
        $stmt = $db->query("SELECT * FROM animals ORDER BY id DESC LIMIT 100"); // Limit to 100 to avoid huge tables if needed, though 200 is fine
        $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <div style="overflow-x: auto; max-height: 500px; overflow-y: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($animals as $animal): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($animal['id']); ?></td>
                            <td><?php echo htmlspecialchars($animal['aname']); ?></td>
                            <td><?php echo htmlspecialchars($animal['species']); ?></td>
                            <td>
                                <a href="?page=crud&action=update&id=<?php echo $animal['id']; ?>" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                                <a href="?page=crud&action=delete&id=<?php echo $animal['id']; ?>" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;" onclick="return confirm('Are you sure you want to delete this animal?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($action === 'create' || $action === 'update'): ?>
        <?php
        $currentName = '';
        $currentSpecies = '';
        
        if ($action === 'update' && isset($_GET['id'])) {
            $stmt = $db->prepare("SELECT * FROM animals WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            $animal = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($animal) {
                $currentName = $animal['aname'];
                $currentSpecies = $animal['species'];
            }
        }
        ?>
        
        <div style="max-width: 500px;">
            <h3><?php echo $action === 'create' ? 'Create New Animal' : 'Update Animal'; ?></h3>
            <form method="post" action="?page=crud&action=<?php echo $action; ?><?php echo isset($_GET['id']) ? '&id=' . $_GET['id'] : ''; ?>">
                <div class="form-group">
                    <label for="aname">Name</label>
                    <input type="text" id="aname" name="aname" value="<?php echo htmlspecialchars($currentName); ?>" required>
                </div>
                <div class="form-group">
                    <label for="species">Species</label>
                    <input type="text" id="species" name="species" value="<?php echo htmlspecialchars($currentSpecies); ?>" required>
                </div>
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn"><?php echo $action === 'create' ? 'Save' : 'Update'; ?></button>
                    <a href="?page=crud" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php
require_once VIEW_PATH . 'footer.php';
?>
