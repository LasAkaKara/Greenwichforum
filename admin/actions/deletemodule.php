<?php
session_start();

if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../../login.php');
    exit();
}

try {
    include '../includes/DatabaseConnector.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['module_id'])) {
        // Soft delete the module
        $sql = 'UPDATE modules SET isDeleted = 1 WHERE module_id = :module_id';
        query($pdo, $sql, ['module_id' => $_POST['module_id']]);
    }
    // Redirect to manage_modules page
    header('Location: ../manage_modules.php');
    exit();
} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
} 