<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};
include 'chatbot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .table-container {
         width: 100%;
         overflow-x: auto;
         background: rgb(171, 171, 171);
         border-radius: 10px; 
      }
      table {
         width: 100%;
         border-collapse: collapse;
         text-align: left;
      }
      th, td {
         padding: 12px;
         border: var(--border);
      }
      th {
         background: black;
         font-weight: bold;
         color: white;
         text-align: center;
      }
      .empty {
         text-align: center;
         font-size: 18px;
         color: red;
         margin: 20px 0;
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
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Your Orders</h3>
   <p><a href="html.php">home</a> <span> / Your Orders</span></p>
</div>

<section class="orders">
   <div class="table-container">
   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
   ?>
   <table>
      <thead>
         <tr>
            <th>Placed On</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Address</th>
            <th>Payment Method</th>
            <th>Orders</th>
            <th>Total Price</th>
            <th>Payment Status</th>
         </tr>
      </thead>
      <tbody>
         <?php while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ ?>
         <tr>
            <td><?= $fetch_orders['placed_on']; ?></td>
            <td><?= $fetch_orders['name']; ?></td>
            <td><?= $fetch_orders['email']; ?></td>
            <td><?= $fetch_orders['number']; ?></td>
            <td><?= $fetch_orders['address']; ?></td>
            <td><?= $fetch_orders['method']; ?></td>
            <td><?= $fetch_orders['total_products']; ?></td>
            <td>₱<?= $fetch_orders['total_price']; ?>/-</td>
            <td style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>">
               <?= $fetch_orders['payment_status']; ?>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
      }
   ?>
   </div>
</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
