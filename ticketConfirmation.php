<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
</head>
<style>
	body{
		display:flex;
		flex-direction: column;
	
	}
	img{
		display: block;
		height: 10rem;
		width: 10rem;
		border: 5px solid black;
		border-radius: 3px;
		margin: 0 auto;
	}
	input['sumbit']{

	}
</style>
<body>
    <h2>Payment Page</h2>

    <?php
    // Retrieve the values from the POST request
    $date = $_POST['date'];
    $time = $_POST['timeSlot'];
    $theater = $_POST['theater'];
    $num_seat = $_POST['numb'];
    $payment_amount = 200 * $num_seat; // Calculate payment amount

    // Display the values in read-only textboxes
    echo '<label>Date:</label> <input type="text" name="date" value="' . $date . '" readonly><br>';
    echo '<label>Time Slot:</label> <input type="text" name="timeSlot" value="' . $time . '" readonly><br>';
    echo '<label>Theater:</label> <input type="text" name="theater" value="' . $theater . '" readonly><br>';
    echo '<label>Number of Seats:</label> <input type="text" name="numb" value="' . $num_seat . '" readonly><br>';
    echo '<label>Payment Amount:</label> <input type="text" name="amount" value="' . $payment_amount . '" readonly><br>';

    // Display the QR code image
    echo '<img src="images/qr.jpeg" alt="QR Code">';
	
    // Pass the variable values to the next page using a form submission
    echo '<form action="spage.php" method="post">';
    echo '<label>enter the UPI ID:</label> <input type="text" name="upi_id"><br>';
    echo '<input type="hidden" name="date" value="' . $date . '">';
    echo '<input type="hidden" name="timeSlot" value="' . $time . '">';
    echo '<input type="hidden" name="theater" value="' . $theater . '">';
    echo '<input type="hidden" name="numb" value="' . $num_seat . '">';
    echo '<input type="hidden" name="amount" value="' . $payment_amount . '">';
    echo '<input type="submit" name="pay" value="Pay">';
    echo '</form>';
    ?>
</body>
</html>
