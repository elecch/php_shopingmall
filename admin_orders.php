<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'");
   $message[] = ' 결제 상태가 변경되었습니다!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'");
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">총 주문목록</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`");
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> 유저 넘버 : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> 주문날짜 : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> 닉네임 : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> 전화번호 : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> 배송지 : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> 주문 정보 : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> 전체 주문가격  : <span>원<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> 지불 방식 : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> 적립포인트 : 10 * <?php echo $fetch_orders['total_products']; ?></p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">미결제</option>
               <option value="completed">결제 완료</option>
            </select>
            <input type="submit" value="수정" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('주문을 제거하실건가요?');" class="delete-btn">삭제</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">아직 주문이 없어요</p>';
      }
      ?>
   </div>

</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>