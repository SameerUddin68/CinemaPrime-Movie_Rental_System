<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<?php 
include "database.php";
?>

<?php

$sql = "SELECT movie_id,title,cover_page FROM movies limit 5";

$result = mysqli_query($conn,$sql);

// print_r(mysqli_fetch_assoc($result));
// print_r(mysqli_fetch_assoc($result));

$data = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
else{
    echo "Not found";
};

mysqli_close($conn);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CinemaPrime</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-func.js"></script>
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>

<body>

<a href="admin.php?id=9">go to admin</a>


<div id="shell">
  <div id="header">
    <h1 id="logo"><a href="#">CinemaPrime</a></h1>
    <div id="navigation">
      <ul>
        <li><a class="active" href="#">HOME</a></li>
        <li><a href="#">NEWS</a></li>
        <li><a href="#">IN THEATERS</a></li>
        <li><a href="#">COMING SOON</a></li>
        <li><a href="#">CONTACT</a></li>
        <li><a href="#">ADVERTISE</a></li>
      </ul>
    </div>
    <div id="sub-navigation">
      <ul>
        <li><a href="#">SHOW ALL</a></li>
        <li><a href="#">LATEST TRAILERS</a></li>
        <li><a href="#">TOP RATED</a></li>
        <li><a href="#">MOST COMMENTED</a></li>
      </ul>
      <div id="search">
        <form action="#" method="get" accept-charset="utf-8">
          <label for="search-field">SEARCH</label>
          <input type="text" name="search field" value="Enter search here" id="search-field" class="blink search-field"  />
          <input type="submit" value="GO!" class="search-button" />
        </form>
      </div>
    </div>
  </div>
  
  <div id="main">
    <div id="content">
      <div class="box">
        
        
        <?php 
        print_r($data) ;
        foreach ($data as $movie):?>
            <div class="movie">
                <div>
                    <span><?php echo $movie['title']; ?></span>
                    <a href="movie.php?id=<?php echo $movie['movie_id']?>"><img src="<?php echo $movie['cover_page'] ?>" alt="cannot display" /></a>
                </div>
                
                <div class="rating">
                    <p>RATING</p>
                </div>
            </div>
        <?php endforeach; ?>
    
        <div class="cl">&nbsp;</div>
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
