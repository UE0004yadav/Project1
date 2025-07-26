<?php
include '../includes/db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM courses");

echo "<h2>Available Courses</h2>";
echo "<form method='POST' action='register_course.php'>";
while ($row = $result->fetch_assoc()) {
    if ($row['seats'] > 0) {
        echo "<input type='checkbox' name='courses[]' value='{$row['course_id']}'> 
              <strong>{$row['title']}</strong> ({$row['seats']} seats available)<br>";
    } else {
        echo "<strike>{$row['title']}</strike> (Full)<br>";
    }
}
echo "<br><button type='submit'>Register</button>";
echo "</form>";


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['courses'])) {
    foreach ($_POST['courses'] as $course_id) {
        // Check if already registered
        $check = $conn->query("SELECT * FROM registrations WHERE user_id = $user_id AND course_id = '$course_id'");
        if ($check->num_rows > 0) {
            echo "Already registered for course $course_id.<br>";
            continue;
        }

        // Check seat availability
        $checkSeats = $conn->query("SELECT seats FROM courses WHERE course_id = '$course_id'");
        $seatRow = $checkSeats->fetch_assoc();

        if ($seatRow['seats'] > 0) {
            // Register course
            $conn->query("INSERT INTO registrations (user_id, course_id) VALUES ($user_id, '$course_id')");

            // Reduce seat count
            $conn->query("UPDATE courses SET seats = seats - 1 WHERE course_id = '$course_id'");

            // ✅ FR3.5: Confirmation message
            echo "Successfully registered for course $course_id.<br>";
        } else {
            echo "No seats available for course $course_id.<br>";
        }
    }
}

?>
