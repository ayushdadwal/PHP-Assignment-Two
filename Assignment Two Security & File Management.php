<!DOCTYPE html>
<html>
<head>
<title>CRUD Application</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>CRUD Application</h1>
</header>
<main>
<section>
<h2>Create</h2>
<form action="create.php" method="post">
<input type="text" name="name" placeholder="Name">
<input type="text" name="email" placeholder="Email">
<input type="file" name="image">
<input type="submit" value="Create">
</form>
</section>
<section>
<h2>Read</h2>
<table>
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Image</th>
</tr>
</thead>
<tbody>
<?php include "read.php";?>
</tbody>
</table>
</section>
<section>
<h2>Update</h2>
<form action="update.php" method="post">
<input type="hidden" name="id" value="1">
<input type="text" name="name" placeholder="Name">
<input type="text" name="email" placeholder="Email">
<input type="file" name="image">
<input type="submit" value="Update">
</form>
</section>
<section>
<h2>Delete</h2>
<form action="delete.php" method="post">
<input type="hidden" name="id" value="1">
<input type="submit" value="Delete">
</form>
</section>
</main>
<footer>
<p>Copyright &copy; 2023</p>
</footer>
</body>
</html>


/* style.css */
body {
    font-family: sans-serif;
}

header {
    background-color: #ccc;
    padding: 10px;
}

main {
    width: 500px;
    margin: 0 auto;
}

section {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 5px;
}

input {
    width: 100%;
}

input[type="submit"] {
    background-color: #000;
    color: #fff;
    padding: 10px;
    border: none;
    cursor: pointer;
}


<!-- create.php -->
<?php include "db.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_FILES['image'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $image = $_FILES['image'];

    $image_name = time() . '.' . $image['name'];
    move_uploaded_file($image['tmp_name'], 'images/' . $image_name);

    $sql = "INSERT INTO users (name, email, image) VALUES ('$name', '$email', '$image_name')";
    mysqli_query($db, $sql);
}

header('Location: index.php');
?>

<!-- read.php -->
<?php
include "db.php";

$sql = "SELECT * FROM users";
$results = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($results)) {
    echo '<tr>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td><img src="images/' . $row['image'] . '" width="100"></td>';
    echo '</tr>';
}
?>
