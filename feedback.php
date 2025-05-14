<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Anonymous';
    $comment = htmlspecialchars($_POST['comment']);
    $rating = floatval($_POST['rating']);
    $default_image = 'user-icon.png';

    // Handle Image Upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "images/";
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = $target_dir . $image_name;
        $image_type = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        // Validate image type
        if (!in_array($image_type, $allowed_types)) {
            echo "<script>alert('Invalid image format. Please upload JPG, JPEG, PNG, or GIF.');</script>";
        } elseif ($_FILES["image"]["size"] > 5000000) {
            echo "<script>alert('File size too large. Maximum allowed size is 5MB.');</script>";
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
            $image = "images/" . $image_name; // Store relative path
        }
    } else {
        $image = $default_image;
    }

    // Insert into database
    $insert_feedback = $conn->prepare("INSERT INTO feedback (name, image, comment, rating) VALUES (?, ?, ?, ?)");
    $insert_feedback->execute([$name, $image, $comment, $rating]);
    header("Location: feedback.php");
    exit();
}

// Fetch feedback from the database
$select_feedback = $conn->prepare("SELECT name, image, comment, rating FROM feedback ORDER BY id DESC");
$select_feedback->execute();
$feedbacks = $select_feedback->fetchAll(PDO::FETCH_ASSOC);
include 'chatbot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer Feedback</title>
   <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .feedback-container {
   display: grid;
   grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
   gap: 10px;
   justify-items: center;
   padding: 20px;
}
      .feedback-box {
         background: rgb(171, 171, 171);
         padding: 10px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         text-align: center;
         max-width: 500px;
         max-height: 400px;
         height: 100%;
         width: 100%;
         border: var(--border);
         margin-bottom: 5px;
         margin-top: 5px;
      }
      
      .feedback-box img {
         width: 80px;
         height: 80px;
         border-radius: 50%;
         object-fit: cover;
      }
      .stars {
         color: gold;
         margin: 5px 0;
      }
      .feedback-form {
         text-align: center;
         padding: 20px;
         margin-top: 10px;
      }
      .feedback-form .box {
         max-width: 500px;
         margin: auto;
         background: rgb(171, 171, 171);
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         border: 2px solid black;
      }
      .feedback-form input, .feedback-form textarea, .feedback-form select, .feedback-form button {
         width: 100%;
         margin: 10px 0;
         padding: 10px;
         border-radius: 5px;
         border: 1px solid #ddd;
      }
      .feedback-form button {
         display: inline-block;
         background: var(--yellow); /* Adjust color as needed */
         color: #000;
         padding: 10px 20px;
         font-size: 16px;
         font-weight: bold;
         text-decoration: none;
         border-radius: 5px;
         transition: 0.3s ease-in-out;
         border: 2px solid black;
         margin-bottom: 20px;
         text-transform: capitalize;
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
   <h3>Customer Feedback</h3>
   <p><a href="home.php">home</a> <span> / Customer Feedback</span></p>
   </div>

<section class="feedback">

   <div class="feedback-container">
      <?php 
      $feedbacksToDisplay = array_slice($feedbacks, 0, 6); // Only take the first 6 feedbacks
      foreach ($feedbacksToDisplay as $feedback) { ?>
         <div class="feedback-box">
            <div class="image">
               <img src="images/<?= htmlspecialchars($feedback['image']); ?>" alt="User Image">
            </div>
            <div class="content">
               <h3><?= htmlspecialchars($feedback['name']); ?></h3>
               <div class="stars">
                  <?php
                  $fullStars = floor($feedback['rating']);
                  $halfStar = ($feedback['rating'] - $fullStars) >= 0.5;
                  for ($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                  if ($halfStar) echo '<i class="fas fa-star-half-alt"></i>';
                  ?>
               </div>
               <p><?= htmlspecialchars($feedback['comment']); ?></p>
            </div>
         </div>
      <?php } ?>
   </div>
</section>


<div class="heading">
   <h3>Feedback Form</h3>
   </div>

<section class="feedback-form">

   <form action="" method="POST" enctype="multipart/form-data" class="box">
      <label for="name">Your Name (Optional):</label>
      <input type="text" name="name" placeholder="Enter your name (or leave blank for Anonymous)">
      <label for="comment">Your Feedback:</label>
      <textarea name="comment" placeholder="Write your feedback here..." required></textarea>
      <label for="rating">Rating:</label>
      <select name="rating" required>
         <option value="5">★★★★★ (5 Stars)</option>
         <option value="4.5">★★★★☆ (4.5 Stars)</option>
         <option value="4">★★★★ (4 Stars)</option>
         <option value="3.5">★★★☆ (3.5 Stars)</option>
         <option value="3">★★★ (3 Stars)</option>
         <option value="2.5">★★☆ (2.5 Stars)</option>
         <option value="2">★★ (2 Stars)</option>
         <option value="1.5">★☆ (1.5 Stars)</option>
         <option value="1">★ (1 Star)</option>
      </select>
      <label for="image">Upload Image (Optional):</label>
      <input type="file" name="image" accept="images/*">
      <button type="submit" class="btn">Submit Feedback</button>
   </form>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
