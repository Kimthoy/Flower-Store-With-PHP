<?php
session_start(); 
@include 'config.php';

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
@include('user_header.php');
?>

<div class="container mx-auto p-6">
    <section class="shopping-cart">

        <h1 class="text-3xl font-semibold mb-6">Shopping Cart</h1>

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Image</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Quantity</th>
                    <th class="p-3 text-left">Total Price</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                $grand_total = 0;
                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                ?>

                <tr class="border-b">
                    <td class="p-3"><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt="" class="rounded-md"></td>
                    <td class="p-3"><?php echo $fetch_cart['name']; ?></td>
                    <td class="p-3">$<?php echo number_format($fetch_cart['price']); ?>/-</td>
                    <td class="p-3"><?php echo $fetch_cart['quantity']; ?></td>
                    <td class="p-3">$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
                    <td class="p-3">
                        <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </td>
                </tr>

                <?php
                    $grand_total += $sub_total;  
                    };
                };
                ?>

                <tr class="font-semibold">
                    <td><a href="products.php" class="bg-green-600 text-white px-6 py-2  rounded-md hover:bg-green-700">Continue Shopping</a></td>
                    <td colspan="3" class="text-right">Grand Total</td>
                    <td class="text-green-600">$<?php echo $grand_total; ?>/-</td>
                    <td>
                        <a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i> Delete All
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>

        <div class="checkout-btn mt-6 py-4">
            <a href="stripe.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?> bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Proceed to Checkout</a>
        </div>

    </section>
</div>

<script src="js/script.js"></script>

</body>
</html>
