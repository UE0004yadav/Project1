<?php
include '../includes/db_connect.php';
$result = $conn->query("SELECT * FROM courses");

echo "<h2>Available Courses</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div>
        <h3>{$row['title']}</h3>
        <p>{$row['description']}</p>
        <p><strong>Duration:</strong> {$row['duration']} | <strong>Seats:</strong> {$row['seats']}</p>
    </div><hr>";
}
?>
