<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$_SESSION['role'] = 'admin';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // If admin is not login in then redirect on login page back
    header("Location: ../login.php");
    exit;
}

require 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    // echo "Welcome, " . $admin['name'];
} else {
    echo "Admin not found!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Welcome to Admin dashboard</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
<h2>Welcome, <?php echo $_SESSION['admin_name']; ?>!</h2>
<ul>
  <li><a href="add_course.php">Add Courses</a></li>
  <li><a href="delete_course.php">Delete Courses</a></li>
  <li><a href="edit_course.php">Edit courses</a></li>
  <li><a href="manage_course.php">Manage Courses</a></li>
  <li><a href="view_course.php">View Courses</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<?php include("includes/footer.php"); ?>

    
</body>
</html>