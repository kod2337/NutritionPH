<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store "Anonymous" if name is not entered
    $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : "Anonymous";
    
    // Store "N/A" if address is not entered
    $address = !empty($_POST['address']) ? htmlspecialchars($_POST['address']) : "N/A";
    
    // Validate donation amount
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    if ($amount > 0) {
        // Insert into database
        $insert_donation = $conn->prepare("INSERT INTO donations (name, address, amount) VALUES (?, ?, ?)");
        
        if ($insert_donation->execute([$name, $address, $amount])) {
            // Redirect to GCash payment page
            header("Location: donate_qrcode.php");
            exit();
        } else {
            $errorMessage = "Failed to record donation. Please try again.";
        }
    } else {
        $errorMessage = "Please enter a valid donation amount.";
    }
}
include 'chatbot.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        /* Center the container */
        .donation-container {
            max-width: 500px;
            margin: 10px auto;
            padding: 20px;
            background: rgb(171, 171, 171);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            border: var(--border);
        }

        .donation-container h1 {
            color: solid black;
            margin-bottom: 10px;
        }

        .donation-container p {
            font-size: 14px;
            color: solid black;
            margin-bottom: 20px;
        }

        .donation-container .input-box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .donation-container .btn {
            width: 100%;
            padding: 10px;
            background: var(--yellow);
            color: black;
            border: var(--border);
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .donation-container .btn:hover {
            background: var(--yellow);
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
   <h3>Donation Form</h3>
   <p><a href="home.php">home</a> <span> / Donation Form</span></p>
   </div>

<section class="donation">
    <div class="donation-container">
        <h1>Donate via GCash</h1>
        <p>Your cash donations will be converted into food baskets for the less fortunate.</p>

        <?php if (!empty($errorMessage)): ?>
            <p class="error" style="color:red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="name">Full Name (Optional)</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" class="input-box">

            <label for="address">Address (Optional)</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" class="input-box">

            <label for="amount">Donation Amount (₱)</label>
            <input type="decimal" id="amount" name="amount" placeholder="Enter amount" required min="1" step="0.01" class="input-box">

            <button type="submit" class="btn">Proceed to Donate</button>
        </form>
        <button onclick="history.back()" class="btn" style="margin-top: 10px;">Go Back</button>
    </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
