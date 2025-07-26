<?php
include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $conn->query("DELETE FROM courses WHERE course_id='$course_id'");
    header("Location: manage_courses.php");
}
?>

