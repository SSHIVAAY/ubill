<?php
session_start(); // Start the session
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ubill";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];

  // Generate a unique session ID
  $session_id = uniqid();

  // Store the session ID in the session
  $_SESSION['session_id'] = $session_id;

  // Insert into database
  $stmt = $conn->prepare("INSERT INTO users (name, mobile, email, session_id) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $mobile, $email, $session_id);

  if ($stmt->execute()) {
    // After successful insertion, redirect with localStorage data
    echo "<script>
      localStorage.setItem('loggedInUser', JSON.stringify({
        name: '$name',
        mobile: '$mobile',
        email: '$email'
      }));
      window.location.href = 'index.php';
    </script>";
    exit();
  } else {
    $message = "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBill - Customer Registration</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your stylesheet -->
</head>
<body>
    <header class="site-header">
        <div class="logo">
            <h2>UBill</h2>
        </div>
    </header>

    <!-- Registration Section -->
    <section class="registration">
        <h2>Customer Details</h2>

        <?php if (!empty($message)) echo "<p style='color: red; text-align:center;'>$message</p>"; ?>

        <form id="registrationForm" method="POST" action="register.php">
            <input type="text" id="name" name="name" placeholder="Name" required>
            <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" required>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <button type="submit" class="button">Submit</button>
        </form>
    </section>

</body>
</html>
