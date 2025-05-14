<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';
include 'chatbot.php';

// Fetch products for display
function getLatestProducts($conn, $limit = 6) {
    $select_products = $conn->prepare("SELECT * FROM `products` LIMIT ?");
    $select_products->bindValue(1, $limit, PDO::PARAM_INT);
    $select_products->execute();
    
    return $select_products;
}

// Get products data
$products = getLatestProducts($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>NourishedPH - Healthy Food Delivery</title>
   <meta name="description" content="NourishedPH offers delicious and healthy meal options delivered to your doorstep.">
   <link rel="icon" type="image/png" href="images/logo.png">
   
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <!-- Swiper CSS -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
   <!-- AOS Library -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
   
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/custom.css">

<style>
      :root {
         --primary-color: #2ecc71;
         --secondary-color: #27ae60;
         --accent-color: #f39c12;
         --text-color: #333;
         --light-bg: rgba(255, 255, 255, 0.95);
         --box-shadow: 0 8px 30px rgba(0,0,0,0.1);
         --border-radius: 15px;
         --transition: all 0.3s ease;
   }
   
   body {
         font-family: 'Poppins', sans-serif;
         /*background: url('images/background1.jpg') no-repeat center center fixed; */
         background: linear-gradient(135deg, #f5f7fa 0%, #e4efe9 100%);
      background-size: cover;
      margin: 0;
      padding: 0;
         color: var(--text-color);
         min-height: 100vh;
         position: relative;
      }
      
      h1, h2, h3, h4, h5, h6 {
         font-weight: 600;
         letter-spacing: -0.5px;
      }

      /* Floating Elements */
      .floating {
         animation: float 3s ease-in-out infinite;
      }

      @keyframes float {
         0% { transform: translateY(0px); }
         50% { transform: translateY(-10px); }
         100% { transform: translateY(0px); }
      }
      
      /* Welcome Popup */
.popup-message {
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
         color: white;
         padding: 20px 30px;
         border-radius: var(--border-radius);
         font-size: 18px;
         text-align: center;
         z-index: 1000;
         box-shadow: var(--box-shadow);
         opacity: 1;
         transition: opacity 0.5s ease-in-out;
      }

      /* Hero Section */
      .hero-container {
         width: 100%;
         max-width: 1200px;
         margin: 30px auto;
         padding: 0;
         border-radius: var(--border-radius);
         overflow: hidden;
         box-shadow: 0 15px 50px rgba(0,0,0,0.1);
         position: relative;
      }
      
      .hero {
         overflow: hidden;
         border-radius: var(--border-radius);
         background: var(--light-bg);
      }
      
      .swiper-slide.slide {
         display: flex;
         align-items: center;
         height: 500px;
         padding: 0 30px;
         background: #ffffff;
         position: relative;
      }
      
      .slide .content {
         flex: 1;
         padding: 40px;
         z-index: 2;
      }
      
      .slide .content h3 {
         font-size: 2.8rem;
         margin-bottom: 20px;
         color: var(--primary-color);
         position: relative;
         font-weight: 700;
         display: inline-block;
      }
      
      .slide .content h3:after {
         content: '';
         position: absolute;
         bottom: -10px;
         left: 0;
         width: 60px;
         height: 3px;
         background: var(--accent-color);
      }
      
      .slide .content p {
         font-size: 1.1rem;
         line-height: 1.8;
         margin-bottom: 30px;
         color: #555;
      }
      
      .slide .image {
         flex: 1;
         display: flex;
         justify-content: center;
         align-items: center;
         padding: 20px;
         z-index: 1;
      }
      
      .slide .image img {
         max-width: 100%;
         height: auto;
         border-radius: var(--border-radius);
         box-shadow: var(--box-shadow);
         transition: var(--transition);
      }
      
      .slide .image img:hover {
         transform: scale(1.05);
      }
      
      .swiper-pagination-bullet {
         width: 12px;
         height: 12px;
         background: var(--primary-color);
         opacity: 0.5;
      }
      
      .swiper-pagination-bullet-active {
         opacity: 1;
         background: var(--primary-color);
      }
      
      .btn-custom {
         display: inline-block;
         background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
         color: white;
         padding: 14px 30px;
         border-radius: 30px;
         font-size: 16px;
         font-weight: 500;
         text-transform: uppercase;
         letter-spacing: 1px;
         transition: var(--transition);
         border: none;
         box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
         position: relative;
         overflow: hidden;
         z-index: 1;
      }
      
      .btn-custom:before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 0%;
         height: 100%;
         background: var(--accent-color);
         transition: 0.5s ease;
         z-index: -1;
      }
      
      .btn-custom:hover {
         transform: translateY(-3px);
         box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
         color: white;
      }
      
      .btn-custom:hover:before {
         width: 100%;
      }
      
      /* Category Section */
      .category-section {
         padding: 80px 0 40px;
      }
      
      .section-title {
         text-align: center;
      margin-bottom: 50px;
         font-size: 2.5rem;
         color: var(--primary-color);
         text-transform: capitalize;
         position: relative;
         display: inline-block;
         font-weight: 700;
      }
      
      .section-title:after {
         content: '';
         position: absolute;
         bottom: -15px;
         left: 0;
         width: 100%;
         height: 3px;
         background: var(--accent-color);
      }
      
      .category-card {
         background: var(--light-bg);
         border-radius: var(--border-radius);
         padding: 40px 30px;
         text-align: center;
         transition: var(--transition);
         box-shadow: var(--box-shadow);
         position: relative;
         overflow: hidden;
         z-index: 1;
         height: 100%;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         text-decoration: none;
         border: 1px solid rgba(0,0,0,0.05);
      }
      
      .category-card:before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
         opacity: 0;
         z-index: -1;
         transition: var(--transition);
      }
      
      .category-card:hover:before {
         opacity: 0.9;
      }
      
      .category-card:hover {
         transform: translateY(-10px);
      }
      
      .category-card img {
         height: 100px;
         margin-bottom: 20px;
         transition: var(--transition);
         filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
      }
      
      .category-card:hover img {
         transform: scale(1.1);
         filter: brightness(0) invert(1);
      }
      
      .category-card h3 {
         font-size: 1.5rem;
         color: var(--text-color);
         transition: var(--transition);
         margin-top: 15px;
      }
      
      .category-card:hover h3 {
         color: white;
      }
      
      /* Products Section */
      .products-section {
         padding: 40px 0 80px;
      }
      
      .product-card {
         background: var(--light-bg);
         position: relative;
         border-radius: var(--border-radius);
         box-shadow: var(--box-shadow);
         overflow: hidden;
         transition: var(--transition);
         height: 100%;
         display: flex;
         flex-direction: column;
         border: 1px solid rgba(0,0,0,0.05);
      }
      
      .product-card:hover {
         transform: translateY(-10px);
         box-shadow: 0 15px 35px rgba(0,0,0,0.1);
      }
      
      .product-image {
         height: 220px;
         width: 100%;
         object-fit: cover;
      }
      
      .product-icons {
         position: absolute;
         top: 20px;
         width: 100%;
         display: flex;
         justify-content: space-between;
         padding: 0 20px;
      }
      
      .product-icon {
         height: 40px;
         width: 40px;
         line-height: 40px;
         text-align: center;
         background: white;
         color: var(--text-color);
         font-size: 1rem;
         border-radius: 50%;
         transition: var(--transition);
         opacity: 0;
         transform: translateY(20px);
      }
      
      .product-card:hover .product-icon {
         opacity: 1;
         transform: translateY(0);
      }
      
      .product-icon:hover {
         background: var(--primary-color);
         color: white;
      }
      
      .product-category {
         font-size: 0.85rem;
         color: var(--primary-color);
         text-transform: uppercase;
         letter-spacing: 1px;
         display: block;
         margin: 15px 20px 5px;
         font-weight: 500;
      }
      
      .product-name {
         font-size: 1.2rem;
         color: var(--text-color);
         padding: 0 20px;
         margin-bottom: 15px;
         font-weight: 600;
      }
      
      .product-footer {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 15px 20px 20px;
         margin-top: auto;
         border-top: 1px solid rgba(0,0,0,0.05);
      }
      
      .product-price {
         font-size: 1.3rem;
         color: var(--primary-color);
         font-weight: 700;
      }
      
      .product-quantity {
         padding: 8px;
         border: 1px solid #ddd;
         border-radius: 5px;
         width: 60px;
         font-size: 1rem;
      }
      
      /* Animation */
      @keyframes fadeInUp {
         from {
            opacity: 0;
            transform: translateY(20px);
         }
         to {
            opacity: 1;
            transform: translateY(0);
         }
      }
      
      .animate {
         animation: fadeInUp 0.8s ease forwards;
      }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div id="welcomePopup" class="popup-message">
   <i class="fas fa-utensils" style="margin-right: 10px;"></i>
   Welcome to NourishedPH! Enjoy healthy and delicious meals! 🍽️
</div>

<div class="container">
   <!-- Hero Section -->
   <section class="hero-container" data-aos="fade-up">
      <div class="hero">
         <div class="swiper hero-slider">
            <div class="swiper-wrapper">

               <div class="swiper-slide slide">
                  <div class="content" data-aos="fade-right" data-aos-delay="200">
                     <span class="badge bg-success mb-2">Featured</span>
                     <h3>Chicken Teriyaki</h3>
                     <p>🍗 A delicious Japanese-inspired dish featuring tender chicken glazed with a savory-sweet teriyaki sauce, served with steamed rice and fresh vegetables.</p>
                     <a href="menu.php" class="btn btn-custom">Explore Our Menu</a>
                  </div>
                  <div class="image" data-aos="fade-left" data-aos-delay="400">
                     <img src="images/chickenteriyaki.jpg" alt="Chicken Teriyaki" class="img-fluid floating">
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="content" data-aos="fade-right" data-aos-delay="200">
                     <span class="badge bg-success mb-2">Popular</span>
                     <h3>Stir-Fried Kangkong</h3>
                     <p>🥬 A healthy and flavorful Filipino favorite, made with fresh water spinach stir-fried in garlic, soy sauce, and a hint of chili for a perfect balance of taste and texture.</p>
                     <a href="menu.php" class="btn btn-custom">Explore Our Menu</a>
                  </div>
                  <div class="image" data-aos="fade-left" data-aos-delay="400">
                     <img src="images/stirfriedkangkong.jpg" alt="Stir-Fried Kangkong" class="img-fluid floating">
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="content" data-aos="fade-right" data-aos-delay="200">
                     <span class="badge bg-success mb-2">Fresh</span>
                     <h3>Pepino Salad</h3>
                     <p>🥒 A refreshing pepino salad tossed with a light vinaigrette, red onions, and a touch of citrus, making it the perfect side dish for any meal.</p>
                     <a href="menu.php" class="btn btn-custom">Explore Our Menu</a>
                  </div>
                  <div class="image" data-aos="fade-left" data-aos-delay="400">
                     <img src="images/pepino.jpg" alt="Pepino Salad" class="img-fluid floating">
                  </div>
               </div>

   </div>

            <div class="swiper-pagination"></div>
         </div>
      </div>
   </section>

   <!-- Stats Section -->
   <section class="py-5" data-aos="fade-up">
      <div class="row text-center g-4">
         <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="stats-card p-4 rounded-3">
               <i class="fas fa-utensils stats-icon fa-2x mb-3"></i>
               <h3 class="h4 mb-2">Fresh Ingredients</h3>
               <p class="mb-0">We use only the freshest ingredients for all our dishes</p>
            </div>
         </div>
         <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="stats-card p-4 rounded-3">
               <i class="fas fa-carrot stats-icon fa-2x mb-3"></i>
               <h3 class="h4 mb-2">Healthy Meals</h3>
               <p class="mb-0">Nutritionally balanced meals for your wellbeing</p>
            </div>
         </div>
         <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
            <div class="stats-card p-4 rounded-3">
               <i class="fas fa-truck stats-icon fa-2x mb-3"></i>
               <h3 class="h4 mb-2">Fast Delivery</h3>
               <p class="mb-0">Quick delivery to your doorstep</p>
            </div>
         </div>
      </div>
</section>

   <!-- Food Categories Section -->
   <section class="category-section" data-aos="fade-up">
      <div class="text-center mb-5">
         <h2 class="section-title d-inline-block">Food Categories</h2>
      </div>
      
      <div class="row g-4">
         <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <a href="category.php?category=main dish" class="category-card">
               <div class="category-icon mb-3">
                  <img src="images/cat-2.png" alt="Main Dishes">
               </div>
               <h3>Nutritious Dishes</h3>
               <p class="mt-2 text-muted">Delicious and healthy main courses</p>
            </a>
         </div>

         <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <a href="category.php?category=drinks" class="category-card">
               <div class="category-icon mb-3">
                  <img src="images/cat-3.png" alt="Drinks">
               </div>
               <h3>Healthy Drinks</h3>
               <p class="mt-2 text-muted">Refreshing and nutritious beverages</p>
            </a>
         </div>
      </div>
   </section>

   <!-- Latest Products Section -->
   <section class="products-section" data-aos="fade-up">
      <div class="text-center mb-5">
         <h2 class="section-title d-inline-block">Latest Dishes</h2>
      </div>
      
      <div class="row g-4">
      <?php
            if($products->rowCount() > 0){
               while($fetch_products = $products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <form action="" method="post" class="product-card">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
               
               <div class="product-icons">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="product-icon fas fa-eye"></a>
                  <button type="submit" class="product-icon fas fa-shopping-cart" name="add_to_cart"></button>
               </div>
               
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="product-image" alt="<?= $fetch_products['name']; ?>">
               <a href="category.php?category=<?= $fetch_products['category']; ?>" class="product-category"><?= $fetch_products['category']; ?></a>
               <div class="product-name"><?= $fetch_products['name']; ?></div>
               <div class="product-footer">
                  <div class="product-price"><span>₱</span><?= $fetch_products['price']; ?></div>
                  <input type="number" name="qty" class="product-quantity" min="1" max="99" value="1" maxlength="2">
               </div>
            </form>
         </div>
      <?php
               }
            } else {
               echo '<div class="col-12"><p class="alert alert-info text-center">No products added yet!</p></div>';
            }
         ?>
   </div>

      <div class="text-center mt-5" data-aos="fade-up">
         <a href="menu.php" class="btn btn-custom">View All Products</a>
   </div>
</section>
   
   <!-- Call to Action -->
   <section class="py-5 my-5 cta-section" data-aos="fade-up">
      <div class="row align-items-center">
         <div class="col-md-5 mb-4 mb-md-0 px-4">
            <div class="cta-content">
               <span class="cta-badge">NEW CUSTOMER SPECIAL</span>
               <h2 class="cta-title">Transform Your Diet Today!</h2>
               <p class="cta-text">Start your wellness journey with our chef-crafted, nutrient-rich meals delivered right to your door.</p>
               <ul class="cta-list">
                  <li><i class="fas fa-check-circle me-2"></i> Fresh, locally-sourced ingredients</li>
                  <li><i class="fas fa-check-circle me-2"></i> No preservatives or additives</li>
               </ul>
               <div class="cta-buttons">
                  <a href="menu.php" class="btn-cta-primary">VIEW MENU</a>
                  <a href="about.php" class="btn-cta-secondary">Learn More</a>
               </div>
            </div>
         </div>
         <div class="col-md-7 text-center">
            <div class="cta-image-container">
               <img src="images/fruits-veggies-circle.png" alt="Healthy Foods" class="cta-image-large">
               <div class="cta-discount">
                  <span class="discount-amount">10%</span>
                  <span class="discount-text">FIRST ORDER</span>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<?php include 'components/footer.php'; ?>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- AOS Animation Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<!-- Custom JS -->
<script src="js/script.js"></script>
<script src="js/home.js"></script>

</body>
</html>