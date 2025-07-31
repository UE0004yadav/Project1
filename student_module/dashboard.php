<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

//$_SESSION['user_id'] = 2;
$_SESSION['role'] = 'student';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    // If student is not login in then redirect on login page back
    header("Location: ../login.php");
    exit;
}
require 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $student = $result->fetch_assoc();
    // echo "Welcome, " . $student['name'];
} else {
    echo "Student not found!";
}

//echo "<h3>Your Registered Courses</h3>";
// for fatching the registered course details
$sql = "SELECT r.reg_id, c.course_id, c.title, c.duration
        FROM registrations r
        JOIN courses c ON r.course_id = c.course_id
        WHERE r.student_id = $user_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Student panel</title>
    <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: whitesmoke;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #0b7401;
      color: white;
      padding: 12px 20px;
      width: 97%;
      height: auto;
      border-radius: 5px;
      
    }

    .navbar-left, .navbar-right {
      display: flex;
      align-items: center;
    }

    .navbar-left i {
      margin-right: 8px;
    }

    .navbar-left span {
      margin: 0 6px;
    }

    .navbar-right .profile {
      margin-right: 15px;
    }

    .logout-btn {
      background-color: #ff4d4d;
      border: none;
      padding: 6px 12px;
      color: white;
      font-style: none;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    .logout-btn:hover {
      background-color: #e60000;
    }
    .view_table{
       margin-left: 4cm;     
     
    }
    iframe{
      width: 100%;
      height:400px;
      border: none;
      
    }
    .heading h2{
        color: green;
        font-size: 3rem;
        font-weight: bold;
        font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
    }
    ul{
        display: flex;
        position: relative;
        justify-content: space-around;
        list-style: none;
    
    }
  </style>
</head>
<body>
   <div class="navbar">
    <div class="navbar-left">
      <i class="fas fa-home"></i>
      <span>/</span>
      <strong>Dashboard</strong>
    </div>

    <div class="navbar-right">
      <div class="profile"><strong><?php echo "Welcome, " . $student['name'];?> </strong></div>
      <button class="logout-btn">Logout </button>
    </div>
  </div>
  <div class="heading">
     <h2>Welcome to the Student panel</h2>
  </div>  
<nav class="navbar2">
<ul><li><a href="http://localhost:8080/Projects/student_module/register_course.php">
  <button style="padding:10px 20px; background-color:#0b7401; color:white; border:none; border-radius:5px;">
    Register & View Courses
  </button>
</a>
</li>
   <li><a href="http://localhost:8080/Projects/student_module/registered_courses.php">
  <button style="padding:10px 20px; background-color:#0b7401; color:white; border:none; border-radius:5px;">
    My Registered Courses
  </button>
</a></li>
  
   <li><a href="withdraw.php?reg_id=<?= $row['reg_id'] ?>" 
   onclick="return confirm('Are you sure you want to unregister from this course?');">
  <button style="padding:10px 20px; background-color:#0b7401; color:white; border:none; border-radius:5px;">
    Delete regisration
  </button>
</a></li>
</ul>
</nav>

  <h2>Registered Courses</h2>
  <div class="view_table">
    <?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr><th>Course ID</th><th>Title</th><th>Duration</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['course_id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['duration']}</td>
                <td><a href='withdraw.php?reg_id={$row['reg_id']}'
                       onclick=\"return confirm('Are you sure to drop this course?')\">Withdraw</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "You are not registered in any courses.";
}

?>

  </div>
    
    
</body>
</html>