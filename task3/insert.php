<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $id         = (int)$_POST['id'];
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $age        = (int)$_POST['age'];

   
    if (!empty($first_name) && !empty($last_name) && $age > 0) {
        
        $stmt = $connect->prepare("INSERT INTO users (id, first_name, last_name, age) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id, $first_name, $last_name, $age);

        if ($stmt->execute()) {
            header("Location: view.php");
            exit;
        } else {
            echo "❌ failed " . $connect->error;
        }
    } else {
        echo "❌ please enter all";
    }
} else {
    header("Location: view.php");
    exit;
}
?>