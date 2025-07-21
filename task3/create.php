<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_db";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $id = $_POST["id"];
    $age = $_POST["age"];

    $sql = "INSERT INTO users (id, first_name, last_name, age)
            VALUES ('$id', '$firstName', '$lastName', '$age')";

    if (mysqli_query($conn, $sql)) {
        $message = "User Added Successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            width: 150px;
        }

        input {
            padding: 6px 10px;
            font-size: 16px;
            width: 150px;
        }

        button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Add User</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" required>
    </div>

    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" required>
    </div>

    <div class="form-group">
        <label for="id">ID</label>
        <input type="text" id="id" name="id" required>
    </div>

    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" required>
    </div>

    <button type="submit">Save</button>
    <button type="button" onclick="window.location.href='index.html'">Back to Home</button>
</form>

<?php
if (isset($message)) {
    echo "<div class='result'>$message</div>";
}
?>

</body>
</html>