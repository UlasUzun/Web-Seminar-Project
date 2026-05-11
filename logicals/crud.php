<?php
$action = $_GET['action'] ?? 'read';
$error = '';
$success = '';

// Handle Delete
if ($action === 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM animals WHERE id = :id");
    if ($stmt->execute([':id' => $_GET['id']])) {
        header("Location: ?crud&success=deleted");
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
            $maxStmt = $db->query("SELECT MAX(id) FROM animals");
            $maxId = $maxStmt->fetchColumn();
            $newId = $maxId ? $maxId + 1 : 1;
            
            $stmt = $db->prepare("INSERT INTO animals (id, aname, species) VALUES (:id, :aname, :species)");
            if ($stmt->execute([':id' => $newId, ':aname' => $aname, ':species' => $species])) {
                header("Location: ?crud&success=created");
                exit;
            } else {
                $error = "Failed to create.";
            }
        } elseif ($action === 'update' && isset($_GET['id'])) {
            $stmt = $db->prepare("UPDATE animals SET aname = :aname, species = :species WHERE id = :id");
            if ($stmt->execute([':aname' => $aname, ':species' => $species, ':id' => $_GET['id']])) {
                header("Location: ?crud&success=updated");
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
