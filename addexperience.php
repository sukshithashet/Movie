<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Contact Us</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>
<body>
<?php include_once "header.php"; ?>
    <header></header>
    <div class="contact-us-container">
        <div class="contact-us-section contact-us-section1">
            <h1>experience</h1>
            <!-- <p></p> -->
            <form action="" method="POST">
                <input placeholder=" Name" name="name" required><br>
                <!-- <input placeholder="E-mail Address" name="eMail" required><br> -->
                <textarea placeholder="Enter your message !" name="feedback" rows="10" cols="30" required></textarea><br>
                <button type="submit" name="submit" value="submit">add your experience</button>
                <?php
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    // $email = $_POST['eMail'];
                    $message = $_POST['feedback'];
                    $insert_query = "INSERT INTO experience (name, msg) VALUES ('$name','$message')";
                    $add = mysqli_query($conn, $insert_query);
                    if ($add) {
                        echo "<script>alert('Successfully Submitted');</script>";
                    }
                }
                ?>
                <div class="wrapper">
				<button class="btn btn-default" onclick="document.location.href='customerPage.php'" ><span class='glyphicon glyphicon-chevron-left'> </span>BACK TO PAGE</button>
			</div>
        </form>
        </div>
    </div>
   
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
