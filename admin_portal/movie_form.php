<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:../index.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonFilePath = '../json/main.json';

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
        'imdb' => $_POST['imdb'] ?? '',
        'mainbanner' => $_POST['mainbanner'] ?? '',
        'paragraph' => $_POST['paragraph'] ?? '',
        'trailer' => $_POST['trailer'] ?? '',
        'shorts' => $_POST['shorts'] ?? '',
        'duration' => $_POST['duration'] ?? '',
        'popular_section' => $_POST['popular_section'] ?? '',
        'new_release_section' => $_POST['new_release_section'] ?? '',
        'type_section' => $_POST['type_section'] ?? '',
        'language' => $_POST['language'] ?? '',
        'home_banner_section' => $_POST['home_banner_section'] ?? 'no',
        'download' => $_POST['download'] ?? '',
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
                <label class="col-md-4 control-label">IMDB</label>
                <div class="input-group">
                    <input name="imdb" class="form-control" type="number" placeholder="e.g. 8.5" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Main Banner</label>
                <div class="input-group">
                    <input name="mainbanner" class="form-control" type="text">
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
                <label class="col-md-4 control-label">Popular Section</label>
                <div class="input-group">
                    <select name="popular_section" class="form-control">
                    <option value=" " disabled selected >Please select section ></option>
                        <option value="-">-</option>
                        <option value="most">most</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">New Release Section</label>
                <div class="input-group">
                    <select name="new_release_section" class="form-control">
                    <option value=" " disabled selected >Please select section ></option>
                        <option value="-">-</option>
                        <option value="New_release">New_release</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Type Section</label>
                <div class="input-group">
                    <select name="type_section" class="form-control">
                    <option value=" " disabled selected >Please select section ></option>
                        <option value="Movie">Movie</option>
                        <option value="TV Series">TV Series</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Language</label>
                <div class="input-group">
                    <input name="language" class="form-control" type="text" placeholder="English, Hindi etc">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Home Banner Section</label>
                <div class="col-md-4">
                    <div class="radio">
                        <label><input type="radio" name="home_banner_section" value="yes"> Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="home_banner_section" value="no" checked> No</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Download link</label>
                <div class="input-group">
                    <input name="download" class="form-control" placeholder="Link" type="text">
                </div>
            </div>

            <div class="alert alert-success" role="alert" id="success_message">
                ✅ <?= $successMessage ?? '' ?>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                <button1 class="btn btn-default" onclick="window.history.back()">← Back</button1>
                <a class="btn btn-primary" href="../logout.php">Logout</a>

                    <button type="submit" class="btn btn-success">Add Data</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>

 
</body>
</html>
