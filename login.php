<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "register";
$port = 3307;

$conn = new mysqli($host, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Prepare and execute query
$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ? AND role = ?");
$stmt->bind_param("ss", $email, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Check password
    if (password_verify($password, $user['password'])) {
        //  Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        echo "Welcome, " . $user['name'] . " (" . $user['role'] . ")";

        // Optional: Redirect based on role
        
        if ($user['role'] === 'admin') {
            header("Location:course_management_module/admin/add_course.PHP");
        } elseif ($user['role'] === 'student') {
            header("Location: student_dashboard.php");
        } else {
            header("Location: faculty_dashboard.php");
        }
        exit;
    
    } else {
        echo " Incorrect password.";
    }
} else {
    echo " User not found or wrong role.";
}



$stmt->close();
$conn->close();
?>
