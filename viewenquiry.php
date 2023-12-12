<?php include 'db.php'; ?>
<?php
// Database connection details


// Create a new database connection


/// Check if the status update form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["uid"]) && isset($_POST["action"])) {
        $uid = $_POST["uid"];
        $action = $_POST["action"];

        // Update the status or reject the payment based on the action
        if ($action === "accept") {
            updatePaymentStatus($uid, "accepted");
        } elseif ($action === "reject") {
            updatePaymentStatus($uid, "rejected");
        }
    }
}

// Function to update the status of a payment
function updatePaymentStatus($uid, $status) {
    global $conn;

    // Prepare the SQL statement to update the status of the payment
    $sql = "UPDATE Payment SET Status = ? WHERE UID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $uid);

    // Execute the statement
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Payment status updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating payment status.");</script>';
    }

    // Close the statement
    $stmt->close();
}

// Retrieve the payment details from the payment table
$sql = "SELECT * FROM Payment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <style>
        body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

h2 {
  margin-top: 0;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #f5f5f5;
}

td button {
  padding: 5px 10px;
  font-size: 14px;
  cursor: pointer;
}

input[type="submit"] {
  padding: 5px 10px;
  font-size: 14px;
  cursor: pointer;
  background-color: #4CAF50;
  color: #fff;
  border: none;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

.alert {
  padding: 10px;
  background-color: #f44336;
  color: #fff;
  margin-top: 20px;
}

.alert.success {
  background-color: #4CAF50;
}

.alert.error {
  background-color: #f44336;
}
    </style>
</head>
<body>
    <h2>Payment Details</h2>

    <table>
        <tr>
            <th>UID</th>
            <th>Name</th>
            <th>UPI ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $uid = $row['UID'];
                $name = $row['Name'];
                $upi_id = $row['UPI_ID'];
                $status = $row['Status'];
                ?>
                <tr>
                    <td><?php echo $uid; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $upi_id; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <?php
                        if ($status == 'pending') {
                            echo '<form method="post">';
                            echo '<input type="hidden" name="uid" value="' . $uid . '">';
                            echo '<input type="hidden" name="action" value="accept">';
                            echo '<input type="submit" value="Accept">';
                            echo '</form>';

                            echo '<form method="post">';
                            echo '<input type="hidden" name="uid" value="' . $uid . '">';
                            echo '<input type="hidden" name="action" value="reject">';
                            echo '<input type="submit" value="Reject">';
                            echo '</form>';

                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="5">No payment details found.</td></tr>';
        }
        ?>
        <a href="adminpage.php" class="button">Go to Admin Page</a>

    </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>