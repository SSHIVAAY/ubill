<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Get the data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? null;
$name = $data['name'] ?? 'Customer';
$cart = $data['cart'] ?? [];
$paymentMode = $data['paymentMode'] ?? 'N/A';
$totalAmount = $data['totalAmount'] ?? 0;
$totalWeight = $data['totalWeight'] ?? 0; // total weight from billingSummary

// Calculate total weight by summing product weights and quantities
$calculatedTotalWeight = 0;
foreach ($cart as $item) {
    $weightValue = floatval($item['weight'] ?? 0);
    $weightUnit = strtolower($item['weightUnit'] ?? 'gm');
    $quantity = intval($item['quantity']);
    if ($weightUnit === 'gm') {
        $calculatedTotalWeight += ($weightValue * $quantity) / 1000; // convert grams to kg
    } else {
        $calculatedTotalWeight += $weightValue * $quantity; // assume kg
    }
}

// Use calculated total weight instead of the one from payload
$totalWeight = $calculatedTotalWeight;

if (!$email) {
    echo json_encode(['success' => false, 'error' => 'No recipient email provided.']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreplyubill@gmail.com';
    $mail->Password = 'khxcloxawwaisuoi'; // Use your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set sender and recipient
    $mail->setFrom('noreplyubill@gmail.com', 'UBill');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'Your Order Details - UBill';

    // Email Body
    $message = "
        <h2>Hello $name,</h2>
        <p>Thank you for your purchase! Here's your detailed bill from <strong>UBill</strong>:</p>
        <h3>🛍️ Order Details</h3>
        <table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";
    
    foreach ($cart as $item) {
        $productName = htmlspecialchars($item['name']);
        $price = floatval($item['price']);
        $quantity = intval($item['quantity']);
        $weightValue = floatval($item['weight'] ?? 0);
        $weightUnit = htmlspecialchars($item['weightUnit'] ?? 'gm');
        $weight = $weightValue . ' ' . $weightUnit;
        $total = $price * $quantity;

        $message .= "
                <tr>
                    <td>$productName</td>
                    <td>₹" . number_format($price, 2) . "</td>
                    <td>$quantity</td>
                    <td>$weight</td>
                    <td>₹" . number_format($total, 2) . "</td>
                </tr>";
    }

    $message .= "
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='4'><strong>Total Amount</strong></td>
                    <td><strong>₹" . number_format($totalAmount, 2) . "</strong></td>
                </tr>
                <tr>
                    <td colspan='4'><strong>Total Weight</strong></td>
                    <td><strong>" . number_format($totalWeight, 3) . " kg</strong></td>
                </tr>
            </tfoot>
        </table>
        

        <h3>💳 Payment Information</h3>
        <p><strong>Payment Mode:</strong> $paymentMode</p>
        <h3>📦 Shipping Address</h3>
        <p><strong>Name:</strong> $name</p>
    
        <p>If you have any questions, feel free to contact us at <a href='mailto:support@ubill.com'>support@ubill.com</a>.</p>
        <p>Thank you for shopping with <strong>UBill</strong>!</p>
        <p>Warm regards,<br><strong>The UBill Team</strong></p>
    ";

    $mail->Body = $message;
    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Email sent successfully!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}

?>
<button id="sendEmailBtn">Send Email</button>

<script>
document.getElementById("sendEmailBtn").addEventListener("click", function () {
    const billingSummary = JSON.parse(localStorage.getItem("billingSummary"));
    console.log("billingSummary from localStorage:", billingSummary); // Debug log

    if (!billingSummary) {
        alert("No billing data found.");
        return;
    }

    const payload = {
    email: billingSummary.email,
    name: billingSummary.name,
    cart: billingSummary.cart || [],
    paymentMode: billingSummary.paymentMode,
    totalAmount: billingSummary.totalAmount,
    totalWeight: billingSummary.totalWeight // 👈 send only the number
};


    fetch("send_email.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        alert(data.success ? "Email sent!" : "Error: " + data.error);
    });
});
</script>
