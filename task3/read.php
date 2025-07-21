<?php
require 'db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["Id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["First_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Last_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Age"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found.</td></tr>";
}
?>