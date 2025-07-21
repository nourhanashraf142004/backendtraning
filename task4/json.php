<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); 
    echo json_encode([
        "success" => false,
        "message" => "Only GET requests are allowed"
    ]);
    exit;
}

require_once 'db.php';

$result = $con->query("SELECT * FROM users");

if (!$result) {
    http_response_code(500); 
    echo json_encode([
        "success" => false,
        "message" => "Query failed: " . $con->error
    ]);
    exit;
}

$response = [
    "success" => true,
    "count" => $result->num_rows,
    "users" => []
];

while ($row = $result->fetch_assoc()) {
    $response["users"][] = [
        "id" => $row["id"],
        "name" => $row["username"],
        "age" => $row["age"],
        "update_url" => "update.php?id=" . $row["id"],
        "delete_url" => "delete.php?id=" . $row["id"]
    ];
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>