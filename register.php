<?php

include 'config.php';
if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, ($_POST['password']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style1.css">

</head>
<?php include 'header.php'; ?>
<body>
   
<div class="regist">

    
   <form action="" method="post">
      <h3>Register Now</h3><br>
      <input type="text" name="name" placeholder="enter your name" required class="regbox">
      <input type="email" name="email" placeholder="enter your email" required class="regbox">
      <input type="password" name="password" placeholder="enter your password" required class="regbox">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php" style="color:blue;">login now</a></p>
   </form>
   
</div>

</body>
<?php include 'footer.php'; ?>
</html>