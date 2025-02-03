<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header('Access-Control-Allow-Headers: Content-Type');

require '../db_connection.php';


$sql = "SELECT office FROM tbl_office";
$result = $conn->query($sql);

$offices = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $offices[] = $row["office_name"];
    }
}

echo json_encode(["offices" => $offices]);

$conn->close();
