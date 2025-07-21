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

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['name']; 
$age = $data['age'];

$sql = "INSERT INTO users (username, age) VALUES (?, ?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $con->error
    ]);
    exit;
}

$stmt->bind_param("si", $username, $age);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "User added successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Insert failed: " . $stmt->error
    ]);
}
?>
