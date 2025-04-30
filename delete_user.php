<?php
session_start();

include 'config/database.php';
$obj = new Query();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $deleteResult = $obj->deleteData('users', $userId);

    if ($deleteResult) {
        $_SESSION['success'] = "User deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }
    header("Location: index.php");
    exit;
} else {
    echo "<p>No user ID provided.</p>";
}

header('Location: index.php');
exit;
