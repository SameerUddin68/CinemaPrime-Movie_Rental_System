<?php //echo $_SERVER['PHP_SELF']; ?>

<?php 
session_start();
?>

<?php
$movie_id =  $_GET['id'];
$name = $_SESSION['first'];
?>

<?php 
   include "database.php";
?>


<?php 

$sql = "SELECT * FROM movies where movie_id = {$movie_id}";
$result = mysqli_query($conn,$sql);
$res = mysqli_fetch_assoc($result);


$title = $res['title'];
$release_year = $res['release_year'];
$movie_rating = $res['movie_rating'];
$cover_page = $res['cover_page'];
$directors = $res['directors'];
$plot = $res['plot'];
$certificate = $res['certificate'];
$run_time = $res['run_time'];
$casts = $res['casts'];
$writers = $res['writers'];
$movie_genre = $res['movie_genre_id'];
$trailer = $res['trailer'];


$sql = "SELECT genre FROM genre where genre_id = {$movie_genre}";
$result = mysqli_query($conn,$sql);
$res = mysqli_fetch_assoc($result);

$genre = $res['genre'];
?>


<?php
    $_SESSION['title'] = $title;
    $_SESSION['movie_id'] = $movie_id;

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="css/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <video src="<?php echo $trailer; ?>" autoplay muted></video>
        <nav>
            <div class="logo_ul">
                <img src="css/images/logo.png" alt="">
                <ul>
                    <li>
                        <a href="home.php">HOME</a>
                    </li>
                </ul>

            </div>
            <div class="search_user">
                <input type="text" placeholder="search..." id="search_input">
                <img src="https://api.dicebear.com/6.x/initials/svg?scale=100&size=32&seed=<?php echo $name ?>" alt="avatar" />
                   <div class="search"> 
                    <!-- <a href="#" class="card">
                        <img src="img/the boys.jpg" alt="">
                        <div class="cont">
                            <h3>The Boys</h3>
                            <p>Action, 2021 , <span>IMDB </span><i class="bi bi-star-fill"></i> 9.6</p>
                        </div> 
                    </a>     -->

                </div>
            </div>    
        </nav>1
        <div class="content">
            <h1 id="title" style="margin-top: 0px;"><?php echo $title ?></h1>
            <p style="font-size: medium; margin-bottom: 13px;"><?php echo $plot; ?></p>

            <div class = 'additon_detail'> 
                <h5 id="director" style="border-top-width: 0px;border-top-style: solid;border-bottom-width: 0px;border-bottom-style: solid;margin-top: 6px;margin-bottom: 10px;"><?php echo "Directed by ".$directors?></h5>
                <h5 id="writer" style="margin-top: 10px;margin-bottom: 10px;"><?php echo "Written by ".$writers?></h5>
                <h4 style="margin-top: 6px;margin-bottom: 6px;">Starring</h4>
                <h5 id="casts" style="margin-top: 5px;margin-bottom: 0px;"><?php echo $casts?></h5>            
            
            <div class="details" style="margin-top: -13px;margin-bottom: -10px;">
                <h6> <?php echo $certificate; ?></h6>
                <h5 id = 'gen'><?php echo $genre; ?></h5>
                <h4 id = 'date'><?php echo $release_year; ?></h4>
                <h3 id="rate"><span>IMDB </span><i class="bi bi-star-fill"></i> <?php echo $movie_rating ?></p></h3>
            </div>
            <div class="btns">
                <a href="watch.php" id="play">WATCH <i class="bi bi-play-fill"></i></a>                
                <a href="rate_movie.php">Rate Movie</a>
        
            </div>
        </div>
        
    </header>
</body>
</html> 


<?php 
 // $conn : database connection object defined in database.php

 if (mysqli_ping($conn)) {
    
    // Connection is open so close it
    mysqli_close($conn);

 }

?>