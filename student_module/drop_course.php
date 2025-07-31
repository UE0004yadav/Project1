<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop course module</title>
</head>
<body>
    <?php
include("includes/db.php");
$reg_id = $_GET['reg_id'];
mysqli_query($conn, "DELETE FROM registrations WHERE id = '$reg_id'");
header("Location: registered_courses.php");
?>

</body>
</html>