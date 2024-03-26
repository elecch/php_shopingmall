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
   <title>elecch?</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      form {
         
      }
   </style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>elecch?</h3>
   <p> <a href="home.php">홈으로 가기</a> </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>신속하고 신선하게, elecch이 여러분의 문 앞까지 맛있는 라면을 배달합니다. 어디서나, 언제든, elecch과 함께라면 최고의 라면을 집에서 즐길 수 있습니다.</p>
         <p>elecch은 라면을 사랑하는 모든 이들을 위해 마음을 담아 배송합니다. 맛의 만족을 집 앞으로 직접 전달하는 elecch, 라면 배송의 새로운 표준을 제시합니다.</p>
      </div>

   </div>

</section>
<h1 class="title">구매 후기 작성</h1>
<form action="submit_review.php" method="post" class="review-form">
    <div class="box">
        <label for="nickname">닉네임:</label>
        <input type="text" id="nickname" name="nickname" required>
        <label for="review">후기:</label>
        <textarea id="review" name="review" required></textarea>
    </div>
    <div class="form-group">
        <label for="rating">별점:</label>
        <select name="rating" id="rating">
            <option value="1">1 별</option>
            <option value="2">2 별</option>
            <option value="3">3 별</option>
            <option value="4">4 별</option>
            <option value="5">5 별</option>
        </select>
    </div>
    <button type="submit" class="btn">후기 제출</button>
</form>
   


<section class="reviews">

   <h1 class="title">구매 후기</h1>

   <div class="box-container">

      <div class="box">
         <h3>고객 박OO님</h3>
         <p>주문한 라면이 정말 빠르게 도착했어요, 포장도 깔끔해서 만족스러웠습니다</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         
      </div>

      <div class="box">
         <h3>고객 이OO님</h3>
         <p>다양한 종류의 라면을 집에서 편하게 즐길 수 있어서 좋아요. 매번 못먹어본 맛을 새롭게 발견하는 재미가 있네요</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         
      </div>

      <div class="box">
         <h3>고객 임OO님</h3>
         <p>"아이가 라면을 좋아해요. 아이가 좋아하는 라면을 쉽게 주문할 수 있어서 편리해요</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         
      </div>


   </div>
</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>