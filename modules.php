<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}
include 'chatbot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Educational Modules</title>
   <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <style>
      .module-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
         padding: 20px;
      }
      .module-box {
         width: 300px;
         background: rgb(171, 171, 171);
         padding: 15px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0,0,0,0.1);
         text-align: center;
         cursor: pointer;
         transition: transform 0.3s ease-in-out, box-shadow 0.3s;
         border: var(--border);
      }
      .module-box:hover {
         transform: scale(1.05);
         box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      }
      .module-box img {
         width: 100%;
         height: 180px;
         object-fit: cover;
         border-radius: 10px;
         border: var(--border);
      }
      .module-box h3 {
         font-size: 18px;
         margin: 10px 0;
         color: #333;
      }
      .module-box p {
         font-size: 14px;
         color: var(--black);
         height: 50px;
         overflow: hidden;
         text-overflow: ellipsis;
         display: -webkit-box;
         -webkit-line-clamp: 2;
         -webkit-box-orient: vertical;
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

<div class="heading">
   <h3>Educational Modules</h3>
   <p><a href="home.php">home</a> <span> / Educational Modules</span></p>
   </div>

<section class="category">

   <div class="module-container">
      <?php
         $select_modules = $conn->prepare("SELECT * FROM `modules`");
         $select_modules->execute();
         if($select_modules->rowCount() > 0){
            while($fetch_module = $select_modules->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="module-box" onclick="window.location.href='modules_details.php?reference=<?= $fetch_module['reference']; ?>'">
         <img src="uploaded_img/<?= $fetch_module['image']; ?>" alt="<?= $fetch_module['title']; ?>">
         <h3><?= $fetch_module['title']; ?></h3>
         <p><?= $fetch_module['description']; ?></p>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No modules available yet!</p>';
         }
      ?>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
