<?php


// Connect to the database

$conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and sanitize form data
$blood_type = mysqli_real_escape_string($conn, $_POST['blood_type']);
$units_available = mysqli_real_escape_string($conn, $_POST['units_available']);

if (empty($blood_type) || empty($units_available)) {
	echo "Please fill all the fields";
	exit();
}

// Insert the data into the database
$sql = "INSERT INTO blood_records (blood_type, available_units, Blood_id) VALUES ('$blood_type', '$units_available', '0')";

if (mysqli_query($conn, $sql)) {
    echo "Blood Info Added Successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>


