<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<?php 
session_start();
?>


<?php 
include "database.php";


$sql = "SELECT * FROM movies where movie_id = {$_GET['id']}";
$result = mysqli_query($conn,$sql);

$movie = mysqli_fetch_assoc($result);
$title = $movie['title'];
$plot = $movie['plot'];
$director = $movie['directors'];
$cast = $movie['casts'];
$ratings = $movie['movie_rating'];
$writers = $movie['writers'];
$genre = $movie['movie_genre'];
$release_year = $movie['release_year'];
$cover = $movie['cover_page'];

?>


<!DOCTYPE html>
<html>
<head>
    <title>Movie Details</title>
    <style>
        /* CSS styles for the movie details page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .container {
            display: flex;
            padding: 20px;
        }
        
        .movie-image {
            flex: 1;
        }
        
        .movie-image img {
            max-width: 100%;
            height: auto;
        }
        
        .movie-details {
            flex: 2;
            padding: 0 20px;
        }
        
        .movie-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .movie-year,
        .movie-genre,
        .movie-director,
        .movie-cast,
        .movie-ratings,
        .movie-writers {
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .button-container {
            display: flex;
        }
        
        .button-container button {
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .watch-button {
            background-color: #007bff;
            color: #fff;
        }
        
        .rate-button {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="movie-image">
            <img src="<?php echo $cover;?>" alt="Movie Cover">
        </div>
        <div class="movie-details">
            <div class="movie-title"><?php echo $title;?></div>
            <div class="movie-year">Release Year: <?php echo $release_year;?></div>
            <div class="movie-genre">Genre: <?php echo $genre;?></div>
            <div class="movie-director">Director: <?php echo $director; ?></div>
            <div class="movie-cast">Cast: <?php echo $cast; ?></div>
            <div class="movie-ratings">Ratings: <?php echo $ratings; ?></div>
            <div class="movie-writers">Writers: <?php echo $writers; ?></div>
            <div class="button-container">
                <a href="watch.php?=id=<?php echo $movie['movie_id']; ?>"><button class="watch-button">Watch</button></a>
                <a href="rate_movie.php"><button class="rate-button">Rate</button></a>
                
            </div>
        </div>
    </div>
</body>
</html>



<?php 
  // $conn : database connection object defined in database.php

  if (mysqli_ping($conn)) {
    // Connection is open so close it

    mysqli_close($conn);
} 

?>









          