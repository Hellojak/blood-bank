<?php
// Establish database connection
$conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);
  

  // Insert data into database
  $sql = "INSERT INTO hospital_records (H_name, H_address, H_phone, H_email, H_password, H_id) VALUES ('$name', '$address', '$phone', '$email', '$password', '0')";

  if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close database connection
  mysqli_close($conn);
}

?>
<a href="hospital_login_page.html">login</a>
