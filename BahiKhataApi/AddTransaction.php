<?php
// $conn = mysqli_connect("mysql.hostinger.in","username","password","database");
$conn = mysqli_connect("mysql.hostinger.in", "u311864778_bk", "brfuEW7ShBXENL0KQL", "u311864778_bk");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content = file_get_contents("php://input");
$content = json_decode($content);

$sql = "INSERT INTO TRANSACTION_DETAILS (TRANSACTION_ID,TRANSACTION_DATE,TRANSACTION_TIME,TRANSACTION_TIMEZONE,TRANSACTION_TYPE,TRANSACTION_AMOUNT,TRANSACTION_MESSAGE,TRANSACTION_FAVOURITE,TRANSACTION_USER)
VALUES (\"$content->transactionId\",\"$content->transactionDate\",\"$content->transactionTime\",\"$content->transactionTimeZone\",\"$content->transactionType\",\"$content->transactionAmount\",\"$content->transactionMessage\",\"$content->transactionFavourite\",\"$content->transactionUser\")";

$result = $conn->query($sql);

echo $result;

$response->code    = "";
$response->message = "";


if ($result == "1") {
    $response->code    = "S000";
    $response->message = "Success";
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
} else {
    $response->code    = "E000";
    $response->message = "Error : " . $sql;
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

$conn->close();

?>