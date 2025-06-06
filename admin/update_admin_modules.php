<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $mid = $_POST['mid'];
   $mid = filter_var($mid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_module = $conn->prepare("UPDATE `modules` SET name = ?, category = ? WHERE id = ?");
   $update_module->execute([$name, $category, $mid]);

   $message[] = 'Module updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `modules` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $mid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'Image updated!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Module</title>
   <link rel="icon" type="image/png" href="admin_images/NourishedPHlogo.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="update-product">
   <h1 class="heading">Update Module</h1>

   <?php
      $update_id = $_GET['update'];
      $show_modules = $conn->prepare("SELECT * FROM `modules` WHERE id = ?");
      $show_modules->execute([$update_id]);
      if($show_modules->rowCount() > 0){
         while($fetch_modules = $show_modules->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="mid" value="<?= $fetch_modules['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_modules['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_modules['image']; ?>" alt="">
      <span>Update Name</span>
      <input type="text" required placeholder="Enter module name" name="name" maxlength="100" class="box" value="<?= $fetch_modules['name']; ?>">
      <span>Update Category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_modules['category']; ?>"><?= $fetch_modules['category']; ?></option>
         <option value="Web Development">Web Development</option>
         <option value="Data Science">Data Science</option>
         <option value="Cyber Security">Cyber Security</option>
         <option value="Cloud Computing">Cloud Computing</option>
      </select>
      <span>Update Display Picture</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Update" class="btn" name="update">
         <a href="admin_modules.php" class="option-btn">Go Back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">No modules found!</p>';
      }
   ?>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
