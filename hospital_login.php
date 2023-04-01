<?php
// start session
session_start();

// connect to database


$conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");

// check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// get username and password from form
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$password = password_hash($password, PASSWORD_DEFAULT);
	// check if username and password match database record
	$sql = "SELECT * FROM hospital_records WHERE H_email = '$username'";
	$result = mysqli_query($conn, $sql);

    echo mysqli_num_rows($result);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
       

		if (password_verify($password, $row["H_password"])) {
			// set session variables and redirect to hospital dashboard
			// $_SESSION["hospital_id"] = $row["H_id"];
			// $_SESSION["hospital_name"] = $row["H_email"];
			header("Location: available_blood_samples.php");
			exit();
		} else {
			// display error message
			echo "Invalid username or password";
		}
	} else {
		// display error message
		echo "Invalid username or password";
	}

	// close database connection
	mysqli_close($conn);
}
?>
