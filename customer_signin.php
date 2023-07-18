<?php //echo "Welcome to " . $_SERVER["PHP_SELF"]; 
?>

<?php
// establish connection to the database
include "database.php";
?>


<?php
session_start();
?>


<?php

// display signin page
include "templates/customer_signin.html";

// $error stores any errors found. If empty then no errors found
$error = array();

if (isset($_POST["signin"])) {

    // validate username
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    if (!preg_match('/^(?![0-9])[\w]+$/i', $username)) {
        array_push($error, "Invalid username");
    }

    // validate password
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($error)) {
        // all data is valid and sanitized

        $username = ucwords(strtolower($username));

        $sql = "SELECT password from customers where username = '$username' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // User found
            $row = mysqli_fetch_assoc($result);

            // get salted password stored in the database
            $hash = $row['password'];

            if (password_verify($password, $hash)) {
                // valid user
                echo "Valid user";

                // store info about the user to be used further
                $_SESSION['username'] = $username;

                //Go to home page
                header("Location: home.php");
                exit();
            } else {
                // password mismatch
                echo "Invalid password";
            }
        } else {
            // username does not exist
            echo "Invalid User";
        }
    } else {
        echo "Wrong input";
    }
}
?>

<?php
// $conn : database connection object defined in database.php
if (mysqli_ping($conn)) {
    // Connection is open so close it

    mysqli_close($conn);
}
