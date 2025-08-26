<?php include 'includes/header.php'; ?>
<?php
include 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Admin (email_id, username, password) VALUES ('$email', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Admin registered successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<div class="container mt-5">
    <h2>Admin Signup</h2>
    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Signup</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
