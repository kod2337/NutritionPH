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

<header class="header">
   <section class="flex">
      
      <!-- Logo Section -->
      <a href="dashboard.php" class="logo">
         <img src="../images/logo.png" alt="NourishedPH Logo" class="logo-img">
      </a>

      <nav class="navbar">
         <a href="dashboard.php">DASHBOARD</a>
         <a href="admin_modules.php">MODULES</a>
         <a href="products.php">PRODUCTS</a>
         <a href="placed_orders.php">ORDERS</a>
         <a href="admin_accounts.php">ADMINS</a>
         <a href="users_accounts.php">USERS</a>
         <a href="messages.php">MESSAGES</a>
         <a href="customerfeedback.php">FEEDBACK</a>
         <a href="admin_donations.php">DONATIONS</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            
         <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>
</header>

