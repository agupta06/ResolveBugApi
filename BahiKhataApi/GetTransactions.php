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

$sql = "SELECT * from TRANSACTION_DETAILS where TRANSACTION_USER LIKE '$content->transactionUser'";

$result = $conn->query($sql);

$response->code    = "";
$response->message = "";
$response->data    = "";

$item = array();

if ($result->num_rows >= 1)
    while ($row = $result->fetch_assoc()) {
        $res->transactionId        = $row['TRANSACTION_ID'];
        $res->transactionDate      = $row['TRANSACTION_DATE'];
        $res->transactionTime      = $row['TRANSACTION_TIME'];
        $res->transactionTimeZone  = $row['TRANSACTION_TIMEZONE'];
        $res->transactionType      = $row['TRANSACTION_TYPE'];
        $res->transactionAmount    = $row['TRANSACTION_AMOUNT'];
        $res->transactionMessage   = $row['TRANSACTION_MESSAGE'];
        $res->transactionFavourite = $row['TRANSACTION_FAVOURITE'];
        $resu                      = json_encode($res, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $item[]                    = $resu;
    }

if (count($item) == 0) {
    $response->code    = "E000";
    $response->message = "Error : " . $sql;
    $response->data    = json_encode($item, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
} else {
    $response->code    = "S000";
    $response->message = "Success";
    $response->data    = json_encode($item, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

$conn->close();

?>