<?php
session_start();
session_unset();  // Sabhi session variables clear kar do
session_destroy(); // Session destroy kar do

// User ko login page par redirect karo
header("Location: login.php");
exit();
?>
