<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>주문하기</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>주문 확인</h3>
   <p> <a href="home.php">홈으로 가기</a></p>
</div>

<section class="placed-orders">

   <h1 class="title">주문 내역</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> 주문날짜 : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> 닉네임 : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> 전화번호 : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> 배송지 : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> 지불 방식 : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> 주문 정보 : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> 전체 주문가격 : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> 거래 상황 : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>