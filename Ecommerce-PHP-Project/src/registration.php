
<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <link rel="stylesheet" href="style.css">

    <style>
         *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
                body {
            background-color: #343a40;
        }
              
        .text-part {
            width: 35vw;
            height: 16vh;
            margin:20px auto;
            text-align: center;
            font-size: 16px;
            display: flex;
            color: #D4D4D4;
            flex-direction: column;
            justify-content: end;
            word-spacing: 2px;
            line-height: 1.5;
        }
        h2{
            font-size: 20px;
            font-weight: 0;
        }
        h3{
            font-size: 20px;
        }

       

        .form{
            width: 37vw;
            height: 94vh;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            margin: 40px auto;
            }
        select{
            width: 50%;
            margin-right: 17px;
            padding: 5px;
            font-size: 15px;
            background-color: transparent;
            outline: none;
            border: none;
            border: 1px solid black;
        }
        textarea{
            width: 100%;
            margin-right: 10px;
            font-size: 15px;
            background-color: transparent;
            outline: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #1f2327;
            color: white;
        }

        h1{
            text-align: center;
            color: white;
            font-size: 35px;
            margin-top: 40px;
        }

        form div{
            display: flex;
            flex-direction: column;
            width:100%;
        }

        div input{
            width: 100%;
            font-size: 16px;
            padding: 13px 12px;
            background-color: #1f2327;
            outline: none;
            border: none;
            color: white;
            border-radius: 5px;
        }
       
        div label{
            width: 50%;
            font-size: 20px;
            margin-bottom: -10px;
            color: #D4D4D4;
        }
        
        input[type="submit"]{
            margin: 0 auto;
            width: 100%;
            padding: 10px;
            margin-right: 38.4%;
            border-radius: 5px;
            background-color: #f21b3f;
            outline: none;
            font-size: 20px;
            color: white;
            border: none;
        }
        
    .add{
        padding: 8px 20px;
        text-decoration: none;
        color: white;
       text-align: center;
        position: relative;
        background-color: #f21b3f;
        position: relative;
        top: 180px;
        left: 50px;
    }
    .logout{
            padding: 7px 30px;
            background-color: #f21b3f;
            color: white;
            border: none;

        }
    span{
        color:#f21b3f;
    }
    </style>
</head>
<body>

<header class="header-container">
      <div class="logo-container">
        <img src="images/perfect-logo.png" alt="">

      </div>
      <nav>
        <a href="index.html">HOME</a>
        <a href="customerPage.php">CATEGORIES</a>
        <a href="login_page.php">LOGIN</a>
        <a href="feedback.php">CONTACT</a>
      </nav>
  </header>


<a class="add" href="index.html">Back</a>

<h1>New User Registration</h1>

<form class="form" action="registration.php" method="post">

<div>
<label for=""><span>*</span>Name:</label><br>
<input type="text" name="name">
</div>

<div>
<label for="username"><span>*</span>Username:</label><br>
<input type="text" name="username">
</div>
<div>
<label for="password"><span>*</span>password:</label><br>
<input type="password" name="password">
</div>

<div>
<label for="email"><span>*</span>Email:</label><br>
<input type="email" name="email">
</div>

<div>
<label for="phone"><span>*</span>Phone:</label><br>
<input type="tel" name="phone" maxlength="10" minlength="10">
</div>

<div>
<label for="address"><span>*</span>Address:</label><br>
<textarea name="address" id="" cols="20" rows="3"></textarea>
</div>



<input type="submit" value="Register" name="submit">
 

</form>
    
</body>
</html>


<?php


 include "connect.php";


if (isset($_POST["submit"])){


     $full_name=$_POST['name'];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password=$_POST["password"];



    if(empty($full_name)||empty($address)||empty($phone)||empty($email)||empty($username)||empty($password)){
   

        echo "<script>alert('fill out all fields')</script>";
        exit;
    
    
       }


    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

        echo "<script>alert('invalid email')</script>";
        exit;

    }

    if(strlen($password)<6){

        echo "<script>alert('password must have at least 6 characters')</script>";
        exit;

    }
    if(strlen($username)<4){

        echo "<script>alert('username must have at least 4 characters')</script>";
        exit;

    }
    if(!preg_match("/[a-z]/i",$password)){

        echo "<script>alert('password must contain at least one letter ')</script>";
        exit;

    }
    if(!preg_match("/[0-9]/i",$password)){

        echo "<script>alert('password must contain at least one number ')</script>";
        exit;

    }
    if(!preg_match("/[0-9]/",$phone)){

        echo "<script>alert('invalid phone ')</script>";
        exit;

    }
    if(preg_match("/[a-z]/",$phone)){

        echo "<script>alert('invalid phone ')</script>";
        exit;

    }



   

    $sql2="SELECT * FROM customer WHERE username='$username'";
    $result=mysqli_query($con,$sql2);
  
    if(mysqli_num_rows($result)>0){
       
        echo "<script>alert('username already taken')</script>";
       exit;
        
    }

   


   
 
   $password_hash=md5($password);



$sql="INSERT INTO customer(full_name,username,password,email,phone,address)
       values(?,?,?,?,?,?)";
    
    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"ssssss",$full_name,$username,$password_hash,$email,$phone,$address);
  
   


    if(mysqli_stmt_execute($stmt)){




        echo "<script>alert('you have sucessfully registered!')</script>";

    }
    else
    {
        echo "<script>alert('Dear customer you have been successfully registered')</script>";
    }

    mysqli_close($con);

    mysqli_stmt_close($stmt);


}

?>
