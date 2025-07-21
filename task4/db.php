<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "crud_api";

$con = new mysqli($host, $user, $pass, $dbname);

if ($con->connect_error) {
    header('Content-Type: application/json');
    http_response_code(500); 
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $con->connect_error
    ]);
    exit;
}