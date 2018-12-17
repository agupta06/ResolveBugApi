<?php
// $conn = mysqli_connect("mysql.hostinger.in","username","password","database");
$conn = mysqli_connect("mysql.hostinger.in", "u311864778_money", "@dJsOy?PKI76ku06DQ", "u311864778_money");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content = file_get_contents("php://input");
$content = json_decode($content);

$sql    = "UPDATE REDEEM_HISTORY SET PAYMENT_DATE=\"$content->paymentDate\",PAYMENT_STATUS=\"$content->paymentStatus\" WHERE REQUEST_DATE=\"$content->requestDate\" AND PAYPAL_EMAIL=\"$content->paypalEmail\" AND AMOUNT=\"$content->amount\"";
$result = $conn->query($sql);
echo $result;

if ($result == 1) {
    $response->status = "success";
} else {
    $response->status = "error";
}

echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$conn->close();

?>