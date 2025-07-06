<?php
$conn = new mysqli("localhost", "root", "", "food_order");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['customer_name'];
$email = $_POST['customer_email'];
$cartData = json_decode($_POST['cart_data'], true);

// Calculate total price
$total = 0;
foreach ($cartData as $item) {
    $total += $item['price'];
}

// Insert into orders table
$conn->query("INSERT INTO orders (customer_name, customer_email, total_price) VALUES ('$name', '$email', '$total')");
$order_id = $conn->insert_id;

// Insert each item into order_items table
foreach ($cartData as $item) {
    $itemName = $item['name'];
    $conn->query("INSERT INTO order_items (order_id, item_name, quantity) VALUES ($order_id, '$itemName', 1)");
}

echo "<h1>Thank You! Your Order Has Been Placed.</h1>";
echo "<a href='index.html'>Back to Home</a>";

$conn->close();
?>
