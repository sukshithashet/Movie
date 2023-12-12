<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .contact-form {
  max-width: 400px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
}

.submit-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
}

</style>
<body>
<form action="contact-us.php" method="POST" class="contact-form">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required>
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
  <br>
  <label for="message">Message:</label>
  <textarea id="message" name="message" required></textarea>
  <br>
  <input type="submit" name="submit" value="Submit" class="submit-btn">
</form>
<div class="wrapper">
				<button class="btn btn-default" onclick="document.location.href='index.php'">
					<span class='glyphicon glyphicon-chevron-left'></span> BACK TO THE HOME PAGE
				</button>
			</div>
</body>
</html>
<?php
include 'db.php';
// Get form data
if (isset($_POST['submit'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// // Connect to MovieDB database
// $servername = "your_servername";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_dbname";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Insert data into the database
$sql = "INSERT INTO contact_messages(name,email,message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Thank you for your message!");</script>';
} else {
    echo '<script>alert("Error: " . $sql . "<br>" . $conn->error);</script>';
}

// Close the database connection
$conn->close();
}
?>
