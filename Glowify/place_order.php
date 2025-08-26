<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$order_id = "ORD" . time(); // Generate a unique order ID
$total_price = 0;

// Get product price
$sql = "SELECT price FROM Products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $total_price = $row['price'] * $quantity;
} else {
    die("Error: Product not found.");
}

// Insert into Orders table
$sql = "INSERT INTO Orders (order_id, user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siiid", $order_id, $user_id, $product_id, $quantity, $total_price);
$stmt->execute();

// Insert into Tracking table
$sql = "INSERT INTO Tracking (order_id, payment_status) VALUES (?, 'Pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $order_id);
$stmt->execute();

header("Location: tracking.php");
exit;
?>
