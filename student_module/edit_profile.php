<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile module</title>
</head>
<body>
    <?php include("includes/db.php"); include("includes/header.php");
$student_id = $_SESSION['student_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$student_id'");
    echo "<p>Profile updated successfully.</p>";
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$student_id'");
$row = mysqli_fetch_assoc($result);
?>

<h2>Edit Profile</h2>
<form method="POST">
  Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
  Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
  <input type="submit" value="Update">
</form>

<?php include("includes/footer.php"); ?>

</body>
</html>