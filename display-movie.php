<?php echo $_SERVER['PHP_SELF']; ?>

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
            <h1 id="title"><?php echo $title ?></h1>
            <p><?php echo $plot; ?></p>
            <div class="details">
                <h6> <?php echo $certificate; ?></h6>
                <h5 id = 'gen'><?php echo $genre; ?></h5>
                <h4 id = 'date'><?php echo $release_year; ?></h4>
                <h3 id="rate"><span>IMDB </span><i class="bi bi-star-fill"></i> <?php echo $movie_rating ?></p></h3>
            </div>
            <div class="btns">
                <a href="watch.php" id="play">WATCH <i class="bi bi-play-fill"></i></a>                
            </div>
            <a href="rate_movie.php"><button>rate movie</button></a>
        </div>
        
    </header>

    
   
</body>
</html> 


<?php 
 // $conn : database connection object defined in database.php

 unset($_SESSION['first']);

 if (mysqli_ping($conn)) {
    
    // Connection is open so close it
    mysqli_close($conn);

 }

?>