<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_GET['reference'])){
   $reference = $_GET['reference'];

   $select_module = $conn->prepare("SELECT * FROM `modules` WHERE reference = ?");
   $select_module->execute([$reference]);

   if($select_module->rowCount() > 0){
      $module = $select_module->fetch(PDO::FETCH_ASSOC);
   } else {
      echo "<script>alert('Module not found!'); window.location.href='modules.php';</script>";
      exit;
   }
} else {
   echo "<script>alert('Invalid request!'); window.location.href='modules.php';</script>";
   exit;
}
include 'chatbot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $module['title']; ?></title>
   <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <style>
      .module-details {
         text-align: center;
         padding: 5px;
         border: var(--border);
         background: rgb(171, 171, 171);
         border-radius: 10px;
         width: 100%; /* Adjust as needed */
         max-width: 1000px; /* Ensures it doesn’t get too wide */
         height: 550px; /* Adjust as needed */
}
      .module-details img {
         width: 100%;
         max-width: 500px;
         height: auto;
         border-radius: 8px;
         margin-bottom: 10px;
         border: var(--border);
         margin-top: 20px;
      }
      .module-details h1 {
         font-size: 24px;
         margin-bottom: 10px;
      }
      .module-details p {
         font-size: 16px;
         color: var(--black);
         margin-bottom: 10px;
      }
     
      .view-reference-btn {
         display: inline-block;
         padding: 10px 20px;
         background-color: var(--yellow);
         color: var(--black);
         text-decoration: none;
         border-radius: 5px;
         font-size: 16px;
         margin-top: 10px;
         margin-bottom: 5px;
      }
      .view-reference-btn:hover {
         background-color:var(--yellow);
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

<?php include 'components/user_header.php'; ?>

<section class="module-details">
   
   <img src="uploaded_img/<?= $module['image']; ?>" alt="<?= $module['title']; ?>">
   <h1><?= $module['title']; ?></h1>
   <p><?= $module['description']; ?></p>

   <a href="<?= $module['reference']; ?>" class="btn" target="_blank">View Reference</a>
   <div class="flex-btn"></div>

   <iframe class="module-frame" src="<?= $module['url']; ?>" allowfullscreen></iframe>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
