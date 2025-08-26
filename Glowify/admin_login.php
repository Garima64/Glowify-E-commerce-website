<?php include 'includes/header.php'; ?>
<?php
include 'db_config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'Admin' && $password === 'admin-1') {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid username or password.</div>";
    }
}
?>
<div class="container mt-5">
    <h2>Admin Login</h2>
    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>
<?php include 'includes/footer.php'; ?>
