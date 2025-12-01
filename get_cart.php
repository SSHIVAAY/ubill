<?php
session_start();
include 'db.php';

$session_id = session_id();

// Fetch all cart items for the current session
$sql = "SELECT * FROM cart WHERE session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}

// Return as JSON
header('Content-Type: application/json');
echo json_encode($cart_items);
?>
