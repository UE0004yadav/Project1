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

// Fetch registered courses for this student
$sql = "SELECT r.reg_id, c.course_id, c.title, c.duration, r.reg_date
        FROM registrations r
        JOIN courses c ON r.course_id = c.course_id
        WHERE r.student_id = $student_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registered Courses</title>
</head>
<body>
    <h2>My Registered Courses</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Course ID</th>
                <th>Title</th>
                <th>Duration</th>
                <th>Registration Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['course_id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['duration'] ?></td>
                    <td><?= $row['reg_date'] ?></td>
                    <td>
                        <a href="withdraw.php?reg_id=<?= $row['reg_id'] ?>" 
                           onclick="return confirm('Are you sure you want to withdraw from this course?')">
                           Withdraw</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You are not registered in any courses.</p>
    <?php endif; ?>
</body>
</html>
