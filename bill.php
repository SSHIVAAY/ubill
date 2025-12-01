<!-- filepath: c:\xampp\htdocs\ubill\bill.php -->
<?php
include 'db.php';

// Fetch the latest bill from the database
$sql = "SELECT * FROM bills ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$bill = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UBill - Latest Bill</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <div class="logo"><h2>UBill</h2></div>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <section class="bill-details">
    <h2>Latest Bill</h2>
    <?php if ($bill): ?>
      <table>
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price (₹)</th>
            <th>Weight</th>
            <th>Weight Unit</th>
            <th>Total Price (₹)</th>
            <th>Grand Total (₹)</th>
            <th>Total Weight</th>
            <th>Bill Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $bill['customer_name']; ?></td>
            <td><?php echo $bill['customer_email']; ?></td>
            <td><?php echo $bill['item_name']; ?></td>
            <td><?php echo $bill['quantity']; ?></td>
            <td><?php echo $bill['price']; ?></td>
            <td><?php echo $bill['weight']; ?></td>
            <td><?php echo $bill['weight_unit']; ?></td>
            <td><?php echo $bill['total_price']; ?></td>
            <td><?php echo $bill['grand_total']; ?></td>
            <td><?php echo $bill['total_weight']; ?></td>
            <td><?php echo $bill['bill_date']; ?></td>
          </tr>
        </tbody>
      </table>
    <?php else: ?>
      <p>No bill found.</p>
    <?php endif; ?>
    <a href="product.php" class="button">Back to Products</a>
  </section>
</body>
</html>