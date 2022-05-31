<?php

include 'config.php';

session_start();



if(isset($_POST['add_product'])){

   $name =  $_POST['name'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `product` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `product`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

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
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `product` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `product` WHERE id = '$delete_id'") or die('query failed');
   header('location:adminprd.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php include 'header.php' ?>
<body>
    <section>
        <center>
        <h1 style="padding-top:20px ; margin-bottom:20px">BOOKS</h1> 
        </center>
    
        <div class="adminprd1">
        
        
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add Book</h3>
            <input type="text" name="name" class="box" placeholder="enter product name" required>
            <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="formbtn" required>
            <input type="submit" value="add product" name="add_product" class="admbtn">
        </form>
        
        </div>
    </section>



    <section class="show-books">

        <div class="box-container">

            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `product`") or die('querys failed');
                if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <div class="box">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="img">
                <div class="name">
                    <?php echo $fetch_products['name']; ?>
                </div>
                <div class="price">
                    <?php echo  $fetch_products['price']; ?>/-
                </div>
                
                <a href="adminprd.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                    onclick="return confirm('delete this product?');">delete</a><br><br>
            </div>
            <?php
            }
                }else{
                echo '<p class="empty">no products added yet!</p>';
            }
        ?>
        </div>

        
</body>

<?php include 'footer.php' ?>
</html>