<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="stylesheet" type="text/css" href="js/bootstrap.min.css">
	<style type="text/css">
		.TheaterStyle {
			width: 100%;
			border: 1px solid #ccc;
			background: #FFF;
			margin: 0 0 5px;
			padding: 10px;
			font-style: normal;
			font-variant-ligatures: normal;
			font-variant-caps: normal;
			font-variant-numeric: normal;
			font-weight: 400;
			font-stretch: normal;
			font-size: 12px;
			line-height: 16px;
			font-family: Roboto, Helvetica, Arial, sans-serif;
		}
		body, html {
			height: 100%;
			margin: 0;
		}
		.wrapper {
			text-align: center;
		}
		.bg {
			/* The image used */
			background-image: url("images/addTheaterBackground.jpg");

			/* Full height */
			height: 100%;

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</head>

<body>
	<?php include_once "header.php"; ?>
	<div class="bg">
		<div class="container">
			<form action="" method="post">
				<select class="TheaterStyle" name="theater_id" onchange="this.form.submit()">
					<option value="">Select Theater ID</option>
					<?php
						$query = "SELECT theaterId FROM theater";
						$result = mysqli_query($conn, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							$theaterId = $row['theaterId'];
							echo "<option value='$theaterId'>$theaterId</option>";
						}
					?>
				</select>
				<noscript><input type="submit" value="Submit"></noscript>
			</form>

			<?php
				if (isset($_POST['theater_id'])) {
					$theaterId = $_POST['theater_id'];
					$query = "SELECT * FROM theater WHERE theaterId = $theaterId";
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);

					$theaterName = $row['theaterName'];
					$address = $row['address'];
					$seat = $row['seat'];
				}
			?>

			<form id="contact" action="updatetheater.php" method="post">
				<h2 style="text-align: center; font-family: cursive"><b>Update Theater</b></h2>

				<input name="theater_id" placeholder="Theater ID" type="text" tabindex="1" value="<?php echo $theaterId ?? ''; ?>" required autofocus>

				<input name="theater_name" placeholder="Theater Name" type="text" tabindex="1" value="<?php echo $theaterName ?? ''; ?>" required>

				<input name="address" placeholder="Address" type="text" tabindex="1" value="<?php echo $address ?? ''; ?>" required>

				<input name="seat" placeholder="Seat" type="text" tabindex="1" value="<?php echo $seat ?? ''; ?>" required>

				<input style="font-size: larger; background-color: #c2fbb8; font-family: cursive; font-weight: bold;" class="TheaterStyle" type="submit" name="submit" value="Update">

				<?php
					if (isset($_POST['submit'])) {
						$theaterId = $_POST['theater_id'];
						$theaterName = $_POST['theater_name'];
						$address = $_POST['address'];
						$seat = $_POST['seat'];

						$query = "UPDATE theater SET theaterName='$theaterName', address='$address', seat='$seat' WHERE theaterId=$theaterId";
						$result = mysqli_query($conn, $query);

						if ($result) {
							echo "<script>alert('Theater updated successfully.');</script>";
							echo "<script>window.location.href = 'theater_manag.php';</script>";
						} else {
							echo "<script>alert('Error updating theater: " . mysqli_error($conn) . "');</script>";
						}
					}
				?>
			</form>

			<div class="wrapper">
				<button class="btn btn-default" onclick="document.location.href='adminpage.php'">
					<span class='glyphicon glyphicon-chevron-left'></span> BACK TO THE ADMIN PAGE
				</button>
			</div>
		</div>
	</div>
</body>
</html>
