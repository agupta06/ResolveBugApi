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
if ($result->num_rows==1) {
    $response->status="success";
}else{
    $response->status="error";
}
while ($row = $result->fetch_assoc()) {
    $res->email               = $row['EMAIL'];
    $res->referralCode        = $row['REFERRAL_CODE'];
    $res->appliedReferralCode = $row['APPLIED_REFERRAL_CODE'];
    $res->pointsEarned        = $row['POINTS_EARNED'];
    $res->paypalEmail         = $row['PAYPAL_EMAIL'];
    $res->joiningBonusGiven   = $row['JOINING_BONUS_GIVEN'];
}

echo json_encode($res, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

$conn->close();

?>