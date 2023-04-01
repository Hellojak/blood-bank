<?php
// Connect to the MySQL database

$conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate the form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = password_hash($password, PASSWORD_DEFAULT);

if (empty($name) || empty($address) || empty($contact) || empty($blood_group) || empty($username) || empty($password)) {
    echo "All fields are required.";
} else {
    // Insert the receiver details into the database
    $sql = "INSERT INTO receivers_records (R_name, R_address, R_contact, R_blood_group, R_username, R_password, R_id) VALUES ('$name', '$address', '$contact', '$blood_group', '$username', '$password','0')";
    if ($conn->query($sql) === TRUE) {
        echo "Receiver registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
