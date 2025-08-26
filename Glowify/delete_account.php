<?php
session_start();
include 'db_config.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Delete the user's account
$user_id = $_SESSION['user_id'];
$query = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Destroy the session and redirect to the home page
session_destroy();
header('Location: index.php');
exit;
?>