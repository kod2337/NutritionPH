<?php

include '../components/connect.php';
session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
      exit();
   } else {
      $message[] = 'Incorrect username or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <link rel="icon" type="image/png" href="admin_images/logo.png">


   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

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
         background: #fff;
         border-radius: 10px;
         box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
         width: 400px;
      }
      .form-container .logo {
         width: 250px;
         margin-bottom: 10px;
         margin-left: 50px
      }
      .error-msg {
         color: red;
         font-size: 14px;
         margin-bottom: 10px;
      }
   </style>

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- Admin login form section -->
<section class="form-container">
   <form action="" method="POST">
      <img src="../images/logo.png" alt="NourishedPH Logo" class="logo">
      <h3>Admin Login</h3>

      <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login Now" name="submit" class="btn">
   </form>
</section>

</body>
</html>
