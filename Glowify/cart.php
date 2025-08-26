<?php include 'includes/header.php'; ?>
<?php
session_start();
include 'db_config.php';

// Initialize the cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}

// Remove product from cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// Fetch products in the cart
$cart_items = $_SESSION['cart'];
?>
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Your Cart</h2>
    <?php if (!empty($cart_items)): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart_items as $product_id):
                    $sql = "SELECT * FROM Products WHERE id = $product_id";
                    $result = $conn->query($sql);
                    if ($row = $result->fetch_assoc()):
                        $total += $row['price'];
                ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>Rs <?php echo $row['price']; ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>Rs <?php echo $total; ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Redirect to payment page -->
        <div class="text-center">
            <a href="payment.php" class="btn btn-success btn-lg">Proceed to Payment</a>
        </div>
        
    <?php else: ?>
        <p class="text-center">Your cart is empty. <a href="index.php">Shop now!</a></p>
    <?php endif; ?>
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
