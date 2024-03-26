<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'photo/'.$image;
   $video_url = mysqli_real_escape_string($conn, $_POST['video_url']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);

   
   



   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'");

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, video_url, description) VALUES('$name', '$price', '$image', '$video_url', '$description')");
     
      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'");
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('photo/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'");
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', video_url = '$update_video_url', description = '$update_description' WHERE id = '$update_p_id'");
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'photo/'.$update_image;
   $update_video_url = mysqli_real_escape_string($conn, $_POST['update_video_url']);
   $update_old_image = $_POST['update_old_image'];
   $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);


   


   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'");
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('photo/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>상품 목록</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<section class="add-products">

   <h1 class="title">상품 등록</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>상품 추가</h3>
      <input type="text" name="name" class="box" placeholder="상품 이름 추가" required>
      <input type="number" min="0" name="price" class="box" placeholder="상품 가격 추가" required>
      <textarea name="description" class="box" required placeholder="상품 설명 추가"></textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="text" name="video_url" class="box" placeholder="상품 동영상 URL 추가" required>
      <input type="submit" value="상품 추가" name="add_product" class="btn">
   </form>

</section>



<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="photo/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">최저 <?php echo $fetch_products['price']; ?>원 / 포인트 10점 </div>
         <p class="description"><?php echo substr($fetch_products['description'], 0, 50) . '...'; ?></p>
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">수정</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">취소</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'");
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="photo/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="상품 이름 추가">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="상품 가격 추가">
      <textarea name="update_description" class="box" required placeholder="상품 설명 수정"><?php echo $fetch_update['description']; ?></textarea>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="text" name="update_video_url" value="<?php echo $fetch_update['video_url']; ?>" class="box" required placeholder="상품 동영상 URL 수정">
      <input type="submit" value="수정" name="update_product" class="btn">
      <input type="reset" value="취소" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>