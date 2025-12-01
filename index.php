<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UBill - Home</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Footer styles */
footer {
  background-color: #4a90e2;
  color: #ffffff;
  display: flex; /* Use flexbox for horizontal alignment */
  justify-content: space-between; /* Distribute items evenly */
  align-items: center; /* Vertically align items */
  padding: 2rem;
  margin-top: 3rem;
  box-shadow: 0 -2px 8px rgba(74, 144, 226, 0.2);
  border-radius: 12px 12px 0 0;
  width: 100%; /* Ensure the footer spans the full width */
  box-sizing: border-box; /* Include padding in width calculation */
}

.footer-info {
  display: flex; /* Flexbox for the footer columns */
  justify-content: space-between; /* Space between columns */
  align-items: center; /* Vertically align columns */
  width: 100%; /* Ensure the footer content spans the full width */
}

.footer-column {
  flex: 1; /* Allow columns to grow equally */
  padding: 0 1rem; /* Add some spacing between columns */
}

.footer-column:first-child {
  text-align: left; /* Align the "About" section to the left */
}

.footer-logo {
  text-align: center; /* Center-align the "UBill Logo" */
}

.footer-column:last-child {
  text-align: right; /* Align the "Contact" section to the right */
}

/* Social media links */
.social-media a {
  color: #ffffff;
  margin-right: 1rem;
  text-decoration: none;
  font-weight: 700;
  transition: color 0.3s ease;
}

.social-media a:hover {
  color: #50e3c2;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
  footer {
    flex-direction: column; /* Stack footer items vertically */
    align-items: center;
  }
  .footer-info {
    flex-direction: column; /* Stack columns vertically */
    align-items: center;
  }
  .footer-column {
    text-align: center; /* Center-align all sections on small screens */
    padding: 1rem 0;
  }
}
</style>
</head>
<body>
  <!-- Header -->
  <header class="site-header">
    <div class="logo">
      <h2>UBill</h2>
    </div>
   
    <div class="auth">
      <a href="register.php" class="button">Register</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Smart Shopping Made Easier – Scan, Pay, Go!</h1>
      <p>UBill lets you shop faster with automated billing and secure online payments.</p>
      <div class="cta-buttons">
        <a href="product.php" class="button">Start Shopping</a>
      </div>
    </div>
  </section>

  <!-- Key Features Section -->
  <section class="features">
    <div class="feature-card">
      <div class="icon">📦</div>
      <h3>Instant Checkout</h3>
      <p>No long queues.</p>
    </div>
    <div class="feature-card">
      <div class="icon">📷</div>
      <h3>Barcode Scanning</h3>
      <p>Just scan and add.</p>
    </div>
    <div class="feature-card">
      <div class="icon">💳</div>
      <h3>Multiple Payment Options</h3>
      <p>UPI, Cards, Wallets.</p>
    </div>
    <div class="feature-card">
      <div class="icon">🔒</div>
      <h3>Secure & Fast</h3>
      <p>Your details are safe.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-info">
      <div class="footer-column">
        <h4>About UBill</h4>
        <p>UBill is your intelligent companion for </p>
        <p>easy, secure, and efficient shopping and bill payments.</p>
      </div>
      <div class="footer-logo">
        <h1>UBill</h1>
      </div>
      <div class="footer-column">
        <h4>Contact</h4>
        <p>Email: noreplyubill@gmail.com</p>
        <p>Phone: +91 8956848671</p>
        <div class="social-media">
          <a href="#">FB</a>
          <a href="#">TW</a>
          <a href="#">IG</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
