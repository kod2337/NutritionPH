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
    <title>Donation QR-Code</title>
    <link rel="icon" type="image/png" href="images/NourishedPHlogo.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        /* Center the container */
        .donation-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: rgb(171, 171, 171);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .donation-container h1 {
            color: black;
            margin-bottom: 10px;
        }

        .donation-container p {
            font-size: 14px;
            color: black;
            margin-bottom: 20px;
        }

        .donation-container .input-box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .donation-container .btn {
            width: 100%;
            padding: 10px;
            background: var(--yellow);
            color: var(--black);
            border: var(--border);
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .donation-container .btn:hover {
            background: var(--yellow);
        }
    </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="donation">
<div class="donation-container">
    <h1>Donate via GCash</h1>
    <p class="welcome-text">Kind hearts welcome you! Your cash donations will be converted into food baskets for those in need.</p>

    <?php if (!empty($errorMessage)): ?>
        <p class="error" style="color:red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <div class="qr-code-section">
        <p>Open your GCash app and scan the provided QR code to donate instantly:</p>
        <img src="images/qrcode1-gab.jpg" alt="Donate QR Code">
    </div>

    <a href="home.php" class="btn">Go to Home</a>
</div>

<style>
    .donation-container {
        max-width: 500px;
        margin: auto;
        padding: 25px;
        background: rgb(171, 171, 171);
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border: var(--border);
        
    }
    .donation-container .qr-code-section .p{
        color: black;
    }

    .welcome-text {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 20px;
    }

    .input-box {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn {
        width: 100%;
        padding: 12px;
        font-size: 1.2rem;
        color: #fff;
        background: var(--yellow);
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .btn:hover {
        background: var(--yellow);
    }

    .qr-code-section {
        margin-top: 20px;
    }

    .qr-code-section img {
        width: 100%;
        max-width: 250px;
        border-radius: 10px;
        border: var(--border);
        margin-bottom: 10px;
    }
    
    body {
      background: url('images/background1.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
   }
</style>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
