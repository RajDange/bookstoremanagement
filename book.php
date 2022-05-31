<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];


if(isset($_POST['Order'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];


   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }
   else{
   mysqli_query($conn, "INSERT INTO `orders`(user_id, name, price,  image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
   $message[] = 'added to cart!';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style1.css">

</head>
<?php include 'header.php'; ?>
<body>
<div class="contsec1b">
   <h3>OUR SHOP</h3>
   
</div>
<center>
        <h1 style="padding-top:10px ; margin-bottom:20px">Latest Products</h1>
        <a href="cart.php" class="fas fa-shopping-cart" id="admpan"> CART</a>
         
        </center>
<section class="show-books">



   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form method="post" action="" class="box">
      <img class="img" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="ORDER" name="Order" class="formbtn">
      
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

</section>

<?php include 'footer.php'; ?>



</body>
</html>