<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_module'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $reference = $_POST['reference'];
   $reference = filter_var($reference, FILTER_SANITIZE_URL);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_modules = $conn->prepare("SELECT * FROM `modules` WHERE title = ?");
   $select_modules->execute([$title]);

   if($select_modules->rowCount() > 0){
      $message[] = 'Module title already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'Image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_module = $conn->prepare("INSERT INTO `modules`(title, description, reference, image) VALUES(?,?,?,?)");
         $insert_module->execute([$title, $description, $reference, $image]);

         $message[] = 'New module added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_module_image = $conn->prepare("SELECT * FROM `modules` WHERE id = ?");
   $delete_module_image->execute([$delete_id]);
   $fetch_delete_image = $delete_module_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_module = $conn->prepare("DELETE FROM `modules` WHERE id = ?");
   $delete_module->execute([$delete_id]);
   header('location:admin_modules.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Educational Modules</title>
   <link rel="icon" type="image/png" href="admin_images/NourishedPHlogo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Educational Module</h3>
      <input type="text" required placeholder="Enter module title" name="title" maxlength="100" class="box">
      <textarea required placeholder="Enter module description" name="description" class="box"></textarea>
      <input type="url" required placeholder="Paste reference link" name="reference" class="box">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Add Module" name="add_module" class="btn" >
   </form>
</section>

<section class="show-products" style="padding-top: 0;">
   <div class="box-container">
   <?php
      $show_modules = $conn->prepare("SELECT * FROM `modules`");
      $show_modules->execute();
      if($show_modules->rowCount() > 0){
         while($fetch_modules = $show_modules->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_modules['image']; ?>" alt="">
      <div class="name"> <?= $fetch_modules['title']; ?> </div>
      <p><?= $fetch_modules['description']; ?></p>
      <a href="<?= $fetch_modules['reference']; ?>" class="option-btn" target="_blank">View Reference</a>
      <div class="flex-btn">
         <a href="update_module.php?update=<?= $fetch_modules['id']; ?>" class="option-btn">Update</a>
         <a href="admin_modules.php?delete=<?= $fetch_modules['id']; ?>" class="delete-btn" onclick="return confirm('Delete this module?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No modules added yet!</p>';
      }
   ?>
   </div>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
