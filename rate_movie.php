<?php
session_start();
?>

<?php 
include "database.php";
?>

<?php echo "Welcome to " . $_SERVER["PHP_SELF"]."<br>"; 
echo $_SESSION['username']."<br>";
echo $_SESSION['title']."<br>";
echo $_SESSION['movie_id']."<br>";

print_r($_SESSION);
?>


<?php
    include "templates/rate.html";
?>

<?php
function validateMovieReview($input) {
    // Regular expression pattern to allow only alphanumeric characters with spaces
    $pattern = '/^[a-zA-Z0-9\s."\',!?():;-]+$/';

    // Perform the validation
    return (preg_match($pattern, $input));

}
?>

<?php

    if (isset($_POST['submit'])) {
        $review = $_POST['review'];
        $rating = $_POST['rating'];

        // get info from session
        $customer = $_SESSION['username'];
        $movie_id = $_SESSION['movie_id'];
        $title = $_SESSION['title'];

        // sanitise review
        $santized_review = filter_var($review,FILTER_SANITIZE_SPECIAL_CHARS);

        echo $santized_review."<br>";
        echo $rating."<br>";

        if (validateMovieReview($santized_review)) {
            // insert into database
            $sql = "
            INSERT INTO cust_watch_history
            (cust_username, watched_movie_id, watched_movie_title, rating, review) 
            VALUES ('$customer','$movie_id','$title','$rating','$santized_review');";

            echo "ok";

            try {
                // add customer to the database
                mysqli_query($conn,$sql);
                echo "Review Registered";

                mysqli_close($conn);

                session_destroy();
            }
            catch (mysqli_sql_exception) {
                echo "Could Not Register";
            }
        } 

        else{
            echo "invalid user input";
        }
    }
?>


<?php 
 // $conn : database connection object defined in database.php

 if (mysqli_ping($conn)) {
    // Connection is open so close it

    mysqli_close($conn);

 }

?>
