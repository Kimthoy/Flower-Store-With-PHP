<?php

@include 'config.php';



if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'Product added to cart successfully';
    }
}
// Check if the user is logged in, otherwise redirect to login page


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<?php
@include('user_header.php');
?>


<div class="min-h-screen flex flex-col">
  <!-- Hero Section -->
 <section class="bg-cover bg-center py-2 flex items-center justify-center text-center" style="background-image: url('images/OIP (2).jpg'); height: 100vh; background-position: center;">
  <div class="p-6 rounded-md bg-white bg-opacity-60">
    <h2 class="text-4xl text-black font-bold mb-4">Welcome to Bloom Haven</h2>
    <p class="text-lg text-black mb-6">Fresh Flowers for Every Occasion</p>
    
    <p class="text-md text-black mb-6 px-4 md:px-12">
      At Bloom Haven, we believe that flowers have the power to express emotions and create lasting memories. Whether you're celebrating a special moment, honoring a loved one, or simply brightening up your home, our carefully curated selection of flowers is here to make every occasion unforgettable.
    </p>
    
    <p class="text-md text-black mb-6 px-4 md:px-12">
      Our collection features a wide variety of flowers, including roses, lilies, sunflowers, and more. All of our flowers are sourced from the best local farms, ensuring their quality and freshness. We offer custom arrangements that are perfect for weddings, anniversaries, birthdays, and other important events.
    </p>

    <button class="bg-green-600 text-black py-2 px-6 rounded-md hover:bg-green-700 transition-all mt-4">Shop Now</button>
  </div>
</section>


 <section class="products flex-grow  py-16 bg-gray-100">
   <div class="container mx-auto">
       <h1 class="text-4xl font-bold text-center mb-8">Latest Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6">
      <?php
  
      @include 'config.php';
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){

         
      ?>
      

    <form action="" method="post" class="bg-white shadow-md rounded-lg p-4">
  <div class="box">
    <!-- Image with fixed dimensions -->
    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" 
         alt="Product Image" 
         class="rounded-md mb-4 w-full h-48 object-cover">
    
    <!-- Product name with text truncation -->
    <h3 class="text-xl font-semibold overflow-hidden text-ellipsis whitespace-nowrap" style="max-width: 100%;"> 
      <?php echo $fetch_product['name']; ?>
    </h3>
    
    <!-- Price -->
    <div class="text-green-600 text-lg font-bold mb-2">$<?php echo $fetch_product['price']; ?>/-</div>
    
    <!-- Hidden input fields -->
    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
    
    <!-- Add to Cart button -->
    <button type="submit" 
            class="btn w-full py-2 bg-green-600 text-white rounded-md hover:bg-green-700" 
            name="add_to_cart">
      Add to Cart
    </button>
  </div>
</form>

      <?php
         };
      };
      ?>
    </div>
   </div>
   
  </section>

  <footer class="bg-green-600 text-white text-center py-4">
    <p>&copy; 2024 Bloom Haven. All rights reserved.</p>
  </footer>
</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>