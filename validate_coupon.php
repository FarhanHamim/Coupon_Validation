<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "coupon_db";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$couponCode = $_GET['code'];
$sql = "SELECT * FROM coupons WHERE code = '$couponCode' AND used = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $coupon = $result->fetch_assoc();
    $discount = $coupon['discount'];

    $couponId = $coupon['id'];
    $updateSql = "UPDATE coupons SET used = 1 WHERE id = $couponId";
    $conn->query($updateSql);

    $response = array("valid" => true, "discount" => $discount);
} else {
    $response = array("valid" => false);
}

echo json_encode($response);

$conn->close();
?>