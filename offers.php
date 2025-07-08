<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "beauty");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}


$sql = "SELECT * FROM offers";
$result = $conn->query($sql);
$offers = [ ];

while ($row = $result->fetch_assoc()) {
    $offers[] = $row;
}

echo json_encode($offers);
$conn->close();
?>
