<?php

include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');
        exit();
    } else {
        $message[] = 'Incorrect email or password!';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Favicon -->
   <link rel="icon" type="image/png" href="images/logo.png">

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .form-container {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 80vh;
      }
      .form-container form {
         text-align: center;
         padding: 20px;
         background: rgb(171, 171, 171);
         border-radius: 10px;
         box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
         width: 400px;
      }
      .form-container .logo {
         width: 250px;
         margin-bottom: 10px;
      }
      .error-msg {
         color: red;
         font-size: 14px;
         margin-bottom: 10px;
      }
      body {
      background: url('images/background1.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
   }
   </style>
</head>
<body>

<!-- Header section -->
<?php include 'components/user_header.php'; ?>
<!-- Header section ends -->

<section class="form-container">
   <form action="" method="post">
      <img src="images/logo.png" alt="NourishedPH Logo" class="logo">
      <h3>Login Now</h3>
      
      <?php
         if (isset($message)) {
            foreach ($message as $msg) {
               echo '<p class="error-msg">' . $msg . '</p>';
            }
         }
      ?>

      <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login Now" name="submit" class="btn">
      <p>Don't have an account? <a href="register.php">Register Now!</a></p>

   </form>
</section>

<?php include 'components/footer.php'; ?>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>