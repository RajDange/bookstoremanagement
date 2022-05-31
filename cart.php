<?php
include 'config.php';

session_start();
 
$user_id = $_SESSION['user_id'];

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
 }
 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query2 failed');
    header('location:cart.php');
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
 
 </head>
 <?php include 'header.php'; ?>
 <body>
    
 
 <div class="contsec1b">
    <h3>shopping cart</h3>
    
 </div>
 <center>

        <h1 style="padding-top:10px ; margin-bottom:20px">Latest Products</h1>
         
      </center>
 <section class="show-books">
 
<div class="box-container">

<?php  
$grand_total = 0;
   $select_cart = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_cart) > 0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
?>
<form method="post" action="" class="box">
   
   <img class="img" src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
   <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times pull-right" id="xbut" onclick="return confirm('delete this from cart?');"></a>
<div class="name"><?php echo $fetch_cart['name']; ?></div>
<div class="price">Rs.<?php echo $fetch_cart['price']; ?>/-</div>
<input type="hidden" name="product_name" value="<?php echo $fetch_cart['name']; ?>">
<input type="hidden" name="product_price" value="<?php echo $fetch_cart['price']; ?>">
<input type="hidden" name="product_image" value="<?php echo $fetch_cart['image']; ?>">


</form>
<?php  $sub_total = ( $fetch_cart['price']); ?>
<?php
   $grand_total += $sub_total;
   }
}else{
   echo '<p class="empty">no  added yet!</p>';
}

    
?>
</div>


    <div style="margin-top: 2rem; text-align:center;">
       <a href="cart.php?delete_all" class="delete-btn " onclick="return confirm('delete all from cart?');">delete all</a>
    </div>
    <div class="proceed1">

       <div class="proceed">
          <p style="padding-top: 30px;">Grand total : <span>Rs.<?php echo $grand_total; ?>/-</span></p>
         </div>
         <div class="proceed">
            <a href="order.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
         </div>
      </div>
    
 </section>
 
</body>
<?php include 'footer.php'; ?>
 </html>