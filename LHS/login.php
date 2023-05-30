<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "Rbj100700";
$dbname = "student";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check for errors
if (mysqli_connect_errno()) {
	die("Failed to connect to database: " . mysqli_connect_error());
}

// Get the user's name and RFID tag from the login form
$rfid = $_POST['rfid'];

// Look up the user in the database
$query = "SELECT name FROM student WHERE rfid='$rfid'";
$result = mysqli_query($conn, $query);

// Check if the user exists
if (mysqli_num_rows($result) == 1) {
	// User found, log them in
	$row = mysqli_fetch_assoc($result);
	session_start();
	$_SESSION['name'] = $row['name'];
	header("Location: old.php"); // Redirect to the user's dashboard
} else {
	// User not found, show error message
	echo "Invalid login credentials. Please try again.";
}


// Close the database connection
mysqli_close($conn);
