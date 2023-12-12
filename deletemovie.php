<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/registration.css">
	<link rel="stylesheet" type="text/css" href="js/bootstrap.min.css">
	<style type="text/css">
		.MovieGenre {
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
			background-image: url("images/addMovieBackground.jpg");

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
				<select class="MovieGenre" name="movie_id" onchange="this.form.submit()">
					<option value="">Select Movie ID</option>
					<?php
						$query = "SELECT movieId FROM movielist";
						$result = mysqli_query($conn, $query);
						while ($row = mysqli_fetch_assoc($result)) {
							$movieId = $row['movieId'];
							echo "<option value='$movieId'>$movieId</option>";
						}
					?>
				</select>
				<noscript><input type="submit" value="Submit"></noscript>
			</form>

			<?php
				if (isset($_POST['movie_id'])) {
					$movieId = $_POST['movie_id'];
					$query = "SELECT * FROM movielist WHERE movieId = $movieId";
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);

					$movieName = $row['Name'];
					$genre = $row['Genre'];
					$imdbRating = $row['imdb'];
					$director = $row['Director'];
					$description = $row['Description'];
					$image = $row['image'];
				}
			?>

			<form id="contact" action="deletemovie.php" method="post">
				<h2 style="text-align: center; font-family: cursive"><b>Delete Movie</b></h2>

				<input name="movie_id" placeholder="Movie Id" type="text" tabindex="1" value="<?php echo $movieId ?? ''; ?>" readonly>

				<input name="MovieName" placeholder="Movie Name" type="text" tabindex="1" value="<?php echo $movieName ?? ''; ?>" readonly>

				<input class="MovieGenre" name="Genre" placeholder="Genre" type="text" tabindex="1" value="<?php echo $genre ?? ''; ?>" readonly>

				<input name="imdb" placeholder="IMDb Rating" type="text" tabindex="1" value="<?php echo $imdbRating ?? ''; ?>" readonly>

				<input name="directorName" placeholder="Director" type="text" tabindex="1" value="<?php echo $director ?? ''; ?>" readonly>

				<textarea name="description" placeholder="Description" tabindex="1" readonly><?php echo $description ?? ''; ?></textarea>

				<input style="padding: 10px;" type="file" name="image" disabled>

				<input style="font-size: larger; background-color: #c2fbb8; font-family: cursive; font-weight: bold;" class="MovieGenre" type="submit" name="submit" value="Delete">
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

<?php
	if (isset($_POST['submit'])) {
		$movieId = $_POST['movie_id'];

		$query = "DELETE FROM movielist WHERE movieId = $movieId";
		$result = mysqli_query($conn, $query);

		if ($result) {
			echo "<script>alert('Movie deleted successfully.');</script>";
			echo "<script>window.location.href = 'deletemovie.php';</script>";
		} else {
			echo "<script>alert('Error deleting movie: " . mysqli_error($conn) . "');</script>";
		}
	}
?>
