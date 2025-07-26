<?php
include '../includes/db_connect.php';
$result = $conn->query("SELECT * FROM courses");

echo "<table border='1'>
<tr><th>ID</th><th>Title</th><th>Seats</th><th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['course_id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['seats']}</td>
        <td>
            <a href='edit_course.php?id={$row['course_id']}'>Edit</a> |
            <a href='delete_course.php?id={$row['course_id']}' onclick=\"return confirm('Delete?')\">Delete</a>
        </td>
    </tr>";
}
echo "</table>";
?>
