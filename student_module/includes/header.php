<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Optional: Security check
if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php"); // Adjust path if needed
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Panel - Online Course Registration</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Path may vary -->
    <style>
        /* Optional inline CSS if no external style.css used */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f8fc;
        }
        header {
            background-color: #0077cc;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }
        nav a {
            margin: 0 10px;
            color: white;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h2>Student Dashboard</h2>
    <nav>
        <a href="../student/dashboard.php">Home</a>
        <a href="../student/courses.php">Courses</a>
        <a href="../student/registered_courses.php">My Courses</a>
        <a href="../student/edit_profile.php">Edit Profile</a>
        <a href="../logout.php">Logout</a>
    </nav>
</header>
<main>
