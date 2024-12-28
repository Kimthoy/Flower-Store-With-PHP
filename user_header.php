  

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <?php
 @include("config.php");
session_start();
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
?>


<header class="bg-green-600 text-white">
  <div class="container mx-auto flex justify-between items-center py-4 px-6">
    <h1 class="text-2xl font-bold">Bloom Haven</h1>
    <nav>
      <ul class="flex space-x-6">
        <li><a href="index.php" class="hover:underline">Home</a></li>
        <li><a href="products.php" class="hover:underline">Products</a></li>
        <?php if (isset($_SESSION['username'])): ?>
         <li> <a href="cart.php" class="cart hover:underline">Cart <span>(<?php echo $row_count; ?>)</span> </a></li>
          <li><a href="logout.php" class="hover:underline">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php" class="hover:underline">Login</a></li>
          <li><a href="register.php" class="hover:underline">Register</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
</body>
</html>