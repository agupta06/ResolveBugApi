<?php
// $conn = mysqli_connect("mysql.hostinger.in","username","password","database");
$conn = mysqli_connect("mysql.hostinger.in", "u311864778_bk", "brfuEW7ShBXENL0KQL", "u311864778_bk");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content = file_get_contents("php://input");
$content = json_decode($content);

$res->transactionUser = "$content->transactionUser";

$sql = "select TRANSACTION_AMOUNT from TRANSACTION_DETAILS where TRANSACTION_USER = '$content->transactionUser' and TRANSACTION_TYPE='$content->transactionType'";

$result = $conn->query($sql);

$response->code    = "";
$response->message = "";
$response->data    = "";

$res->transactionAmount=0;

if ($result->num_rows >= 1)
    while ($row = $result->fetch_assoc()) {
        $res->transactionAmount    += $row['TRANSACTION_AMOUNT'];
    }

if ($result->num_rows >= 1) {
    $response->code    = "S000";
    $response->message = "Success";
    $response->data    = json_encode($res, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
} else {
    $response->code    = "E000";
    $response->message = "Error : " . $sql;
    $response->data    = json_encode($res, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

$conn->close();

?>