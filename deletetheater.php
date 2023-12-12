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
			background-image: url("images/deleteTheaterBackground.jpg");
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

			<form id="contact" action="deletetheater.php" method="post">
				<h2 style="text-align: center; font-family: cursive"><b>Delete Theater</b></h2>

				<input name="theater_id" placeholder="Theater ID" type="text" tabindex="1" value="<?php echo $theaterId ?? ''; ?>" readonly>

				<input name="theater_name" placeholder="Theater Name" type="text" tabindex="1" value="<?php echo $theaterName ?? ''; ?>" readonly>

				<input name="address" placeholder="Address" type="text" tabindex="1" value="<?php echo $address ?? ''; ?>" readonly>

				<input name="seat" placeholder="Seat" type="text" tabindex="1" value="<?php echo $seat ?? ''; ?>" readonly>

				<input style="font-size: larger; background-color: #ff8080; font-family: cursive; font-weight: bold;" class="TheaterStyle" type="submit" name="submit" value="Delete">

				<?php
					if (isset($_POST['submit'])) {
						$theaterId = $_POST['theater_id'];
						
						$query = "DELETE FROM theater WHERE theaterId = $theaterId";
						$result = mysqli_query($conn, $query);

						if ($result) {
							echo "<script>alert('Theater deleted successfully.');</script>";
							echo "<script>window.location.href = 'adminpage.php.php';</script>";
						} else {
							echo "<script>alert('Error deleting theater: " . mysqli_error($conn) . "');</script>";
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
