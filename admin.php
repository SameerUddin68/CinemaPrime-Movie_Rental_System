<?php 
include "templates/admin.html";
?>

<?php
// Establish database connection
include "database.php";

// Execute the SQL query to count the records
$query = "SELECT COUNT(*) AS count FROM movies";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if ($result) {
    // Fetch the count from the result set
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // Output the count
    echo "Total records: " . $count;
} else {
    // Handle the query error
    echo "Query failed: " . mysqli_error($conn);
}
?>




<?php 
  
if (isset($_POST['submit'])) {

    $movieName = $_POST['movie_name'];
    $director = $_POST['director'];
    $plot = $_POST['plot'];

    $file = $_FILES['cover'];
    $file_name = $_FILES['cover']['name'];
    $file_tmp_name = $_FILES['cover']['tmp_name'];
    $file_type = $_FILES['cover']['type'];
    $file_size = $_FILES['cover']['size'];
    $file_error = $_FILES['cover']['error'];
  
    // Store the movie cover image
    print_r ($_FILES['cover']);
    echo "<br><br><br>";

    $allowed_file_type = ['jpg','png','jpeg'];
    $fileSplit = explode('.',$file_name); // seperate the name and extension
    
    $fileExt = strtolower(end($fileSplit)); // get the file extension
    // check file extension for file
    print_r($fileSplit);
    echo "<br><br>";
    print_r($fileExt);
    echo "<br><br>";

        if ($file_error === 0) {
            // no error in uploading file

            if (in_array($fileExt,$allowed_file_type)) {
                // valid file extension
                echo "valid datatype";
                echo "<br><br><br>";
                if ($file_size < 500000) {
                    // upload file
                    $movie_id = $count + 1; 
                    $filenewname = "movie" . $movie_id . "." . $fileExt;
                    echo $filenewname;
                    echo "<br><br><br>";

                    $upload_dir = "css/images/" . $filenewname;

                    // transfer file from tmp location to destination dir
                    move_uploaded_file($file_tmp_name,$upload_dir);
                    echo "upload_successful";

                    // Execute the SQL query to insert new movie

                    $sql = 
                    "INSERT into movies(title,plot,directors,cover_page)
                    VALUES ('$movieName','$plot','$director','$upload_dir'); "; 

                    try {
                        mysqli_query($conn,$sql);
                        echo "Movie Registered";
                        header("Location: home.php");
                        exit();
                    } catch (mysqli_sql_exception) {
                        echo "Could Not Register";
                    }

                }
                else{
                    echo "file too big";
                    echo "<br><br><br>";
                }
            } 
            else{
                // invalid file extension
                echo "cannot upload file";
                echo "<br><br><br>";
            }
        }
        else{
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
