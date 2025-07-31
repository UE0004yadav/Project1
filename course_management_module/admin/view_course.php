<?php
// to showing the error
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "registration_system";
$port = "3307";

// 2. Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// 3. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM courses");

echo "<table border='1' style ='width: 80%; height: 50%;font-size:16px; text-align: center;' >
<tr style= 'bg-color: #5c9bf8ff;'>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>ID</th>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>Title</th>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>Total Seats</th>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>Avai. Seats</th>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>Created_by</th>
<th style='padding: 10px; color:red; background-color: white; font-weight:bold; font-size:1.5rem'>Actions</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td> {$row['course_id']} </td>
        <td> {$row['title']} </td>
        <td> {$row['total_seats']} </td>
        <td> {$row['available_seats']} </td>
        <td> {$row['created_by']} </td>
        <td style ='font-size:1.5rem;'>
            <a href='edit_course.php?id={$row['course_id']}'>Edit</a> |
            <a href='delete_course.php?id={$row['course_id']}' onclick=\"return confirm('Delete?')\">Delete</a> |
            <a href='add_course.php?id={$row['course_id']}' onclick=\"return confirm('Add?')\">Add</a>
        </td>
    </tr>";
}
echo "</table>";
?>
