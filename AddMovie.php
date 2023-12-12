<?php include 'db.php'; 

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $genre = $_POST['Genre'];
    $director = $_POST['Director'];
    $description = $_POST['Description'];

    // File upload
    $target = "uploadimages/" . basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $imdb = $_POST['imdb'];

    // Prepare and execute the SQL query
    $query = "INSERT INTO movielist (Name, Genre, Director, Description, image, imdb) VALUES ('$name', '$genre', '$director', '$description', '$image', '$imdb')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data inserted successfully.');</script>";
        echo "<script>window.location.href = 'AddMovie.html';</script>";
    } else {
        echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
    }
}
?>
