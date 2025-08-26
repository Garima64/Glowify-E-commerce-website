<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Glowify</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.php">
                <img src="images/glowify.png" alt="Glowify Logo" style="height: 70px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">Add Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php
include 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_path = $_POST['image_path'];

    $sql = "INSERT INTO Products (name, price, image_path) VALUES ('$name', '$price', '$image_path')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Product added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<div class="container mt-5">
    <h2>Add Product</h2>
    <form method="POST">
        <div class="form-group">
            <label>Name of Product</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Image Path</label>
            <input type="text" name="image_path" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2025 Glowify. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
