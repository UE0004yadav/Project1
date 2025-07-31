<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'student_module\db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($role === "student" || $role === "admin") {
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM users WHERE email='$email' AND role='$role'";
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
           if (password_verify($password, $row['password'])) {
                $_SESSION["user_id"] = $row["user_id"]; 
                $_SESSION["user_name"] = $row["name"];
                $_SESSION["role"] = $role;    
                //echo "Session set: " . $_SESSION["user_id"];
                if ($role == "student") { header("Location: http://localhost:8080/Projects/student_module/dashboard.php");} 
                    else { header("Location: http://localhost:8080/projects/course_management_module/admin/admin.html"); }
                exit;
                }
                else { echo "❌ Incorrect password.";}
                } else { echo "❌ No user found with that email and role.";}
                } else { echo "❌ Invalid role selected."; } 
              }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=2" type="text/css">
    <title>Login form </title>
</head>
<body class="bdy">
          <form class="login_form" action="" method="post">
          <div class="Welcome_back">
            Welcome back
          <div class="Login_to_your_account">
            <h1> Login to your account</h1>
          </div>        
          </div>          
          <div class="input_crediantial">
            <label for="email">Email:</label><br>
            <input class='fields' type="email" id="email" name="email" placeholder="you@example.com" required><br>

            <label for="password">Password:</label><br>
            <input class='fields' type="password" id="password" name="password" placeholder="password" required><br>

            <label for="role">Role:</label><br>
                <select id="role" name="role" required>

                 <option value="">-- Select a Role --</option>
                 <option value="admin">Admin</option>
                 <option value="student"> Student</option>
                </select><br> 
            </div>
            <button class="loginbtn" type="submit"> Login</button><br>
            <p class="forgot_pass">Forgot Password</p> 
        </form>
</body>
</html>

