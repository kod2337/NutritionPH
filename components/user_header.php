<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">
         <img src="images/logo.png" alt="NourishedPH Logo">
      </a>

      <nav class="navbar a">
         <a href="home.php">HOME</a>
         <a href="about.php">ABOUT</a>
         <a href="modules.php">MODULES</a>
         <a href="menu.php">MENU</a>
         <a href="orders.php">ORDERS</a>
         <a href="contact.php">CONTACT</a>
         <a href="feedback.php">FEEDBACK</a>
         <a href="donate.php">DONATE</a>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">Profile</a>
            <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="delete-btn">Logout</a>
         </div>
       
         <?php
            }else{
         ?>
            <p class="name">Please Login First!</p>
            <a href="login.php" class="btn">LOGIN</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

<style>
   .header {
   position: sticky;
   top: 0;
   left: 0;
   right: 0;
   z-index: 1000;
   background: rgba(255, 255, 255, 0.3); /* 70% visible, 30% transparent */
   border-bottom: var(--border);
   backdrop-filter: blur(5px); /* Optional: Adds a glass-like effect */
}

   .header .flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: auto;
   }
   .logo img {
   height: 150px;
   width: auto;
   transition: transform 0.2s ease-in-out, filter 0.2s ease-in-out;
   }

   .logo img:hover {
   transform: scale(1.1) rotate(0deg); /* Slight enlargement and rotation */
   filter: drop-shadow(0 0 10px var(--yellow)); /* Green glowing effect */
   }
   .header .logo img {
      height: 100px;
      width: auto;
   }

   .navbar a {
   margin: 0 10px;
   font-size: 16px;
   font-weight: bold;
   color: #333;
   text-decoration: none;
   position: relative;
   transition: transform 0.2s ease-in-out, filter 0.2s ease-in-out;
}

/* Navbar Hover Effect (Same as Logo) */
.navbar a:hover {
   color: var(--yellow); /* Same yellow color */
   transform: scale(1.1) rotate(3deg); /* Slight zoom and tilt */
   filter: drop-shadow(0 0 10px var(--yellow)); /* Yellow glowing effect */
}

.icons {
   display: flex;
   align-items: center;
}

/* Icons Default Style */
.icons a, .icons div {
   margin-left: 15px;
   font-size: 20px;
   color: #333;
   cursor: pointer;
   transition: transform 0.2s ease-in-out, filter 0.2s ease-in-out;
}

/* Icons Hover Effect (Same as Logo & Navbar) */
.icons a:hover, .icons div:hover {
   color: var(--yellow); /* Same yellow color */
   transform: scale(1.1) rotate(3deg); /* Slight zoom and tilt */
   filter: drop-shadow(0 0 10px var(--yellow)); /* Yellow glowing effect */
}

   .profile {
      position: absolute;
      top: 70px;
      right: 20px;
      background: #fff;
      padding: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      text-align: center;
      display: none;
   }

   .profile p.name {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
   }

   .profile .btn, .profile .delete-btn {
      display: inline-block;
      margin: 5px;
      padding: 8px 15px;
      background:var(--yellow);
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
   }

   .profile .delete-btn {
      background: var(--yellow);
   }

   .profile .btn:hover, .profile .delete-btn:hover {
      opacity: 0.8;
   }

   .message {
      background: var(--yellow);
      color: black;
      padding: 10px;
      margin-bottom: 10px;
      text-align: center;
      position: relative;
   }

   .message .fas {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
   }

</style>

<script>
   document.querySelector("#user-btn").onclick = () => {
      document.querySelector(".profile").classList.toggle("active");
   };

   document.addEventListener("DOMContentLoaded", function() {
      setTimeout(function() {
         let messageBox = document.querySelector('.message');
         if (messageBox) {
            messageBox.style.display = 'none';
         }
      }, 5000); // 5000ms = 5 seconds
   });
</script>
