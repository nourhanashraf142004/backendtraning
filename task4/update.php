<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo json_encode([
        "success" => false,
        "message" => "Only POST requests are allowed"
    ]);
    exit;
}

require_once 'db.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Missing ID in URL"
    ]);
    exit;
}

$id = $_GET['id'];

if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Content-Type must be application/json"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name']) || !isset($data['age'])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Missing fields in JSON body: name and age"
    ]);
    exit;
}

$name = $data['name'];
$age = $data['age'];

// تحقق من وجود المستخدم أولاً
$checkSql = "SELECT id FROM users WHERE id = ?";
$checkStmt = $con->prepare($checkSql);
$checkStmt->bind_param("i", $id);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows === 0) {
    http_response_code(404);
    echo json_encode([
        "success" => false,
        "message" => "User with ID $id not found"
    ]);
    exit;
}

$sql = "UPDATE users SET username = ?, age = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $con->error
    ]);
    exit;
}

$stmt->bind_param("sii", $name, $age, $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "success" => true,
            "message" => "User with ID $id updated successfully"
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "No changes were made (data is identical)"
        ]);
    }
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Update failed: " . $stmt->error
    ]);
}
?>