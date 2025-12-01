<?php
// filepath: c:\xampp\htdocs\ubill\db.php
// No additional PHP opening tag is needed here. Remove the extra "<?php".
$host = 'localhost';
$user = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password
$dbname = 'ubill';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
