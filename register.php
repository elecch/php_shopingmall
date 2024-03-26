<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'");

   if(mysqli_num_rows($select_users) > 0){
      $message[] = '이미 등록되있는 유저입니다!';
   }else{
      if($pass != $cpass){
         $message[] = '비밀번호가 다릅니다';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')");
         $message[] = '등록성공';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   
<div class="form-container">

   <form action="" method="post">
      <h3>가입하기</h3>
      <input type="text" name="name" placeholder="닉네임" required class="box">
      <input type="email" name="email" placeholder="이메일주소" required class="box">
      <input type="password" name="password" placeholder="비밀번호" required class="box">
      <input type="password" name="cpassword" placeholder="비밀번호확인" required class="box">
      <select name="user_type" class="box">
         <option value="user">사용자버전</option>
         <option value="admin">관리자버전</option>
      </select>
      <input type="submit" name="submit" value="회원가입 신청" class="btn">
      <p>이미 계정이 있다면? <a href="login.php">로그인 하기</a></p>
   </form>

</div>

</body>
</html>