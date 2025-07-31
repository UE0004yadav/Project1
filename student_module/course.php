<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course module for students</title>
</head>
<body>
    <?php include("includes/db.php"); include("includes/header.php");

$result = mysqli_query($conn, "SELECT * FROM courses");

echo "<h2>Available Courses</h2><table border='1'>";
echo "<tr><th>Course Name</th><th>Description</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['course_name']}</td>";
    echo "<td>{$row['description']}</td>";
    echo "<td><a href='register_course.php?course_id={$row['id']}'>Register</a></td>";
    echo "</tr>";
}
echo "</table>";

include("includes/footer.php");
?>

</body>
</html>