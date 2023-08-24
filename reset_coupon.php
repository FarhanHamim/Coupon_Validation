<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "coupon_db";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$checkSql = "SELECT * FROM coupons WHERE used != 0";
$checkResult = $conn->query($checkSql);

$response = array("success" => false, "alreadyReset" => false);

if ($checkResult->num_rows > 0) {
    $sql = "UPDATE coupons SET used = 0";
    $result = $conn->query($sql);

    if ($result) {
        $response["success"] = true;
    }
} else {
    $response["alreadyReset"] = true;
}

echo json_encode($response);

$conn->close();
?>