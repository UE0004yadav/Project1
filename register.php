<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "registration_system";
    $port = 3307;

    // Connect to database
    $conn = new mysqli($host, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check for existing email
$check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "Email already registered. Please try another.";
    exit;
}
$check->close();

    
    // Insert into table
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

if ($stmt->execute()) {
    header("Location: register.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();

$conn->close();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register Now</title>
      <style>
        
   body{
    background-image: url('Images/library.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    width: 98%;
    margin: 10px;
    display: flex;
    position: relative;
    border-radius: 10px;
    }
    .form-container{
      background-color: lightgoldenrodyellow;
      border: none;
      margin: 2cm;
      border-radius: 10px;
      height: 70vh;
      width: 25vw;
      padding: 10px;
    }
    .form-container h2{
      color: green;
      font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: 2.0rem;
    }
    form{
      line-height: 1.8;
      display: block;
      margin-left: 1cm;
      margin-top: -1.5cm;
    }
    .text{
      margin-top: 0;
      padding: 0;
    }
    .registerbtn{
      background-color: green;
      color: white;
      font-weight: bold;
      border-radius: 6px;
      text-align: center;
      margin-left: 2cm;
      margin-top: 0.8cm;
      height: 30px;
      width: 100px;
    }
    
      </style>
    </head>
    <body>
      <section class="hero">        
    <div class="form-container">
    <h2>Register Now</h2><br><br><br>
    <form action="register.php" method="POST">
      <label for="name" class="text">Full Name:</label><br>
      <input class='fields'  type="text" id="name" name="name" placeholder=" Your full name" required><br>
        
      <label for="email">Email:</label> &nbsp;<br>
      <input class='fields'   type="email" id="email" name="email" placeholder=" you@example.com" required><br>

      <label for="password">Password:</label><br>
      <input class='fields'  type="password" id="password" name="password" placeholder=" Create a password" required minlength="8"><br>
      <label for="role">Select Role:</label><br>
      <select id="role" name="role" required>
        <option value="">--Select Role --</option>
        <option value="admin">Admin</option>
        <option value="student">Student</option>
      </select><br/>
      <button class="registerbtn" type="submit">Register</button>
       </div>   
  

        

      
    </form>
  </div>
</section>
    </body>
    </html>
