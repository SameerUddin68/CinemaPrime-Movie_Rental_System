<?php 
    // This file is responsible for establishing connection to the database
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "project";
    //$conn = "";

    try {
    // Create connection
    $conn = mysqli_connect($db_server, $db_user,$db_pass,$db_name);

    } 
    catch (mysqli_sql_exception) {
        echo "Could not connected to the database <br>";
    }

    if ($conn) {
        echo "Connected successfully <br>";
    }
?>


<?php 

$sql = "SELECT * FROM movies";
$result = $conn->query($sql);


// Genre mappings
$genreMappings = array(
    '1' => 'Action',
    '2' => 'Drama',
    '3' => 'Adventure',
    '4' => 'Crime',
    '5' => 'War',
    '6' => 'Western',
    '7' => 'Family',
    '8' => 'Thriller'
  );

if ($result->num_rows > 0) {
    // Initialize an array to store the data
    $data = array();

    // Fetch data from the result set and add it to the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Add new key "genre" with its respective value to the associative array
    foreach ($data as &$movie) {
        $genreId = $movie['movie_genre_id'];
        if (isset($genreMappings[$genreId])) {
          $movie['genre'] = $genreMappings[$genreId];
        }
    }
    
    // Convert the data array to JSON format
    $json_data = json_encode($data,JSON_PRETTY_PRINT);

    // Output the JSON data on screen
    print_r($json_data) ;

    
} else {
    echo "No data found.";
}

// Specify the file path and name for the new JSON file
$filename = 'json/myfile.json';

// Write the JSON string to the new file
if (file_put_contents($filename, $json_data)) {
    echo "JSON object has been written to $filename successfully.";
} else {
    echo "Error writing JSON object to $filename.";
}






?>





<?php 
 // $conn : database connection object defined in database.php

 if (mysqli_ping($conn)) {
   // Connection is open so close it

   mysqli_close($conn);
}  
