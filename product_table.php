<!-- filepath: c:\xampp\htdocs\ubill\product_table.php -->
<?php
include 'db.php';

// Fetch product list (replace with your actual query logic)
$sql = "SELECT * FROM product"; // Replace 'product' with your actual table name
$result = $conn->query($sql);
?>

<table>
  <thead>
    <tr>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Price (₹)</th>
      <th>Weight</th>
      <th>Total (₹)</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['item_name']); ?></td>
          <td><?php echo htmlspecialchars($row['quantity']); ?></td>
          <td><?php echo htmlspecialchars($row['price']); ?></td>
          <td>
            <?php echo htmlspecialchars($row['weight']); ?>
            <?php echo htmlspecialchars($row['weight_unit']); ?> <!-- Display weight unit -->
          </td>
          <td><?php echo $row['quantity'] * $row['price']; ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="5">No products found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>