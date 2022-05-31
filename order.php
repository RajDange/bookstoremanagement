<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query 1failed');
   if(mysqli_num_rows($cart_query) > 0){
    while($cart_item = mysqli_fetch_assoc($cart_query)){
        $cart_products[] = $cart_item['name'];
        $sub_total = ($cart_item['price']);
        $cart_total += $sub_total;
      }
   }

   if($cart_total == 0){
      $message[] = 'your cart is empty';
    
   }else{
      mysqli_query($conn, "INSERT INTO `orderfinal`(user_id, name, number, email, method, adderss, total_price) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$cart_total')") or die('query2 failed');
      $message[] = 'order placed successfully!';
      mysqli_query($conn, "DELETE FROM `orders` WHERE user_id = '$user_id'") or die('query 3failed');
   }
}
   


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ORDER</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">

</head>
<?php include 'header.php'; ?>
<body>
<div class="contsec1b">
   <h3>ORDER</h3>
</div>

<section class="ordsec1">
   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query 4failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] );
            $grand_total += $total_price;
   ?>
   
   <p class="bookbox"> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rs.'.$fetch_cart['price'].'/-'; ?>)</span> </p>
   
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
    
   <div class="proceed"> Grand Total : <span>Rs.<?php echo $grand_total; ?>/-</span> </div>
   
</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place Your Order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>Your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>Pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <div class="ordbt">
      <input type="submit" value="order now" class="ordbtn" name="order_btn"></div>
   </form>

</section>


</body>
<?php include 'footer.php'; ?>
</html>