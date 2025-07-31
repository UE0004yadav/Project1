<?php
session_start();
include 'db_config.php';
$student_id = $_SESSION['student_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update_sql = "UPDATE students SET name='$name', email='$email' WHERE id=$student_id";
    $conn->query($update_sql);
    header("Location: student_dashboard.php");
    exit();
}

$sql = "SELECT * FROM students WHERE id=$student_id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h4>Edit Your Profile</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="student_dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
