<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flower Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
 

<?php
@include('user_header.php');
?>

  <!-- Hero Section -->
  <section class="bg-cover bg-center h-screen flex items-center justify-center text-center" style="background-image: url('images/OIP.jpg');background-size: cover;background-repeat: no-repeat;">
    <div class="bg-black bg-opacity-50 p-6 rounded-md">
      <h2 class="text-4xl text-white font-bold mb-4">Welcome to Bloom Haven</h2>
      <p class="text-lg text-gray-200 mb-6">Fresh Flowers for Every Occasion</p>
      <a href="#products" class="bg-green-500 text-white py-2 px-2 rounded hover:bg-green-700">Shop Now</a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-16 bg-white">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-semibold mb-6">About Us</h3>
      <p class="text-gray-700">At Bloom Haven, we are dedicated to providing the freshest and most beautiful flowers. Whether you're celebrating a special occasion or simply brightening someone's day, our exquisite arrangements are crafted with care and passion.</p>
    </div>
  </section>

  <!-- Products Section -->
  
<section id="products" class="py-16 bg-gray-100">
  <div class="container mx-auto">
    <h3 class="text-3xl font-semibold text-center mb-6">Our Products</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
      <?php
      // Include the database connection file
      @include 'config.php';

      // Fetch only 6 products from the database
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6");

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
      ?>
          <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="uploaded_img/<?php echo htmlspecialchars($fetch_product['image']); ?>" 
                 alt="Product Image" 
                 class="rounded-md mb-4 object-cover w-full h-48">
            <h4 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($fetch_product['name']); ?></h4>
           
            <p class="text-green-600 font-bold mb-4">$<?php echo htmlspecialchars($fetch_product['price']); ?></p>
            <h5>Wonderfull Flower for you !</h5>
          </div>
      <?php
        }
      } else {
        echo "<p class='text-center text-gray-600'>No products available.</p>";
      }
      ?>
    </div>
  </div>
</section>



  <!-- Contact Section -->
  <section id="contact" class="py-16 bg-white">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-semibold mb-6">Contact Us</h3>
      <p class="text-gray-700 mb-4">Have a question or want to place a custom order? Reach out to us!</p>
      <form class="max-w-md mx-auto">
        <input type="text" placeholder="Your Name" class="w-full mb-4 p-2 border rounded">
        <input type="email" placeholder="Your Email" class="w-full mb-4 p-2 border rounded">
        <textarea placeholder="Your Message" class="w-full mb-4 p-2 border rounded"></textarea>
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Send Message</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-green-600 text-white py-4">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Bloom Haven. All rights reserved.</p>
    </div>
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
