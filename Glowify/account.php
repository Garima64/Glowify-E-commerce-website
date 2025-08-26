<?php
session_start();
include 'db_config.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2>My Account</h2>
        <p><strong>Name:</strong> <?= $user['name'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Registration Date:</strong> <?= $user['registration_time'] ?></p>
        <form method="POST" action="logout.php" class="mt-3">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
        <br>
        <form method="POST" action="delete_account.php" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>

    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>