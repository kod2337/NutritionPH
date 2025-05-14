<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'chatbot.php';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>
   <link rel="icon" type="image/png" href="images/logo.png">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/logow.png" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>✅ NourishedPH is prioritizing both health and budget, making nutritious food accessible to everyone.</p>
         <p>✅ NourishedPH aligns with SDG 2, working towards eradicating hunger in the Philippines.</p>
         <p>✅ NourishedPH uses fresh, locally grown produce to support farmers and ensure quality.</p>
         <p>✅ NourishedPH has accessible food stalls in strategic locations.</p>
         <p>✅ NourishedPH aims to create a lasting impact on food security and nutrition.</p>
         <p>✅ NourishedPH raises awareness about nutritious food choices and promotes responsible consumption to help reduce food waste in the country.</p>
         <a href="menu.php" class="btn">our menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- Our Team Section Starts -->
<section class="our-team">
   <h1 class="title">Partnerships</h1>

   <div class="team-container">
      <div class="team-video">
         <video controls>
            <source src="videos/bigaysaya.mp4" type="video/mp4">
            Your browser does not support the video tag.
         </video>
      </div>

      <div class="team-description p">
         <h3>
            PROJECT OF FORMER KAGAWAD RJ BARROS OF BARANGAY MARCELO IN PARANAQUE
         </h3><span></span>
         <p>
            NourishedPH is a humanitarian initiative dedicated to combating hunger, malnutrition, and food insecurity in the Philippines. 
            In partnership with former Barangay Marcelo Kagawad in Parañaque, RJ Barros, the organization has been instrumental in providing 
            immediate relief and sustainable solutions to those in need, particularly children and families affected by global disasters and 
            economic hardships.
         </p>
         <p>
            At the core of NourishedPH’s mission is its commitment to food assistance, community support, and education. The organization 
            distributes nutritious meals to impoverished communities, ensuring that children and families have access to essential nourishment. 
            In times of calamities, such as typhoons, earthquakes, and other global crises, NourishedPH steps in to provide food relief and 
            assistance to those struggling to rebuild their lives.
         </p>
         <p>
            Beyond immediate aid, the initiative focuses on long-term solutions to food insecurity. Through educational programs and 
            community workshops, NourishedPH empowers individuals with knowledge about proper nutrition, food sustainability, and waste reduction. 
            By teaching families how to maximize their resources, make healthier food choices, and minimize waste, the organization fosters 
            a culture of sustainability and self-reliance.
         </p>
         <p>
            With the partnership between NourishedPH and RJ Barros, the initiative continues to expand its reach, ensuring that more communities 
            receive the support they need. Through their collective efforts, they strive to build a healthier, more food-secure future for 
            Filipinos, ensuring that no one goes hungry and that every child has the opportunity to thrive.
         </p>
      </div>
   </div>
</section>
<!-- Our Team Section Ends -->

<div class="slider-container">
      <div class="swiper mySwiper"> <!-- ✅ Add the 'mySwiper' class -->
         <div class="swiper-wrapper"> <!-- ✅ Correct wrapper class -->
            <div class="swiper-slide"><img src="images/kag5.jpg" alt="RJ Barros raising awareness"></div>
            <div class="swiper-slide"><img src="images/kag2.jpg" alt="RJ Barros speaking to community"></div>
            <div class="swiper-slide"><img src="images/kag3.jpg" alt="Community food assistance"></div>
            <div class="swiper-slide"><img src="images/kag1.jpg" alt="RJ Barros food waste awareness"></div>
            <div class="swiper-slide"><img src="images/kag4.jpg" alt="Community gathering for food aid"></div>
            <div class="swiper-slide"><img src="images/kag6.jpg" alt="RJ Barros with volunteers"></div>
         </div>
         <!-- Navigation Buttons -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
         <!-- Pagination Dots -->
         <div class="swiper-pagination"></div> <!-- ✅ Fix this class -->
      </div>

      <p class="slider-description">
       Former Kagawad RJ Barros raising awareness about food insecurity and food waste in their Barangay.
      </p>
   </div>
</section>

<!-- Swiper JS & CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Fixed Swiper Initialization -->
<script>
   var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      navigation: {
         nextEl: ".swiper-button-next",
         prevEl: ".swiper-button-prev",
      },
      pagination: {
         el: ".swiper-pagination",  // ✅ Fixed this class
         clickable: true,
      },
   });
</script>

<style>
   .team-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      align-items: center;
      background: rgb(171, 171, 171);
      padding: 40px;
      border-radius: 10px;
      border: var(--border);
   }

   .team-video {
      flex: 1 1 400px;
      max-width: 500px;
      text-align: center;
   }
   .team video p{
      font-size: 1.3rem;
      line-height: 2;
      color: var(--black);
   }

   .team-video video {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border: var(--border);
      margin-top: -340px;
   }

   .team-description {
      flex: 1 1 400px;
      max-width: 600px;
   }

   .team-description p {
      font-size: 1.5rem;
      line-height: 2;
      color: var(--black);
   }

   .our-team .team-container .team-description p h3{
      font-size: 3rem;
      margin-bottom: 10px:
      
      
   }


   .slider-container {
      width: 100%;
      max-width: 1160px;
      max-height: auto;
      margin: 10px auto;
      padding: 20px;
      background: rgb(171, 171, 171);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      border: var(--border);
   }

   .swiper {
      width: 100%;
      height: 500px;
   }

   .swiper-wrapper {
      display: flex;
   }

   .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
   }

   .swiper-slide img {
      width: 92%;
      height: 90%;
      object-fit: cover;
      border-radius: 10px;
      border: var(--border);
   }
   .slider-description{
      color: var(--black);
   }


   .swiper-button-next, .swiper-button-prev {
      color: var(--yellow);
   }

   .swiper-pagination-bullet-active{
   background-color: var(--yellow);
}

   .slider-description {
      font-size: 18px;
      margin-top: 10px;
      color: var(--black);
   }

   body {
      background: url('images/background1.jpg') no-repeat center center fixed;
      background-size: cover;
   }
</style>


<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Go to Nearest Food Stall</h3>
         <p>We'll post in our socials (@NourishedPH) on where would be the next Food Stall Location.</p>
      </div>

      <div class="box">
         <img src="images/qr-removebg-preview.png" alt="">
         <h3>Scan QR code to see our Website</h3>
         <p>Enjoy our website's features where you can see our Menu and Nutritious Modules to raise awareness.</p>
      </div>

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order Via Our Website</h3>
         <p>Choose our Healthy, Nutritious and Affordable Foods.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy our healthy food</h3>
         <p>Ending hunger starts with us!</p>
      </div>

      <div class="box">
         <img src="images/qrcode1-gab-removebg-preview.png" alt="">
         <h3>Gcash QR Code for Donations</h3>
         <p>Your Gcash donations will be converted into food baskets for the less fortunate.</p>

         <a href="donate.php" class="btn">Donate Now</a>

      </div>

      <div class="box">
         <img src="images/feedbackicon-removebg-preview.png" alt="">
         <h3>Leave us a Feedback</h3>
         <p>Your feedback means a lot to us! It helps us improve and serve you better. </p>

         <a href="feedback.php" class="btn">Go to Feedback</a>

      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->
<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>