<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require '../db_connection.php';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM tbl_account WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'found', 'message' => 'Email is registered']);
    } else {
        echo json_encode(['status' => 'not_found', 'message' => 'Email is not registered']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Email not provided']);
}
$conn->close();
