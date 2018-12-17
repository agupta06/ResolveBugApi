<?php
// $conn = mysqli_connect("mysql.hostinger.in","username","password","database");
$conn = mysqli_connect("mysql.hostinger.in", "u311864778_money", "@dJsOy?PKI76ku06DQ", "u311864778_money");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content = file_get_contents("php://input");
$content = json_decode($content);

$sql    = "SELECT * from USER_DETAILS WHERE EMAIL LIKE '$content->email'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql    = "INSERT INTO USER_DETAILS (EMAIL,REFERRAL_CODE,APPLIED_REFERRAL_CODE)
    VALUES (\"$content->email\",\"$content->referralCode\",\"$content->appliedReferralCode\")";
    $result = $conn->query($sql);
    if ($result == 1) {
        $response->status = "success";
    } else {
        $response->status = "error";
    }
} else {
    $response->status = "error";
}
echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$conn->close();

?>