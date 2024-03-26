<header class="header">

   <div class="flex">

      <a href="admin_products.php" class="logo"><span>관리자페이지</span></a>

      <nav class="navbar">
         <a href="admin_products.php">상품등록 & 리스트</a>
         <a href="admin_users.php">유저관리</a>
         <a href="admin_orders.php">orders</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>유저이름 : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">로그아웃</a>
         <div><a href="login.php">login</a> | <a href="register.php">신규가입</a></div>
      </div>

   </div>

</header>