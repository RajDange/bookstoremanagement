<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];


if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   
      mysqli_query($conn, "INSERT INTO `contact`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php include 'header.php' ?>
<body>
    <section >
    <div class="contsec1b">
            <h1>CONTACT US</h1>
        </div>
        <div class="contsec1">
            
            <div class="contsec1a">
            <form action="" method="post">
                <h3 style="text-align:center">Say Something!</h3><br>
                <label for="lname">Name</label><br>
                <input type="text" name="name" required placeholder="enter your name" class="box"><br>
                <label for="lname">Mail</label><br>
                <input type="email" name="email" required placeholder="enter your email" class="box"><br>
                <label for="lname">Number</label><br>
                <input type="number" name="number" required placeholder="enter your number" class="box"><br>
                <label for="lname">Message</label><br>
                <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea><br>
                <input type="submit" value="Send message" name="send" class="btn">
            </form>
            </div>
            
        </div>
    </section>
</body>
<?php include 'footer.php' ?>
</html>