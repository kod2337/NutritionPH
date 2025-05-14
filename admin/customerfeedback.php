<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Delete feedback
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_feedback = $conn->prepare("DELETE FROM `feedback` WHERE id = ?");
    $delete_feedback->execute([$delete_id]);
    header('location:customerfeedback.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer Feedback</title>
   <link rel="icon" type="image/png" href="admin_images/NourishedPHlogo.png">

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      .box-container {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
         justify-content: center;
      }
      .box {
         background: #fff;
         border-radius: 10px;
         padding: 20px;
         width: 300px;
         box-shadow: 0 4px 8px rgba(0,0,0,0.1);
         text-align: center;
      }
      .box img {
         width: 100px;
         height: 100px;
         border-radius: 50%;
         object-fit: cover;
         margin-bottom: 10px;
      }
      .rating {
         color: gold;
         font-size: 18px;
      }
   </style>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- Client Feedback Section -->
<section class="messages">

   <h1 class="heading">Customer Feedback</h1>

   <div class="box-container">

   <?php
      // Fetch feedback from food_db
      $select_feedback = $conn->prepare("SELECT * FROM `feedback` ORDER BY id DESC");
      $select_feedback->execute();
      if ($select_feedback->rowCount() > 0) {
         while ($fetch_feedback = $select_feedback->fetch(PDO::FETCH_ASSOC)) {
            // Image path setup
            $image_path = !empty($fetch_feedback['image']) ? '../images/' . $fetch_feedback['image'] : '../images/default.png';

            // Generate star ratings
            $rating_stars = str_repeat("★", $fetch_feedback['rating']) . str_repeat("☆", 5 - $fetch_feedback['rating']);
   ?>
   <div class="box">
      <img src="<?= $image_path; ?>" alt="User Image">
      <p><strong>Name:</strong> <span><?= htmlspecialchars($fetch_feedback['name']); ?></span></p>
      <p class="rating"><?= $rating_stars; ?></p>
      <p><strong>Feedback:</strong> <span><?= htmlspecialchars($fetch_feedback['comment']); ?></span></p>
      <a href="customerfeedback.php?delete=<?= $fetch_feedback['id']; ?>" class="delete-btn" onclick="return confirm('Delete this feedback?');">Delete</a>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No feedback received yet</p>';
      }
   ?>

   </div>

</section>

<!-- Custom JS -->
<script src="../js/admin_script.js"></script>

</body>
</html>
