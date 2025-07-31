<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['reg_id'])) {
    $reg_id = $_GET['reg_id'];

    $conn = new mysqli("localhost", "root", "", "registration_system", 3307);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ensure this registration belongs to the student
    $check = "SELECT * FROM registrations WHERE reg_id = ? AND student_id = ?";
    $stmt = $conn->prepare($check);
    $stmt->bind_param("ii", $reg_id, $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Delete the registration
        $delete = "DELETE FROM registrations WHERE reg_id = ?";
        $stmt2 = $conn->prepare($delete);
        $stmt2->bind_param("i", $reg_id);
        if ($stmt2->execute()) {
            echo "<script>alert('Course unregistered successfully!'); window.location.href='registered_courses.php';</script>";
        } else {
            echo "Error while deleting registration.";
        }
    } else {
        echo "Invalid registration or permission denied.";
    }
} else {
    echo "Invalid request.";
}
?>
