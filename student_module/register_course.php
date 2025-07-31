<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "registration_system", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all available courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
</head>
<body>
    <h2>Available Courses</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Course ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Total Seats</th>
            <th>Available Seats</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['course_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['duration']}</td>
                    <td>{$row['total_seats']}</td>
                    <td>{$row['available_seats']}</td>
                    <td><a href='do_register.php?course_id={$row['course_id']}'
                           onclick=\"return confirm('Register for this course?')\">Register</a></td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
