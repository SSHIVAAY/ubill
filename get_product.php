<?php
// filepath: c:\xampp\htdocs\ubill\get_product.php

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "ubill";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

// Get the barcode from the request
$barcode = $_GET['barcode'] ?? '';

if (empty($barcode)) {
    echo json_encode(["success" => false, "message" => "Barcode is required"]);
    exit;
}

// Query the database for the product
$sql = "SELECT name, price, weight, weightunit FROM product WHERE barcode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $barcode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "product" => [
            "name" => $product['name'],
            "price" => $product['price'],
            "weight" => $product['weight'],
            "weightUnit" => $product['weightunit'] // Include weight unit in the response
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Product not found"]);
}

$stmt->close();
$conn->close();
?>