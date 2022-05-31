<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, ($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
    $row = mysqli_fetch_assoc($select_users);
    if($row['user_type'] == 'admin'){
         
         header('location:adminprd.php'); }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style1.css">

</head>
<?php include 'header.php' ?>
<body>
   
<div class="regist">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="regbox">
      <input type="password" name="password" placeholder="enter your password" required class="regbox">
      <input type="submit" name="submit" value="login now" class="btn">
      
   </form>

</div>

</body>
<?php include 'footer.php' ?>
</html>