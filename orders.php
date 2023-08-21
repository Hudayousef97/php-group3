<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   
     
 
 <section class="show-products">

   <div class="table-container">
      <table style="width: 90%; border-collapse: collapse; text-align: center;">
         <thead>
            <tr>
            
               <th style="padding: 8px; border: 1px solid #ccc;">Placed on :</th>
               <th style="padding: 8px; border: 1px solid #ccc;">Name :</th>
               <th style="padding: 8px; border: 1px solid #ccc;">Email :</th>
               <th style="padding: 8px; border: 1px solid #ccc;">Number :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Address :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Payment method :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Your orders  :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Total price :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Payment status :</th>
               <th style="padding: 8px; border: 1px solid #ccc;"> Photo :</th>

            </tr>
         </thead>
         <tbody>
           
               <?php

               if ($select_orders->rowCount() > 0) {
                  while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                     echo "<tr>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['placed_on']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>$<span>{$fetch_orders['name']}</span>/-</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['email']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['number']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['address']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['method']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['total_products']}</td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['total_price']} </td>";
                     echo "<td style='border: 1px solid #ccc; padding: 8px;'>{$fetch_orders['payment_status']}</td>";
                     echo "<td style='border: 1px solid #ccc;'><img src='../uploaded_img/{$fetch_orders['image_01']}' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";

                     echo "</tr>";
                  }
               } else {
                  echo '<tr><td colspan="5" style="border: 1px solid #ccc; padding: 8px;">No products added yet!</td></tr>';
               }
            ?>
         </tbody>
      </table>
   </div>
</section>     
   </div>
  
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>