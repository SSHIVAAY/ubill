<?php
session_start();

// Include Firebase SDK and config
require_once 'firebase_config.php';  // Adjust this to the actual path of your Firebase config file

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the email and oobCode from the URL
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $oobCode = isset($_GET['oobCode']) ? $_GET['oobCode'] : '';

    if ($oobCode) {
        // Verify the link
        $auth = $firebase->getAuth();
        try {
            // Complete sign-in with the oobCode
            $user = $auth->signInWithEmailLink($email, $oobCode);
            $_SESSION['user'] = $user;  // Store user data in session

            // Redirect to index.php if successful
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
