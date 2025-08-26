<?php include 'includes/header.php'; ?>
<?php
session_start();
include 'db_config.php';

// Simulate a logged-in user for now
$user_id = 1; // Replace with actual user data from session

// If the user has no cart items, redirect to cart page
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Handle the payment form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $order_id = uniqid(); // Generate a unique order ID

    // Insert payment information into the Payments table
    $sql = "INSERT INTO Payments (order_id, payment_method, payment_status) 
            VALUES ('$order_id', '$payment_method', 'Success')";
    $conn->query($sql);

    // Add order details for the user
    foreach ($_SESSION['cart'] as $product_id) {
        $sql = "INSERT INTO User_products (user_id, item_id, status) 
                VALUES ('$user_id', '$product_id', 'Ordered')";
        $conn->query($sql);
    }

    // Clear the cart after payment
    $_SESSION['cart'] = [];

    // Redirect to the tracking page
    header("Location: tracking.php?order=$order_id");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center">Select Payment Method</h2>
    <form action="payment.php" method="POST" class="text-center">
        <div class="form-group">
            <label>Select Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Complete Payment</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

<style>
html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1;
}

footer {
    background-color: #f8f9fa;
    padding: 10px 0;
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
}
</style>
