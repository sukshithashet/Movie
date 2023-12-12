<?php
session_start();

// Check if the user is logged in and has a valid session


// Check if UPI ID is provided via POST
if (!isset($_POST['upi_id'])) {
    echo 'UPI ID is missing.';
    exit;
}

// Retrieve the UPI ID from POST
$upi_id = $_POST['upi_id'];

// Database connection details
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "moviedb";
$name= $_SESSION['user'];
// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to insert the data into the payment table
$sql = "INSERT INTO Payment (Name, UPI_ID, Status) VALUES (?, ?, 'pending')";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters and execute the statement
$stmt->bind_param("ss", $name, $upi_id);
$stmt->execute();

// Check if the insertion was successful
if ($stmt->affected_rows > 0) {
    echo '<script>alert("Payment details have been successfully inserted into the payment table.");</script>';
} else {
    echo '<script>alert("Error inserting payment details.");</script>';
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
