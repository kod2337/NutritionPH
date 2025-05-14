<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'Payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

$filter = "";
if(isset($_GET['payment_method'])) {
    $filter = $_GET['payment_method'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Orders</title>
   <link rel="icon" type="image/png" href="admin_images/NourishedPHlogo.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }
      table, th, td {
         border: 1px solid #ddd;
         padding: 10px;
         text-align: center;
      }
      th, td {
         padding: 10px;
      }
      th {
         background: black;
         color: var(--white);

      }
      .btn {
         padding: 5px 10px;
         cursor: pointer;
         text-decoration: none;
         color: white;
         border-radius: 5px;
      }
      .update-btn {
         background:#f39c12;
      }
      .delete-btn {
         background: #dc3545;
      }
      .filter-box {
         text-align: right;
         margin-bottom: 10px;
      }
   </style>
   <script>
      function filterOrders() {
         let paymentMethod = document.querySelector('input[name="payment_filter"]:checked');
         let method = paymentMethod ? paymentMethod.value : '';
         window.location.href = 'placed_orders.php?payment_method=' + method;
      }
   </script>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="placed-orders">
   <h1 class="heading">Placed Orders</h1>
   
   <div class="filter-box">
      <label><input type="radio" name="payment_filter" value="Cash" onclick="filterOrders()" <?= ($filter == 'Cash') ? 'checked' : '' ?>> Cash</label>
      <label><input type="radio" name="payment_filter" value="Gcash" onclick="filterOrders()" <?= ($filter == 'Gcash') ? 'checked' : '' ?>> GCash</label>
      <label><input type="radio" name="payment_filter" value="" onclick="filterOrders()" <?= ($filter == '') ? 'checked' : '' ?>> All</label>
   </div>

   <table>
      <tr>
         <th>User ID</th>
         <th>Placed On</th>
         <th>Name</th>
         <th>Email</th>
         <th>Number</th>
         <th>Address</th>
         <th>Total Products</th>
         <th>Total Price</th>
         <th>Payment Method</th>
         <th>Payment Status</th>
         <th>Actions</th>
      </tr>
      <?php
         $query = "SELECT * FROM `orders`";
         if ($filter) {
            $query .= " WHERE method = ?";
            $select_orders = $conn->prepare($query);
            $select_orders->execute([$filter]);
         } else {
            $select_orders = $conn->prepare($query);
            $select_orders->execute();
         }

         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <tr>
         <td><?= $fetch_orders['user_id']; ?></td>
         <td><?= $fetch_orders['placed_on']; ?></td>
         <td><?= $fetch_orders['name']; ?></td>
         <td><?= $fetch_orders['email']; ?></td>
         <td><?= $fetch_orders['number']; ?></td>
         <td><?= $fetch_orders['address']; ?></td>
         <td><?= $fetch_orders['total_products']; ?></td>
         <td>₱<?= $fetch_orders['total_price']; ?></td>
         <td><?= $fetch_orders['method']; ?></td>
         <td>
            <form action="" method="POST">
               <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
               <select name="payment_status">
                  <option value="<?= $fetch_orders['payment_status']; ?>" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                  <option value="pending">Pending</option>
                  <option value="completed">Completed</option>
               </select>
               <button type="submit" class="btn update-btn" name="update_payment">Update</button>
            </form>
         </td>
         <td>
            <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="btn delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
         </td>
      </tr>
      <?php
         }
      } else {
         echo '<tr><td colspan="11">No orders placed yet!</td></tr>';
      }
      ?>
   </table>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
