<?php 
include 'includes/header.php'; 
include 'db_config.php';

session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Fetch orders for the logged-in user
$sql = "SELECT o.order_id, t.payment_status, t.timestamp
        FROM Orders o
        JOIN Tracking t ON o.order_id = t.order_id
        WHERE o.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
    <h2>Your Orders</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Payment Status</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                        <td><?php echo $row['timestamp']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</div>

<?php 
include 'includes/footer.php'; 
?>
