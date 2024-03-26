<?php
// 라면 상세정보를 가져오는 코드 (데이터베이스 연결 및 쿼리 포함)
include 'config.php';

// 상품 ID가 URL을 통해 전달되었는지 확인
if(isset($_GET['id'])){
   $product_id = $_GET['id'];
   $product_details_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'");
   if(mysqli_num_rows($product_details_query) == 1){
      $fetch_details = mysqli_fetch_assoc($product_details_query);
   } else {
      header('location:admin_products.php');
      exit;
   }
} else {
   header('location:admin_products.php');
   exit;
}


?>

<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>라면 상세 정보</title>
   <!-- 나머지 head 내용 -->
</head>
<body>
   
<section class="ramen-detail">
   <div class="container">
      <h2 class="title"><?php echo $fetch_details['name']; ?></h2>
      <div class="ramen-image">
         
      <a href="<?php echo $fetch_products['video_url']; ?>" target="_blank" class="option-btn">동영상 보기</a>
         <img src="photo/<?php echo $fetch_details['image']; ?>" alt="<?php echo $fetch_details['name']; ?>">
      </div>
      <div class="ramen-description">
         <p>가격: <?php echo $fetch_details['price']; ?>원</p>
         <p class="description"><?php echo $fetch_details['description']; ?></p>
      </div>
      <div class="ramen-video">
         <iframe width="560" height="315" src="<?php echo $video_url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
   </div>
</section>


</body>
</html>