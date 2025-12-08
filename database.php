<?php
$servername = 'localhost';
$username = 'student_2501';
$password = 'pass2501';
$db_name = 'student_2501';

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	echo "You connected";
}
?>