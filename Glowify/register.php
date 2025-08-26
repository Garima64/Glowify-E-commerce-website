<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = sha1($_POST['password']);
    $confirm_password = sha1($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);

        // Check if prepare() failed
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            $insert_query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);

            // Check if prepare() failed
            if ($insert_stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $insert_stmt->bind_param("sss", $name, $email, $password);
            $insert_stmt->execute();

            $_SESSION['user_id'] = $insert_stmt->insert_id;
            $_SESSION['user_name'] = $name;
            header('Location: index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Register</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="" method="post" class="w-50 mx-auto">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>