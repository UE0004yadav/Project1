<?php
session_start();
include 'includes\db.php';
if (!isset($_SESSION['student_id'])) {
  header("Location: ../login.php");
  exit;
}
$student_id = $_SESSION['student_id']; // Assume student login is already handled

// Fetch student details
$student_sql = "SELECT * FROM students WHERE id = $student_id";
$student_result = $conn->query($student_sql);
$student = $student_result->fetch_assoc();

// Fetch registered courses
$course_sql = "SELECT c.course_id, c.title, r.id as reg_id
               FROM registrations r
               JOIN courses c ON r.course_id = c.course_id
               WHERE r.student_id = $student_id";
$course_result = $conn->query($course_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="student_panel.css">
    <title>student panel </title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-3">Welcome, <?php echo $student['name']; ?></h3>>
    <!-- Profile Info -->
    <div class="card mb-4">
        <div class="card-header">Your Profile</div>
        <div class="card-body">
            <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
            <a href="edit_profile.php" class="btn btn-primary btn-sm">Edit Profile</a>
        </div>
    </div>
     <!-- Registered Courses -->
    <div class="card">
        <div class="card-header">Registered Courses</div>
        <div class="card-body">
            <?php if ($course_result->num_rows > 0): ?>
                <ul class="list-group">
                    <?php while($row = $course_result->fetch_assoc()): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $row['title']; ?>
                            <a href="drop_course.php?reg_id=<?php echo $row['reg_id']; ?>" class="btn btn-danger btn-sm">Drop</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No courses registered.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>