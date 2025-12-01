  <!-- filepath: c:\xampp\htdocs\ubill\checkout.php -->
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UBill - Checkout</title>
    <link rel="stylesheet" href="style.css">
    <style>
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
    background-color: #4a90e2; /* Add background color for better visibility */
  }

  .main-nav ul li a:hover {
    background-color: #357abd; /* Change background color on hover */
  }
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
      }
      .checkout-container {
        max-width: 800px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      .billing-details, .payment-method, .checkout-confirm {
        margin-bottom: 20px;
      }
      .billing-details h3, .payment-method h3 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
      }
      .billing-details p, .payment-method label {
        margin: 5px 0;
        font-size: 14px;
        color: #555;
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
    background-color: #50e3c2; /* Dark blue background for header row */
    color: #ffffff; /* White text for better readability */
    font-weight: bold;
  }

  table td {
    background-color: #ffffff; /* White background for table cells */
    color: #333; /* Dark text for readability */
  }
  .invoice-header {
    text-align: center; /* Center-align the invoice heading */
    margin-bottom: 20px; /* Add spacing below the heading */
  }

  .payment-method {
    text-align: center; /* Center-align the payment method section */
    margin-bottom: 30px; /* Add spacing below the payment method section */
  }

  .payment-method h3 {
    margin-bottom: 20px; /* Add spacing below the heading */
  }

  .payment-method .payment-options {
    display: flex;
    justify-content: center; /* Center-align the payment buttons */
    gap: 15px; /* Add spacing between buttons */
    flex-wrap: wrap; /* Allow buttons to wrap on smaller screens */
  }

  .checkout-confirm {
    text-align: center; /* Center-align the Confirm & Pay button */
    margin-top: 30px; /* Add spacing above the Confirm & Pay button */
  }

  .main-nav ul {
    list-style: none; /* Remove default bullet points */
    margin: 0;
    padding: 0;
    display: flex; /* Align items horizontally */
    align-items: center; /* Vertically align items */
    gap: 1rem; /* Add spacing between menu items */
  }

  .main-nav ul li {
    margin: 0;
    padding: 0;
  }

  .main-nav ul li a,
  #logoutBtn {
    text-decoration: none; /* Remove underline */
    color: #ffffff; /* Set link color */
    font-weight: 600; /* Make text bold */
    padding: 0.5rem 1rem; /* Add padding for clickable area */
    border-radius: 8px; /* Add rounded corners */
    transition: background-color 0.3s ease; /* Smooth hover effect */
    background-color: #4a90e2; /* Add background color for better visibility */
    border: none; /* Remove border */
    cursor: pointer; /* Pointer cursor on hover */
    display: inline-block; /* Ensure buttons behave like links */
    text-align: center; /* Center-align text inside buttons */
  }

  .main-nav ul li a:hover,
  #logoutBtn:hover {
    background-color: #357abd; /* Change background color on hover */
  }
      .confirm-pay-btn {
        padding: 10px 30px;
        background-color: #50e3c2;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .confirm-pay-btn:hover {
        transform: scale(1.05);
        background-color: #28a745;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
      }
      .confirm-pay-btn:active {
        transform: scale(0.95);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }
      .payment-success {
        text-align: center;
        margin-top: 20px;
      }
      .payment-success h2 {
        color:rgb(13, 224, 112);
      }
    </style>
  </head>
  <body>
    <header class="site-header">
      <div class="logo"><h2>UBill</h2></div>
      <nav class="main-nav">
        <ul>
          <li><a href="index.php">HOME</a></li>
          <li><a href="product.php">PRODUCT</a></li>
          <li><button id="logoutBtn">LOGOUT</button></li>
        </ul>
      </nav>
    </header>

    <main class="checkout">
      <div class="checkout-container">
        <!-- Billing Details -->
        <div class="billing-details">
          <h3> </h3>
          <p><strong>Name:</strong> <span id="billingName">-</span></p>
          <p><strong>Mobile:</strong> <span id="billingMobile">-</span></p>
          <p><strong>Email:</strong> <span id="billingEmail">-</span></p>
        </div>

        <!-- Product List -->
        <div class="product-list">
          <h3>INVOICE</h3>
          <table>
            <thead>
              <tr>
                <th>Barcode</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Weight</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            <tfoot>
    <tr>
      <td colspan="4">Grand Total (Amount):</td>
      <td colspan="2" id="grandTotalAmount">₹0.00</td>
    </tr>
    <tr>
      <td colspan="4">Grand Total (Weight):</td>
      <td colspan="2" id="grandTotalWeight">0.00 kg</td>
    </tr>
  </tfoot>
            </tbody>
          </table>
        </div>

        <!-- Payment Method -->
        <div class="payment-method">
          <h3>SELECT PAYMENT METHOD</h3>
          <div class="payment-options">
            <button class="button" onclick="selectPayment('UPI')">UPI</button>
            <button class="button" onclick="selectPayment('Credit/Debit Card')">Credit/Debit Card</button>
            <button class="button" onclick="selectPayment('Net Banking')">Net Banking</button>
            <button class="button" onclick="selectPayment('Wallets')">Wallets</button>
            <button class="button" onclick="selectPayment('Cash')">Cash</button>
          </div>
        </div>

        <!-- Confirm and Pay Button -->
        <div class="checkout-confirm">
          <button class="confirm-pay-btn" id="confirmPay">Confirm &amp; Pay</button>
          <p id="paymentMessage" style="display: none; color: green; font-weight: bold; margin-top: 10px;">
            Processing payment, please wait...
          </p>
        </div>
      </div>

      <div id="paymentSuccess" class="payment-success" style="display: none;">
        <h2>✅ Payment Successful!</h2>
        <p>Your invoice has been sent to your email.</p>
      </div>

      l
      </div>
    </main>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Fetch logged-in user details from localStorage
        let loggedInUser = JSON.parse(localStorage.getItem("loggedInUser"));

        if (loggedInUser) {
          document.getElementById("billingName").textContent = loggedInUser.name || "-";
          document.getElementById("billingMobile").textContent = loggedInUser.mobile || "-";
          document.getElementById("billingEmail").textContent = loggedInUser.email || "-";
        } else {
          alert("You are not logged in. Redirecting to the home page.");
          window.location.href = "index.php"; // Redirect to home page
        }

        
      // Function to update Grand Total (Amount) and Grand Total (Weight)
      function updateBillingSummary() {
    const billingSummary = JSON.parse(localStorage.getItem("billingSummary")) || {
      grandTotal: 0,
      totalWeight: 0,
    };

    console.log("Billing Summary:", billingSummary);

    // Safely parse the values to ensure they are numbers
    const grandTotal = parseFloat(billingSummary.grandTotal) || 0;
    const totalWeight = parseFloat(billingSummary.totalWeight) || 0;

    // Update the Grand Total Amount and Weight in the table
    document.getElementById("grandTotalAmount").textContent = `₹${grandTotal.toFixed(2)}`;
    document.getElementById("grandTotalWeight").textContent = `${totalWeight.toFixed(3)} ${billingSummary.totalWeightUnit || "kg"}`;
  }

        // Fetch and display products in the product list table
        function populateProductList() {
          const productTableBody = document.querySelector(".product-list tbody");
          const cart = JSON.parse(localStorage.getItem("cart")) || [];

          productTableBody.innerHTML = ""; // Clear existing rows

          cart.forEach((product, index) => {
            const row = document.createElement("tr");
            
            row.innerHTML = `
              <td>${product.barcode || "-"}</td>
              <td>${product.name || "-"}</td>
              <td>₹${product.price || "0"}</td>
              <td>${product.quantity || "1"}</td>
              <td>${product.weight || "0"} ${product.weightUnit ||" "}</td>
              <td>₹${(product.price * product.quantity).toFixed(2)}</td>
            `;

            productTableBody.appendChild(row);
          });

          // Add event listeners to remove buttons
          document.querySelectorAll(".remove-btn").forEach((button) => {
            button.addEventListener("click", function () {
              const index = this.getAttribute("data-index");
              cart.splice(index, 1);
              localStorage.setItem("cart", JSON.stringify(cart));
              populateProductList(); // Refresh the table
            });
          });
        }

        populateProductList(); // Call the function to populate the table
        updateBillingSummary();
      });

      function selectPayment(method) {
        localStorage.setItem("selectedPaymentMode", method);
        alert("Payment method selected: " + method);
      }

      document.getElementById("logoutBtn").addEventListener("click", function () {
        localStorage.removeItem("loggedInUser");
        localStorage.removeItem("cart");
        localStorage.removeItem("selectedPaymentMode");
        window.location.href = "index.php";  // Redirect to home after logout
      });

      document.getElementById("confirmPay").addEventListener("click", function () {
        let paymentMode = localStorage.getItem("selectedPaymentMode");
        if (!paymentMode) {
          alert("Please select a payment method before proceeding.");
          return;
        }

        let paymentMessage = document.getElementById("paymentMessage");
        paymentMessage.style.display = "block";

        setTimeout(function () {
          document.querySelector(".checkout-container").style.display = "none";
          document.getElementById("paymentSuccess").style.display = "block";

          saveOrderHistory(paymentMode);

          // Send email with order details
          sendEmail();


          // Automatically redirect to home page after 2 seconds
          setTimeout(() => {
            localStorage.removeItem("loggedInUser");
            localStorage.removeItem("cart");
            localStorage.removeItem("selectedPaymentMode");

            window.location.href = "/ubill/index.php"; // Adjusted to index.php
          }, 2000); // Simulate payment processing time
        }, 2000); // Simulate payment processing time
      });

      function sendEmail() {
    let loggedInUser = JSON.parse(localStorage.getItem("loggedInUser"));
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let paymentMode = localStorage.getItem("selectedPaymentMode");
    let totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

    if (!loggedInUser || !loggedInUser.email) {
      console.error("No email found for the logged-in user.");
      return;
    }

    // Prepare data to send
    let emailData = {
      email: loggedInUser.email,
      name: loggedInUser.name || "Customer",
      cart: cart,
      paymentMode: paymentMode,
      totalAmount: totalAmount
    };
    console.log("Email Data:", emailData); // Debugging line
    // Send POST request to send_email.php
    fetch("send_email.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(emailData)
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log("Email sent successfully:", data.message);
        } else {
          console.error("Failed to send email:", data.error);
        }
      })
      .catch(error => {
        console.error("Error sending email:", error);
      });
  }

      function saveOrderHistory(paymentMode) {
        let loggedInUser = JSON.parse(localStorage.getItem("loggedInUser"));
        if (!loggedInUser) return;

        let orders = JSON.parse(localStorage.getItem("orders")) || [];

        let orderData = {
          orderTime: new Date().toLocaleString(),
          email: loggedInUser.email,
          mobile: loggedInUser.mobile,
          paymentMode: paymentMode,
          items: JSON.parse(localStorage.getItem("cart")) || [],
          totalAmount: 0
        };

        orderData.totalAmount = orderData.items.reduce((sum, item) => sum + item.price * item.quantity, 0);

        orders.push(orderData);
        localStorage.setItem("orders", JSON.stringify(orders));
      }
      
    </script>

  <!-- Checkout Page -->

  <script>
  document.getElementById('sendEmailButton').addEventListener('click', () => {
      // Retrieve email from the input field
      const email = document.getElementById('manualEmail').value;

      // Validate email
      if (!email || !email.includes('@')) {
          alert('Please enter a valid email address.');
          return;
      }

      // Retrieve totalAmount and totalWeight from local storage
      const totalAmount = localStorage.getItem('totalAmount') || 0;
      const totalWeight = localStorage.getItem('totalWeight') || 0;

      // Retrieve cart data from local storage
      const cart = JSON.parse(localStorage.getItem('cart')) || [];

      // Prepare the payload
      const payload = {
          email: email, // Use the manually entered email
          name: document.getElementById('billingName').textContent.trim() || "Customer",
          cart: cart,
          totalAmount: parseFloat(totalAmount), // Ensure it's a number
          totalWeight: parseFloat(totalWeight), // Ensure it's a number
          paymentMode: localStorage.getItem('selectedPaymentMode') || "N/A"
      };

      // Send the data to the server
      fetch('/send_email.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
      })
          .then(response => response.json())
          .then(data => { 
              if (data.success) {
                  alert('Email sent successfully!');
              } else {
                  alert('Error sending email: ' + data.error);
              }
          })
          .catch(error => console.error('Fetch error:', error));
  });
  </script>
  </body>
  </html>