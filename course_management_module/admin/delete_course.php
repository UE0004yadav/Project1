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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    
    // DELETE query
    $sql = "DELETE FROM courses WHERE course_id='$course_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Course deleted successfully!";
    } else {
        echo "Error deleting course: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Delete course panel</title>
</head>
<style> 


    .hero2{
    background-color: rgb(115, 208, 231);
    border: 2px solid black;
    margin-left: 5%;
    margin-top: 0.4cm;
   
    padding: 10px;
    height: 65%;
    width: 25%;
    color: black;
    font-size: 2.0 rem;
    font-weight: bold;
    font-style: none;
    line-height: 1cm;
}
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
    background-color: wheat;
    border: 2px solid black;
    width: 300px;
    height: 350px;
}
.delet_form{
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
<form method="POST" action="delete_course.php" class="delet_form">
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
  <button type="submit" class="btn">Delete Course</button>
    </form>
    </div>
</body>
</html>