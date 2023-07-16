<?php echo "Welcome to " . $_SERVER["PHP_SELF"]; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome to My Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .btn {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      margin: 0 10px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    .a {
  color: white;
  text-decoration: none; /* no underline */
}
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to My Website</h1>
    <div class="btn-group">
      <form method="post">
        <input class="btn" type="submit" name="signin_btn" value="SIGNIN">
        <input class="btn" type="submit" name="signup_btn" value="SIGNUP">        
    </div>
  </div>
</body>
</html>


<?php 
// handles redirection to signin or signup

if (isset($_POST['signin_btn'])) {
  // Signin pressed
  // redirect to signin page
  header("Location: signin.php");
}

if (isset($_POST['signup_btn'])) {
   // Signup pressed
    // redirect to signup page
  header("Location: signup.php");
}

?>


