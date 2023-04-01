<?php
// Start session
session_start();

// Include database connection
include 'db_connect.php';

// Get form data
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = password_hash($password, PASSWORD_DEFAULT);

// Query to check if receiver exists with the provided email and password
$query = "SELECT * FROM receivers_records WHERE R_username='$email' AND password=MD5('$password')";
$result = mysqli_query($conn, $query);

// Check if a row is returned
if(mysqli_num_rows($result) == 1) {
	// Get receiver data
	$row = mysqli_fetch_assoc($result);

	// Set session variables

	$_SESSION['receiver_id'] = $row['R_id'];
	$_SESSION['receiver_name'] = $row['R_name'];
	$_SESSION['receiver_email'] = $row['R_username'];
	$_SESSION['receiver_blood_group'] = $row['R_blood_group'];

	// Redirect to receiver dashboard
	// header('Location: receiver_dashboard.php');
    header('Location: available_blood_samples.php');
	exit();
} else {
	// Redirect back to login page with error message
	$_SESSION['error'] = 'Invalid email or password.';
	header('Location: register_receiver.html');
    
	exit();
}
?>
