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


// 4. Get and sanitize form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = trim ( $_POST['course_id']);
    $title = trim ($_POST['title']);
    $description = trim ($_POST['description']);
    $duration = trim ($_POST['duration']);
    $total_seats = trim($_POST['total_seats']);
    $available_seats = trim($_POST['available_seats']);
    $created_by = trim($_POST['created_by']);

    // 5. Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO courses (course_id, title, description, duration, total_seats, available_seats, created_by) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
     if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
       }

    //6. Bind parameters correctly (5values) 
     $stmt->bind_param("ssssiii", $course_id, $title, $description, $duration, $total_seats, $available_seats, $created_by);

    // 7. Execute and check success
    if ($stmt->execute()) {
        echo "Course added successfully.";
    } else {
       echo "Error executing: ". $stmt->error;

    }
    $stmt->close();
   } 

// 7. Close connections

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_course.css">
    <title>document for Admin </title>
</head>
<body>
  <div class="container">
    <h1></h1>
  </div>
  
<div class="hero">
<form method="POST" action="add_course.php">
  <label for="text">Course ID:</label>&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="course_id" placeholder="Course ID" required><br/>
  <label for="text">Course Title:</label>&nbsp;
  <input type="text" name="title" placeholder="Course Title" required><br/>
  <label for="text">Description:</label>&nbsp;&nbsp;&nbsp;
  <textarea name="description" placeholder="Description"></textarea><br/>

  <label for="text">Duration:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required><br/>

  <label for="text"> Total Seats:</label>
  <input type="number" name="total_seats" placeholder="Total Seats" required><br/>

  <label for="text">Avail. Seats:</label>
  <input type="number" name="available_seats" placeholder="Available Seats" required><br/>

  <label for="text">Created By:</label>
  <input type="number" name="created_by" placeholder="created_by" required><br/>

  <button type="submit" class="btn">Add Course</button>
</form>
</div>

<!-- <div class="hero1">
<form method="POST" action="edit_course.php">
  <label for="text">Course ID:</label>&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="course_id" placeholder="Course ID" required><br/>
  <label for="text">Course Title:</label>&nbsp;
  <input type="text" name="title" placeholder="Course Title" required><br/>
  <label for="text">Description:</label>&nbsp;&nbsp;&nbsp;
  <textarea name="description" placeholder="Description"></textarea><br/>
  <label for="text">Duration:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required><br/>
  <label for="text">Seats:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="number" name="seats" placeholder="Available Seats" required><br/>
  <button type="submit" class="btn">Edit Course</button>
</form>
</div>

<div class="hero2">
<form method="POST" action="delete_course.php">
  <label for="text">Course ID:</label>&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="course_id" placeholder="Course ID" required><br/>
  <label for="text">Course Title:</label>&nbsp;
  <input type="text" name="title" placeholder="Course Title" required><br/>
  <label for="text">Description:</label>&nbsp;&nbsp;&nbsp;
  <textarea name="description" placeholder="Description"></textarea><br/>
  <label for="text">Duration:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required><br/>
  <label for="text">Seats:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="number" name="seats" placeholder="Available Seats" required><br/>
  <button type="submit" class="btn">Delete Course</button> -->
</form>
</div>


</body>
</html>

