<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php?message=Product deleted successfully.");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
