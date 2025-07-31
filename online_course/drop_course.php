<?php
session_start();
include 'db_config.php';

if (isset($_GET['reg_id'])) {
    $reg_id = $_GET['reg_id'];
    $sql = "DELETE FROM registrations WHERE id = $reg_id";
    $conn->query($sql);
}

header("Location: student_dashboard.php");
exit();
