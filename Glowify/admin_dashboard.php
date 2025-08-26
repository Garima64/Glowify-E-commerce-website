<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Glowify</title>
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

<div class="container mt-5">
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $_GET['message']; ?>
        </div>
    <?php endif; ?>
    <div class="alert alert-info text-center" role="alert">
        Welcome to Admin Panel
    </div>
    <h2>Admin Dashboard</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_config.php';
            $sql = "SELECT * FROM Products";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>Rs <?php echo $row['price']; ?></td>
                    <td><img src="<?php echo $row['image_path']; ?>" class="img-fluid" style="max-width: 100px; height: auto;"></td>
                    <td>
                        <a href="update_product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2025 Glowify. All Rights Reserved.</p>
    <p><a href="index.php" class="text-white">Return to Homepage</a></p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
