<!DOCTYPE html>
<html>
<head>
	<title>Available Blood Samples</title>
</head>
<body>
	<h2>Available Blood Samples</h2>
	<table>
		<thead>
			<tr>
                <th>Blood Id</th>
				<th>Blood Type</th>
				<th>Available Units</th>
			
                
			</tr>
		</thead>
		<tbody>
			<?php
				// Connect to the database
				
                $conn = mysqli_connect("localhost:3307", "root", "", "blood_bank_database");

				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}

				// Retrieve available blood samples from the database
				$sql = "SELECT * FROM blood_records";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
				    // Output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				        echo "<tr>";
                        echo "<td>" . $row["Blood_id"] . "</td>";
				        echo "<td>" . $row["blood_type"] . "</td>";
				        echo "<td>" . $row["available_units"] . "</td>";        
				        echo "</tr>";
				    }
				} else {
				    echo "No available blood samples.";
				}

				mysqli_close($conn);
			?>
		</tbody>
	</table>
	<a href="hospital_add_blood_info.html">Add Blood Info</a>
	<a href="#">Home</a>
</body>
</html>
