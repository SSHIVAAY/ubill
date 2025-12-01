<?php
// filepath: c:\xampp\htdocs\ubill\product.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $weight_unit = $_POST['weight_unit'];
    $total_price = $_POST['total_price'];
    $grand_total = $_POST['grand_total'];
    $total_weight = $_POST['total_weight'];

    $sql = "INSERT INTO bill (customer_name, customer_email, item_name, quantity, price, weight, weight_unit, total_price, grand_total, total_weight) 
            VALUES ('$customer_name', '$customer_email', '$item_name', '$quantity', '$price', '$weight', '$weight_unit', '$total_price', '$grand_total', '$total_weight')";

    if ($conn->query($sql) === TRUE) {
        echo "Bill details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UBill - Products</title>
  <link rel="stylesheet" href="style.css">
  <style>
.cart-icon a {
  font-size: 1.5rem; /* Increase the size of the cart icon */
  color: #ffffff; /* Set the default color */
  background-color: #4a90e2; /* Add a background color */
  padding: 0.5rem; /* Add padding around the icon */
  border-radius: 50%; /* Make it circular */
  text-decoration: none; /* Remove underline */
  transition: transform 0.3s ease, background-color 0.3s ease; /* Add smooth transition */
  box-shadow: 0 2px 6px rgba(74, 144, 226, 0.4); /* Add a subtle shadow */
}

.cart-icon a:hover {
  background-color: #357abd; /* Change background color on hover */
  transform: scale(1.2); /* Slightly enlarge the icon on hover */
  box-shadow: 0 4px 12px rgba(74, 144, 226, 0.6); /* Enhance the shadow on hover */
}
    .button-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }
    .button-container .button {
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
    }
    .button-container .button:hover {
      background-color: #0056b3;
    }
    /* Navigation menu styles */
.main-nav ul {
  list-style: none; /* Remove default bullet points */
  margin: 0;
  padding: 0;
  display: flex; /* Align items horizontally */
  gap: 1rem; /* Add spacing between menu items */
}

.main-nav ul li {
  margin: 0;
  padding: 0;
}

.main-nav ul li a {
  text-decoration: none; /* Remove underline from links */
  color: #ffffff; /* Set link color */
  font-weight: 600; /* Make text bold */
  padding: 0.5rem 1rem; /* Add padding for clickable area */
  border-radius: 8px; /* Add rounded corners */
  transition: background-color 0.3s ease; /* Smooth hover effect */
}

.main-nav ul li a:hover {
  background-color: #357abd; /* Change background color on hover */
}
.product-entry {
  max-width: 500px; /* Reduce the width of the section */
  margin: 1.5rem auto; /* Reduce vertical spacing */
  padding: 1rem; /* Reduce padding inside the section */
  background-color: #f9f9f9; /* Light background for better visibility */
  border-radius: 10px; /* Slightly reduce rounded corners */
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.product-entry h2 {
  text-align: center; /* Center the heading */
  margin-bottom: 0.75rem; /* Reduce spacing below the heading */
  font-size: 1.25rem; /* Slightly reduce font size */
  color: #333; /* Darker text color */
}

.form-container {
  display: flex;
  flex-direction: column; /* Stack labels and inputs vertically */
  gap: 0.5rem; /* Reduce spacing between each label-input pair */
}

.form-container label {
  font-weight: bold;
  font-size: 0.85rem; /* Reduce font size */
  margin-bottom: 0.2rem; /* Reduce spacing below the label */
}

.form-container input {
  width: 100%; /* Make input fields take the full width */
  padding: 0.4rem; /* Reduce padding */
  border: 1px solid #d1d9e6;
  border-radius: 6px; /* Slightly reduce rounded corners */
  font-size: 0.85rem; /* Reduce font size */
  box-sizing: border-box; /* Include padding in width calculation */
}

.form-container button {
  align-self: center; /* Center the button */
  padding: 0.4rem 1rem; /* Reduce padding */
  font-size: 0.85rem; /* Reduce font size */
  color: #ffffff;
  background-color: #4a90e2;
  border: none;
  border-radius: 6px; /* Slightly reduce rounded corners */
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.form-container button:hover {
  background-color: #357abd;
}
table {
  width: 100%;	
  border-collapse: collapse;
  margin-bottom: 20px;
}

table th, table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center; /* Center-align text in table cells */
  vertical-align: middle; /* Vertically align text in the middle */
}

table th {
  background-color: #50e3c2; /* Change to a darker blue for better contrast */
  color: #ffffff; /* Set text color to white for readability */
  font-weight: bold;
  padding: 10px;
  text-align: center; /* Center-align text in header cells */
}
  </style>
</head>
<body>
  <!-- Header -->
  <header class="site-header">
    <div class="logo"><h2>UBill</h2></div>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php">HOME</a></li>
      </ul>
    </nav>
    <div class="cart-icon">
      <a href="checkout.php">🛒</a>
    </div>
  </header>

  <!-- Product Entry Form -->
  <section class="product-entry">
    <h2>Add a Product</h2>
    <div class="form-container">
      <label for="barcode">Barcode Number:</label>
      <input type="text" id="barcode" placeholder="Enter barcode">

      <label for="productName">Product Name:</label>
      <input type="text" id="productName" placeholder="Enter product name">

      <label for="productPrice">Price (₹):</label>
      <input type="number" id="productPrice" placeholder="Enter price">

      <label for="productWeight">Weight:</label>
      <input type="number" id="productWeight" placeholder="Enter weight">
      
      <label for="productQuantity">Quantity:</label>
      <input type="number" id="productQuantity" value="1" min="1">
      <span id="weightUnitLabel"> </span> <!-- Dynamic weight unit label -->

      <button class="button" id="addProductButton">Add Product</button>
    </div>
  </section>

  <!-- Product List Table -->
  <section class="product-list">
    <h2>Product List</h2>
    <table>
      <thead>
        <tr>
          <th>Barcode</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Weight</th>
          <th>Total</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody id="productTableBody">
        <!-- Rows will be added dynamically -->
      </tbody>
    </table>
  </section>

  <!-- Total Amount and Weight Section -->
  <section class="total-amount">
    <h2>Billing Summary</h2>
    <p>Subtotal: ₹<span id="subtotal">0</span></p>
    <p>Total Weight: <span id="totalWeight">0</span> <span id="totalWeightUnit">kg</span></p> <!-- Dynamic weight unit -->
    <p>Discounts: ₹<span id="discounts">0</span></p>
    <p>Grand Total: ₹<span id="grandTotal">0</span></p>

    <!-- Buttons -->
    <div class="button-container">
      <a href="checkout.php" class="button">Proceed to Checkout</a>
    </div>
  </section>

  <!-- Inside your existing <script> tag -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const barcodeInput = document.getElementById("barcode");
    const nameInput = document.getElementById("productName");
    const priceInput = document.getElementById("productPrice");
    const weightInput = document.getElementById("productWeight");
    const weightUnitLabel = document.getElementById("weightUnitLabel");
    const quantityInput = document.getElementById("productQuantity");
    const productTableBody = document.getElementById("productTableBody");
    const totalWeightElement = document.getElementById("totalWeight");
    const totalWeightUnit = document.getElementById("totalWeightUnit");
    const subtotalElement = document.getElementById("subtotal");
    const grandTotalElement = document.getElementById("grandTotal");

    // Always keep focus on barcode input to capture barcode scans
    document.addEventListener("keydown", function (event) {
      if (document.activeElement !== barcodeInput) {
        barcodeInput.focus();
      }
    });

  const CART_KEY = "cart";
  const BILLING_KEY = "billingSummary";

  function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  }

  function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
  }

  function saveBillingSummary(subtotal, totalWeight, grandTotal) {
    const billingSummary = {
      subtotal: parseFloat(subtotal.toFixed(2)),
      totalWeight: parseFloat(totalWeight.toFixed(3)),
      totalWeightUnit: "kg",
      totalAmount: parseFloat(grandTotal.toFixed(2)),
      grandTotal: parseFloat(grandTotal.toFixed(2)),
    };
    localStorage.setItem(BILLING_KEY, JSON.stringify(billingSummary));
  }

  function updateTotals(cart = getCart()) {
    console.log("Updating totals for cart:", cart); // Added debug log
    let subtotal = 0;
    let totalWeight = 0;
    let weightUnit = "kg";

    cart.forEach((item) => {
      console.log("Item weight and quantity:", item.weight, item.quantity); // Added debug log
      subtotal += item.price * item.quantity;
      if ((item.weightUnit || "gm") === "gm") {
        totalWeight += (item.weight * item.quantity) / 1000;
        weightUnit = "kg";
      } else if ((item.weightUnit || "kg") === "kg") {
        totalWeight += item.weight * item.quantity;
        weightUnit = "kg";
      } else {
        // If weightUnit is missing or unknown, assume grams and convert
        totalWeight += (item.weight * item.quantity) / 1000;
        weightUnit = "kg";
      }
    });

    subtotalElement.textContent = subtotal.toFixed(2);
    totalWeightElement.textContent = totalWeight.toFixed(3);
    totalWeightUnit.textContent = weightUnit;
    grandTotalElement.textContent = subtotal.toFixed(2);

    console.log("Calculated totalWeight:", totalWeight); // Debug log for totalWeight before saving
    saveBillingSummary(subtotal, totalWeight, subtotal); // Same as grandTotal
    console.log("Saved billingSummary:", localStorage.getItem("billingSummary")); // Debug log for saved billingSummary
  }

  function addRowToTable(item, index) {
    console.log("Adding row to table for item:", item); // Debug log
    const productTableBodyLocal = document.getElementById("productTableBody");
    console.log("productTableBody element in addRowToTable:", productTableBodyLocal); // Debug log
    const row = document.createElement("tr");
    row.setAttribute("data-index", index);
    row.innerHTML = `
      <td>${item.barcode}</td>
      <td>${item.name}</td>
      <td>₹${item.price.toFixed(2)}</td>
      <td>
        <input type="number" class="quantity-input" data-index="${index}" value="${item.quantity}" min="1" style="width: 60px;">
        <button class="update-qty-btn" data-index="${index}">🔄</button>
      </td>
      <td>${item.totalWeightDisplay}</td>
      <td>₹${(item.price * item.quantity).toFixed(2)}</td>
      <td><button class="delete-btn" data-index="${index}">❌</button></td>
    `;
    productTableBodyLocal.appendChild(row);

    // Delete functionality
    row.querySelector(".delete-btn").addEventListener("click", function () {
      const deleteIndex = parseInt(this.getAttribute("data-index"));
      const cart = getCart();
      cart.splice(deleteIndex, 1);
      saveCart(cart);
      renderTable(); // Full re-render
      updateTotals(cart);
    });

    // Quantity update functionality
    row.querySelector(".update-qty-btn").addEventListener("click", function () {
      const updateIndex = parseInt(this.getAttribute("data-index"));
      const newQtyInput = row.querySelector(".quantity-input");
      const newQuantity = parseInt(newQtyInput.value);

      if (isNaN(newQuantity) || newQuantity < 1) {
        alert("Enter a valid quantity");
        return;
      }

      const cart = getCart();
      cart[updateIndex].quantity = newQuantity;

      // Update totalWeightDisplay
      if (cart[updateIndex].weightUnit === "gm") {
        cart[updateIndex].totalWeightDisplay = (cart[updateIndex].weight * newQuantity).toFixed(2) + " gm";
      } else {
        cart[updateIndex].totalWeightDisplay = (cart[updateIndex].weight * newQuantity).toFixed(2) + " kg";
      }

      saveCart(cart);
      renderTable(); // Refresh table
      updateTotals(cart);
    });
  }

  function renderTable() {
    console.log("Rendering table..."); // Debug log
    const productTableBodyLocal = document.getElementById("productTableBody");
    console.log("productTableBody element in renderTable:", productTableBodyLocal); // Debug log
    productTableBodyLocal.innerHTML = "";
    const cart = getCart();
    cart.forEach((item, index) => addRowToTable(item, index));
  }

  function loadCartOnStart() {
    renderTable();
    updateTotals(getCart());
  }

  let barcodeTimeout;
  barcodeInput.addEventListener("input", function () {
    clearTimeout(barcodeTimeout);
    barcodeTimeout = setTimeout(() => {
      const scannedBarcode = barcodeInput.value.trim();
      if (!scannedBarcode) return;

      console.log("Barcode entered (debounced):", scannedBarcode); // Debugging log

      // Fetch the product details using the scanned barcode
      fetch(`get_product.php?barcode=${scannedBarcode}`)
        .then((response) => response.json())
        .then((data) => {
          console.log("Product data received:", data); // Debugging log
          console.log("Product object:", data.product); // Added debug log for product object

          if (data.success) {
            // If product is found, automatically fill the fields
            nameInput.value = data.product.name || "";
            priceInput.value = data.product.price || "";
            weightInput.value = data.product.weight || "";
            weightUnitLabel.textContent = data.product.weightUnit || "gm";

            // Automatically add the product to the cart with default quantity of 1
            const newItem = {
              barcode: data.product.barcode || data.product.barcode_number || data.product.barcodeNumber || scannedBarcode || "N/A",
              name: data.product.name,
              price: parseFloat(data.product.price) || 0,
              weight: parseFloat(data.product.weight) || 0,
              weightUnit: data.product.weightUnit || "gm",
              quantity: 1,
              totalWeightDisplay: (parseFloat(data.product.weight) || 0).toFixed(2) + " " + ((data.product.weightUnit || "gm") === "gm" ? "gm" : "kg"),
            };

            const cart = getCart();
            const existingIndex = cart.findIndex((item) => item.barcode === newItem.barcode);

            if (existingIndex !== -1) {
              cart[existingIndex].quantity += 1;
              const updatedQty = cart[existingIndex].quantity;
              cart[existingIndex].totalWeightDisplay =
                newItem.weightUnit === "gm"
                  ? (newItem.weight * updatedQty).toFixed(2) + " gm"
                  : (newItem.weight * updatedQty).toFixed(2) + " kg";
            } else {
              cart.push(newItem);
            }

            saveCart(cart);
            renderTable();
            updateTotals(cart);

            // Clear barcode input after adding the product
            barcodeInput.value = "";
            // Clear other input fields to prepare for next scan
            nameInput.value = "";
            priceInput.value = "";
            weightInput.value = "";
            weightUnitLabel.textContent = "";
          } else {
            alert(data.message || "Product not found");
          }
        })
        .catch((error) => {
          console.error("Fetch error:", error); // Debugging log for fetch error
        });
    }, 300); // 300ms debounce delay
  });


  // Remove the Add Product button functionality as product is added automatically on barcode scan
  const addProductButton = document.getElementById("addProductButton");
  if (addProductButton) {
    addProductButton.style.display = "none";
  }

  loadCartOnStart();
});

</script>
</body>
</html>