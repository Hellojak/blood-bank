<?php
// Start session




// Check if form submitted
if (isset($_POST['add_blood_info'])) {
	// Get form data and sanitize
    
	$blood_type = htmlspecialchars(trim($_POST['blood_type']));
	$quantity = htmlspecialchars(trim($_POST['quantity']));

	// Validate form data
	$errors = array();
	if (empty($blood_type)) {
		$errors[] = "Blood type is required";
	}
	if (empty($quantity)) {
		$errors[] = "Quantity is required";
	} else if (!is_numeric($quantity)) {
		$errors[] = "Quantity must be a number";
	} else if ($quantity <= 0) {
		$errors[] = "Quantity must be greater than 0";
	}

	// If no errors, insert blood info into database
	if (empty($errors)) {
		// Connect to database
		
        $conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Insert blood info into database
		$sql = "INSERT INTO blood_records (blood_type, available_units, Blood_id) VALUES ('$blood_type', '$quantity','0')";
        
		if (mysqli_query($conn, $sql)) {
			// Redirect to available blood samples page
			header('Location: available_blood_samples.php');
			exit();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
}
?>

