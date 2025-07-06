<?php
$conn = new mysqli("localhost", "root", "", "food_order");

$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
echo "<h1>All Orders</h1>";
while ($row = $result->fetch_assoc()) {
    echo "<p>Order #{$row['id']}: {$row['customer_name']} - ₹{$row['total_price']} - {$row['created_at']}</p>";
}

$conn->close();
?>
