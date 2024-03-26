<?php

include 'config.php';
session_start();

// URL에서 product_id 가져오기
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';

// 상품 정보를 가져오는 쿼리
$query = "SELECT * FROM `products` WHERE id='$product_id'";
$result = mysqli_query($conn, $query);

// 상품 정보가 존재하는 경우
if(mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    // 여기서 $product 변수에 상품의 정보가 담겨있습니다.
} else {
    // 상품 정보가 없는 경우
    echo "<p>상품을 찾을 수 없습니다.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $product['name']; ?></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="product-detail">
    <h2><?php echo $product['name']; ?></h2>
    <img src="photo/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p>가격: <?php echo $product['price']; ?>원</p>
    <?php if(!empty($product['video_url'])): ?>
        <video controls>
            <source src="<?php echo $product['video_url']; ?>" type="video/mp4">
            브라우저가 비디오를 지원하지 않습니다.
        </video>
    <?php endif; ?>
    <p>설명: <?php echo nl2br($product['description']); ?></p>
    <!-- 여기에 추가적인 상품 정보를 표시할 수 있습니다. -->
</div>

<?php include 'footer.php'; ?>

</body>
</html>
