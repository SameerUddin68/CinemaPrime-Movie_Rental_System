<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<?php
include "templates/admin_page.html";
?>

<?php
// Establish database connection
include "database.php";

// Execute the SQL query to count the records
$query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'project' AND TABLE_NAME = 'movies';";
$result = mysqli_query($conn, $query);

print_r($result);

// Check if the query executed successfully
if ($result) {
    // Fetch the count from the result set
    $row = mysqli_fetch_assoc($result);
    $count = $row['AUTO_INCREMENT'];

    // Display the AUTO_INCREMENT value
    echo "AUTO_INCREMENT value: " . $count;
} else {
    // Handle the query error
    echo "Query failed: " . mysqli_error($conn);
}
?>


<?php
function validateText($input)
{
    // Regular expression pattern to allow only alphanumeric characters with spaces
    $pattern = '/^[a-zA-Z0-9\s."\',!?():;-]+$/';

    // Perform the validation
    return (preg_match($pattern, $input));
}

function GetFileExtension($file_name){
  
    $fileSplit = explode('.', $file_name); // seperate the name and extension
    $fileExt = strtolower(end($fileSplit)); // get the file extension
    
    //check file extension for file
    print_r($fileSplit);
    echo "<br><br>";
    print_r($fileExt);
    echo "<br><br>";

    return $fileExt;
}


?>
<?php

if (isset($_POST['submit'])) {

    // validate title
    $movieName = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    if (validateText($movieName)) {
        $movieName = ucwords(strtolower($movieName));
    } else {
        $movieName = "";
        echo "Invalid title";
    }

    $release_year = filter_input(INPUT_POST, 'release-year', FILTER_SANITIZE_NUMBER_INT);
    echo $release_year;

    $rating = $_POST['rating'];
    $genre_id = $_POST['genre'];
    $certificate = $_POST['certificate'];
    $duration = $_POST['duration-hr'] . "h " . $_POST['duration-min'] . "m";

    // validate cast input
    $casts = filter_input(INPUT_POST, 'casts', FILTER_SANITIZE_SPECIAL_CHARS);
    if (validateText($casts)) {
        $casts = ucwords(strtolower($casts));
    } else {
        $casts = "";
        echo "Invalid text";
    }
    echo $casts;


    // validate writers input
    $writers = filter_input(INPUT_POST, 'writers', FILTER_SANITIZE_SPECIAL_CHARS);
    if (validateText($writers)) {
        $writers = ucwords(strtolower($writers));
    } else {
        $writers = "";
        echo "Invalid text";
    }
    echo $writers;

    // validate cast input
    $directors = filter_input(INPUT_POST, 'directors', FILTER_SANITIZE_SPECIAL_CHARS);
    if (validateText($directors)) {
        $directors = ucwords(strtolower($directors));
    } else {
        $directors = "";
        echo "Invalid text";
    }
    echo $directors;


    // validate cast input
    $plot = filter_input(INPUT_POST, 'plot', FILTER_SANITIZE_SPECIAL_CHARS);
    if (validateText($plot)) {
        $plot = ucwords(strtolower($plot));
    } else {
        $plot = "";
        echo "Invalid text";
    }
    echo $plot;


    // cover
    $imgfile = $_FILES['cover-image'];
    $imgfile_name = $_FILES['cover-image']['name'];
    $imgfile_tmp_name = $_FILES['cover-image']['tmp_name'];
    $imgfile_type = $_FILES['cover-image']['type'];
    $imgfile_size = $_FILES['cover-image']['size'];
    $imgfile_error = $_FILES['cover-image']['error'];

    // trailer
    $vidfile = $_FILES['trailer'];
    $vidfile_name = $_FILES['trailer']['name'];
    $vidfile_tmp_name = $_FILES['trailer']['tmp_name'];
    $vidfile_type = $_FILES['trailer']['type'];
    $vidfile_size = $_FILES['trailer']['size'];
    $vidfile_error = $_FILES['trailer']['error'];

    $allowed_file_type = ['jpg', 'png', 'jpeg','webm'];

    $vidext = GetFileExtension($vidfile_name);
    $imgext = GetFileExtension($imgfile_name);


    if (($imgfile_error === 0) && ($vidfile_error === 0)) {
        //no error in uploading file

        if (in_array($vidext, $allowed_file_type) && (in_array($imgext, $allowed_file_type))) {
            //valid file extension
            echo "valid datatype";
            echo "<br><br><br>";

            if ($imgfile_size < 500000000 ) {
                //upload file
                $imgfilenewname = "movie" . $count . "." . $imgext;
                echo $imgfilenewname;
                echo "<br><br><br>";

                //upload file
                $vidfilenewname = "movie" . $count . "." . $vidext;
                echo $vidfilenewname;
                echo "<br><br><br>";

                $img_upload_dir = "css/images/" . $imgfilenewname;
                $vid_upload_dir = "res/videos/" . $vidfilenewname;

                // transfer file from tmp location to destination dir
                move_uploaded_file($imgfile_tmp_name, $img_upload_dir);
                move_uploaded_file($vidfile_tmp_name, $vid_upload_dir);
                echo "upload_successful";

                // Execute the SQL query to insert new movie

                $sql =
                    "INSERT into movies(title,release_year,movie_rating,movie_genre_id,certificate, run_time,casts,directors,writers,cover_page,plot,trailer)
                    VALUES ('$movieName','$release_year','$rating','$genre_id','$certificate','$duration','$casts','$directors','$writers','$img_upload_dir','$plot','$vid_upload_dir'); ";

                try {
                    mysqli_query($conn, $sql);
                    echo "Movie Registered";
                    header("Location:admin_home.php");
                    exit();

                } catch (mysqli_sql_exception) {
                    echo "Could Not Register";
                }
            } else {
                echo "file too big";
                echo "<br><br><br>";
            }
        } else {
            // invalid file extension
            echo "cannot upload file";
            echo "<br><br><br>";
        }
    } else {
        // error in uploading file
        echo "error uploading file";
        echo "<br><br><br>";
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
