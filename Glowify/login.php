<?php
session_start();
include 'db_config.php';

// Redirect to home if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = sha1($_POST['password']); // Hash the password

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(190, 39, 39, 0.1);
        }
        .login-container h3 {
            margin-bottom: 25px;
        }
        .login-container .btn-primary {
            width: 20%;
            margin-left: 5%;
        }
        .login-container .form-label {
            font-weight: bold;
        }
        .login-container .alert {
            margin-top: 300px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center">Login</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label><br>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label><br>
                <input type="password" id="password" name="password" class="form-control" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register Here</a></p>
        </form>
    </div>
</body>
</html>