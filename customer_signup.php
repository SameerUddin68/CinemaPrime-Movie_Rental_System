<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<?php 
    // establish connection to the database
    include "database.php";
?>

<?php 
    session_start();
?>

<?php 

// Function to validate the name format
function isValidName($name) {
    return preg_match("/^[a-zA-Z-' ]{1,50}$/", $name);
}

$paymentMethods = array(
    "mastercard" => 1,
    "visa" => 2,
    "unionpay" => 3
);
?>


<?php
    // display signup page
    include "templates/customer_signup.html";

    if (isset($_POST["signup"])) {

       //active when signup button pressed
       $firstName = $_POST['first-name'];
       $lastName = $_POST['last-name'];
       $payment_id = $paymentMethods[$_POST['payment']];

       // $error stores any errors found. If empty then no errors found
       $error = array();

       // validate names
       if (!isValidName($firstName)) {
        array_push($error,"Invalid first name");
    }

        if (!isValidName($lastName)) {
            array_push($error,"Invalid last name");
        }


        //validate username
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
        if (!preg_match('/^(?![0-9])[\w]+$/i', $username)) {
            array_push($error,"Invalid username");
        }

        // validate phone number
        $phone_number = filter_input(INPUT_POST,"phone_number",FILTER_SANITIZE_SPECIAL_CHARS);
        if (!preg_match('/^[0-9]{10}$/', $phone_number)) {
            array_push($error,"Invalid phone_number");
        }

        // validate email
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $domain = substr($email, strpos($email, '@') + 1);
        if (!checkdnsrr($domain, "MX")) {
            array_push($error,"Invalid email");
        }

        // sanitize password
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);

        // salting password to store in the database 
        $hash =  password_hash($password,PASSWORD_DEFAULT);

       echo $firstName ."<br>";
       echo $lastName."<br>";
       echo $email."<br>";
       echo $username."<br>";
       echo $password."<br>";
       echo $phone_number."<br>";
       echo $payment_id."<br>";

        if (empty($error)) {
            // all data is valid insert in the database

            echo "everthing valid <br>";

            $pay_status = 1;

            $firstName = ucwords(strtolower($firstName));
            $lastName = ucwords(strtolower($lastName));

            $insert_customer = "INSERT INTO customers (first, last, username, email, password, phone_number, pay_status)
                VALUES ('$firstName', '$lastName', '$username', '$email', '$hash', '$phone_number', '$pay_status');";

            $insert_payment = "INSERT INTO payments (cust_username, pay_date, due_date, payment_method_id)
            VALUES ('$username', now(), DATE_ADD(NOW(), INTERVAL 1 MONTH),$payment_id);";

            
            try {
                // add customer to the database
                mysqli_query($conn,$insert_customer);
                echo "User Registered";

                // store info about the user to be used further
                $_SESSION['username'] = $username;

                // record payment
                mysqli_query($conn,$insert_payment);
                echo "Payment Registered";

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