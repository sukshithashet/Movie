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

			<form id="contact" action="updatemovie.php" method="post" enctype="multipart/form-data">
				<h2 style="text-align: center; font-family: cursive"><b>Update Movie</b></h2>

				<input name="movie_id" placeholder="Movie Id" type="text" tabindex="1" value="<?php echo $movieId ?? ''; ?>" required autofocus>

				<input name="MovieName" placeholder="Movie Name" type="text" tabindex="1" value="<?php echo $movieName ?? ''; ?>" required>

				<select class="MovieGenre" name="Genre">
					<option value="Action" <?php if ($genre === 'Action') echo 'selected'; ?>>Action</option>
					<option value="Adventure" <?php if ($genre === 'Adventure') echo 'selected'; ?>>Adventure</option>
					<option value="Comedy" <?php if ($genre === 'Comedy') echo 'selected'; ?>>Comedy</option>
					<option value="Crime" <?php if ($genre === 'Crime') echo 'selected'; ?>>Crime</option>
					<option value="Drama" <?php if ($genre === 'Drama') echo 'selected'; ?>>Drama</option>
				</select>

				<input name="imdb" placeholder="IMDb Rating" type="text" tabindex="1" value="<?php echo $imdbRating ?? ''; ?>" required>

				<input name="directorName" placeholder="Director" type="text" tabindex="1" value="<?php echo $director ?? ''; ?>" required>

				<textarea name="description" placeholder="Description" tabindex="1" required><?php echo $description ?? ''; ?></textarea>


				<input style="font-size: larger; background-color: #c2fbb8; font-family: cursive; font-weight: bold;" class="MovieGenre" type="submit" name="submit" value="Update">

				<?php
					if (isset($_POST['submit'])) {
						$movieId = $_POST['movie_id'];
						$movieName = $_POST['MovieName'];
						$genre = $_POST['Genre'];
						$imdbRating = $_POST['imdb'];
						$director = $_POST['directorName'];
						$description = $_POST['description'];

						 //File upload
						$target = "uploadimages/" . basename($_FILES['image']['name']);
						$image = $_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'], $target);

						$query = "UPDATE movielist SET Name='$movieName', Genre='$genre', Director='$director', Description='$description', image='$image', imdb='$imdbRating' WHERE movieId=$movieId";
						$result = mysqli_query($conn, $query);

						if ($result) {
							echo "<script>alert('Movie updated successfully.');</script>";
							echo "<script>window.location.href = 'movie_manag.php';</script>";
						} else {
							echo "<script>alert('Error updating movie: " . mysqli_error($conn) . "');</script>";
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
