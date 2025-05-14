<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit();
}

// Fetch all donations
$select_donations = $conn->prepare("SELECT * FROM `donations` ORDER BY donated_at DESC");
$select_donations->execute();

// Calculate total donation amount
$total_donations = $conn->prepare("SELECT SUM(amount) AS total FROM `donations`");
$total_donations->execute();
$total = $total_donations->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Donations</title>
   <link rel="icon" type="image/png" href="admin_images/NourishedPHlogo.png">

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      .donations-table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }
      .donations-table th, .donations-table td {
         border: 1px solid #ddd;
         padding: 10px;
         text-align: center;
      }
      .donations-table th {
         background-color: #333;
         color: white;
      }
      .total {
         margin-top: 20px;
         font-size: 18px;
         font-weight: bold;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="donations">
   <h1 class="heading">Donations</h1>

   <table class="donations-table">
      <thead>
         <tr>
            
            <th>Name</th>
            <th>Address</th>
            <th>Amount (₱)</th>
            <th>Donated At</th>
         </tr>
      </thead>
      <tbody>
         <?php if($select_donations->rowCount() > 0): ?>
            <?php while($donation = $select_donations->fetch(PDO::FETCH_ASSOC)): ?>
               <tr>
                  
                  <td><?= htmlspecialchars($donation['name']); ?></td>
                  <td><?= htmlspecialchars($donation['address']); ?></td>
                  <td>&#8369;<?= number_format($donation['amount'], 2); ?></td>
                  <td><?= $donation['donated_at']; ?></td>
               </tr>
            <?php endwhile; ?>
         <?php else: ?>
            <tr>
               <td colspan="5">No donations yet!</td>
            </tr>
         <?php endif; ?>
      </tbody>
   </table>

   <h2 class="total">Total Donations: <span>&#8369;<?= number_format($total, 2); ?></span></h2>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
