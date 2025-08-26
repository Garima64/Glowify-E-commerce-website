<?php
include 'includes/header.php';
include 'db_config.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '<div class="card mb-4 shadow-sm">';
                echo '<img src="images/' . $row["image_path"] . '" class="card-img-top" alt="' . $row["name"] . '" style="height: 300px; object-fit: cover;">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                echo '<p class="card-text">Price: Rs ' . $row["price"] . '</p>';
                echo '<a href="cart.php?add=' . $row["id"] . '" class="btn btn-primary">Add to Cart</a>';
                echo '</div></div></div>';
            }
        } else {
            echo '<p class="text-center">No products found.</p>';
        }
        ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>

<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
</style>
