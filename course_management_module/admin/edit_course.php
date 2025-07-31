<?php
// to showing the error
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "register";
$port = "3307";

// 2. Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// 3. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $seats = $_POST['seats'];

    $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ?, duration = ?, seats = ? WHERE course_id = ?");
    $stmt->bind_param("sssis", $title, $description, $duration, $seats, $course_id);
    

    if ($stmt->execute()) {
        echo "Course updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Edit course panel</title>
</head>
<style> 


 
.btn{
    background-color: #fc1e2a;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    border: 2px solid rgb(19, 8, 8);
    margin-left: 30%;
    margin-top: 35px;
}
.formsection{
    background-color: lightcoral;
    border: 2px solid black;
    width: 300px;
    height: 350px;
}
.edit_form{
    margin-top: 1cm;
}
.inputbox{
    margin-left: 1cm;
}
label {
    margin-left: 10px;
}
</style>
<body>
    <div class="formsection">
<form method="POST" action="edit_course.php" class="edit_form">
  <label for="text"><strong> Course ID:</strong></label><br><strong>
  <input type="text" name="course_id" placeholder="Course ID" required class="inputbox"><br/>
  <label for="text"><strong>Course Title:</strong></label><br/>
  <input type="text" name="title" placeholder="Course Title" required class="inputbox"><br/>
  <label for="text"><strong>Description:</strong></label><br>
  <textarea name="description" placeholder="Description" class="inputbox"></textarea><br/>
  <label for="text"><strong>Duration:</strong></label><br/>
  <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required class="inputbox"><br/>
  <label for="text"><strong>Seats:</strong></label><br/>
  <input type="number" name="seats" placeholder="Available Seats" required class="inputbox"><br/>
  <button type="submit" class="btn">Edit Course</button>
    </form>
    </div>
</body>
</html>
