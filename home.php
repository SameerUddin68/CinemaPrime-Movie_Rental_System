<?php echo $_SERVER['PHP_SELF']; 
?>

<?php 
session_start();
?>

<?php 
    // establish connection to the database
    include "database.php";

    $username = $_SESSION['username'];
    $sql = "SELECT First from customers where username = '$username' " ;
    $result = mysqli_query($conn,$sql);
    $res = mysqli_fetch_assoc($result);
    $name = $res['First'];

    $_SESSION['first'] = $name;
?>

<?php 
    include "templates/home.html";
?>


<?php 
 // $conn : database connection object defined in database.php

 if (mysqli_ping($conn)) {
    
    // Connection is open so close it
    mysqli_close($conn);

 }

?>