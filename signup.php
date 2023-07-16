<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<?php 
    // establish connection to the database
    include "database.php";
?>

<?php 
    session_start();
?>


<?php

    // display signin page
    include "templates/signup.html";

   // $error stores any errors found. If empty then no errors found
   $error = array();

   if (isset($_POST["signup"])) {
       //active when signup button pressed

        // validate username
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
        if (!preg_match('/^(?![0-9])[\w]+$/i', $username)) {
            array_push($error,"Invalid username");
        }      

        // validate email
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $domain = substr($email, strpos($email, '@') + 1);
        if (!checkdnsrr($domain, "MX")) {
            echo "Invalid email";
            array_push($error,"Invalid email");
        }
    
        // validate password
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
        
        // salting password to store in the database 
        $hash =  password_hash($password,PASSWORD_DEFAULT);

       if (empty($error)) {
        // all data is valid insert in the database

            $sql = 
            "INSERT into customers(username,email,password)
            VALUES ('$username','$email','$hash'); "; 

            try {
                mysqli_query($conn,$sql);
                echo "User Registered";
                // store info about the user to be used further
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
             
                //Go to home page
                header("Location: home.php");
                exit();

            } catch (mysqli_sql_exception) {
                echo "Could Not Register";
            }
            
             
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
