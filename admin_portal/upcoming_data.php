
<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:../index.php');
}

$jsonFilePath = '../json/upcoming_films_carousel.json';

// Read JSON
$data = [];
if (file_exists($jsonFilePath)) {
    $data = json_decode(file_get_contents($jsonFilePath), true);
}

// Handle deletion
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];

    // Filter out item by ID
    $data = array_filter($data, fn($item) => $item['id'] !== $deleteId);

    // Reindex and save
    $data = array_values($data);
    file_put_contents($jsonFilePath, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: home.php"); // Refresh
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin_portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">

</head>
<body>
<br><br><br>
<input type="text" id="searchInput" class="form-control search" placeholder="Search by title...">



<br><br>
<div class="container">

<button class="btn btn-default" onclick="window.history.back()">← Back</button>

<a href="./upcoming_form.php" class="btn btn-primary">➕ Add Upcoming Movie</a>
<a class="btn btn-primary" href="../logout.php">Logout</a>

<br><br>
    <h2>Movie Entries</h2>

    <table class="table table-bordered table-striped" id="movieTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Title</th>
                <th>Genre</th>
                <th>IMDB</th>
                <th>Language</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $movie): ?>
                <tr>
                    <td><?= $movie['id'] ?></td>
                    <td><img src="<?= $movie['poster'] ?>" alt="Poster" style="height: 50px;"></td>
                    <td><?= $movie['title'] ?></td>
                    <td><?= $movie['genre'] ?></td>
                    <td><?= $movie['imdb'] ?></td>
                    <td><?= $movie['language'] ?></td>
                    <td><?= $movie['date'] ?></td>
                    <td>
                        <a href="?delete=<?= $movie['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

  
</div>

<script src="./search.js"></script>
</body>
</html>
