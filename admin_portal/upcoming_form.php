<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonFilePath = '../json/upcoming_films_carousel.json';

    // Read existing JSON
    if (file_exists($jsonFilePath)) {
        $existingData = json_decode(file_get_contents($jsonFilePath), true);
    } else {
        $existingData = [];
    }

    // Calculate next ID
    $nextId = count($existingData) > 0 ? $existingData[0]['id'] + 1 : 1;

    // Create new movie data with form values
    $newData = [
        'id' => $nextId,
        'poster' => $_POST['poster'] ?? '',
        'title' => $_POST['title'] ?? '',
        'genre' => $_POST['genre'] ?? '',
        'date' => $_POST['date'] ?? '',
        
       
        'paragraph' => $_POST['paragraph'] ?? '',
        'trailer' => $_POST['trailer'] ?? '',
       
        'duration' => $_POST['duration'] ?? '',
        'type_section' => $_POST['type_section'] ?? '',
        'language' => $_POST['language'] ?? '',

    ];

    // Insert the new data at the top of the array
    array_unshift($existingData, $newData);

    // Save the updated JSON
    file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));
    
    $successMessage = "Data added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movie Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./form.css">

    <style>
        body { padding: 20px; }
        #success_message { display: <?= isset($successMessage) ? 'block' : 'none' ?>; }
       
        .form-control{
            width: 250px;
        }
    
    </style>
</head>
<body>
<div class="container">
    <form class="well form-horizontal" method="POST" action="" id="userForm">
        <fieldset>
            <legend>ADD DATA</legend>

            <div class="form-group">
                <label class="col-md-4 control-label">Poster</label>
                <div class="input-group">
                    <input name="poster" class="form-control" type="text" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Movie Title</label>
                <div class="input-group">
                    <input name="title" placeholder="Title" class="form-control" type="text" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Genre</label>
                <div class="input-group">
                    <input name="genre" class="form-control" placeholder="Comedy, Action, etc" type="text" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Date</label>
                <div class="input-group">
                    <input name="date"  class="form-control" type="text" placeholder="ex: May-2024" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Paragraph</label>
                <div class="input-group">
                    <input name="paragraph" class="form-control" placeholder="15 to 20 word" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Trailer</label>
                <div class="input-group">
                    <input name="trailer" class="form-control" placeholder="Embed -Link" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Shorts</label>
                <div class="input-group">
                    <input name="shorts" class="form-control" placeholder="../movie_data/(movie_name)" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Duration</label>
                <div class="input-group">
                    <input name="duration" class="form-control" type="text" placeholder="e.g. 1h 44min">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Language</label>
                <div class="input-group">
                    <input name="language" class="form-control" type="text" placeholder="English, Hindi etc">
                </div>
            </div>


            <div class="alert alert-success" role="alert" id="success_message">
                ✅ <?= $successMessage ?? '' ?>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                <button class="btn btn-default" onclick="window.history.back()">← Back</button>
                <a class="btn btn-primary" href="../logout.php">Logout</a>

                    <button type="submit" class="btn btn-success">Add Data</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

 
</body>
</html>