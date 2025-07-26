<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "register";
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
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $higher_education = $_POST['higher_education'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];

    // Insert into table
    //$sql = "INSERT INTO users (name, email, password, contact, address, course, higher_education, role, gender)
           // VALUES ('$name', '$email', '$password', '$contact', '$address', '$course', '$higher_education', '$role', '$gender')";

  // Insert into correct table
if ($role == 'student') {
     $sql = "INSERT INTO users (name, email, password, contact, address, course, higher_education, role, gender)
            VALUES ('$name', '$email', '$hashed_password', '$contact', '$address', '$course', '$higher_education', '$role', '$gender')"; 
} elseif ($role == 'admin') {
     $sql = "INSERT INTO administration (name, email, password, contact, address, course, higher_education, role, gender)
            VALUES ('$name', '$email', '$hashed_password', '$contact', '$address', '$course', '$higher_education', '$role', '$gender')";
}elseif ($role == 'subadmin') {
     $sql = "INSERT INTO administration (name, email, password, contact, address, course, higher_education, role, gender)
            VALUES ('$name', '$email', '$hashed_password', '$contact', '$address', '$course', '$higher_education', '$role', '$gender')";
}elseif ($role == 'faculty') {
     $sql = "INSERT INTO faculty (name, email, password, contact, address, course, higher_education, role, gender)
            VALUES ('$name', '$email', '$hashed_password', '$contact', '$address', '$course', '$higher_education', '$role', '$gender')";
}
 else {
    die("Invalid role selected");
}

    if ($conn->query($sql) === TRUE) {
  // Redirect back to form after successful insert
  header("Location: register.html");
  exit;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


    $conn->close();
    }
    ?>
