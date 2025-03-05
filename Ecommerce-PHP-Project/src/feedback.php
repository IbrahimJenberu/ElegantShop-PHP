
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
    <link rel="stylesheet" href="style.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #343a40;
            padding-bottom: 200px;
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
        nav a:hover {
    scale: 1.1;
    color: #E8F0FE;
}

        .form{
           
            width: 37vw;
            height: 64vh;
            display: flex;       
            flex-direction: column;
            justify-content: space-evenly;
            margin: 10px auto;
            }
        select{
            width: 50%;
            margin-right: 17px;
            padding: 5px;
            font-size: 15px;
            background-color: transparent;
            outline: none;
            border: none;
            background-color: red;
        }
        textarea{
            width: 100%;
            margin-right: 10px;
            margin-top: 15px;
            font-size: 15px;
            color: white;
            background-color: transparent;
            outline: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #1f2327;
            
        }

        h1{
            text-align: center;
            margin-top: 70px;
            color: white;
            font-size: 35px;
            font-weight: bold;
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
            color: white;
            background-color: #1f2327;
            outline: none;
            border: none;
            border-radius: 5px;
        }
       
        div label{
            width: 50%;
            margin-left: 5px;
            font-size: 20px;
            display: flex;
             color: #D4D4D4;
             margin-bottom: -12px;
        }
        
        input[type="submit"]{
            width: 100%;
            margin: 0 auto;
            padding: 10px 20px;
            margin-right: 36.4%;
            border-radius: 5px;
            background-color: #f21b3f;
            outline: none;
            font-size: 20px;
            color: white;
            border: none;
        
        }
        input[type="submit"]:hover {
            opacity: 0.7;
        }
        
    
    span{
        color:#f21b3f;
    }

.logout{
    padding: 7px 30px;
    background-color: #f21b3f;
    color: white;
    border: none;
    margin-left: 80px;

}
.logout:hover {
    opacity: 0.7;
}

    </style>
</head>
<body>
<header class="header-container">
      <div class="logo-container">
        <img src="images/perfect-logo.png" alt="">

      </div>
      <nav>
        <a href="index.html"><span>*</span>HOME</a>
        <a href="customerPage.php"><span>*</span>CATEGORIES</a>   
        <a href="login_page.php"><span>*</span>LOGIN</a>
        <a href="feedback.php"><span>*</span>CONTACT</a>
        <form action="adminPage.php" method="post">
          <button name="logout" class="logout">Log out</button>
          </form>
      </nav>
  </header>



<h1>Contact Us</h1>
<div class="text-part">
<h2>Our Team LIstens To You.</h2>
 <h3>If you have any questions, please feel free to contact us.
Please enter a valid email address to receive our reply.</h3>
</div>

    
    <form action="feedback.php" class="form" method="POST">

     <div>
        <label for=""><span>*</span>Name</label><br>
        <input type="text" name="name" placeholder="Enter your name"><br>
     </div>
     <div>
        <label for=""><span>*</span>Email</label><br>
        <input type="text" name="email" placeholder="Enter your email"><br>
     </div>
     <div>
        <label for="message"><span>*</span>Message</label>
        <textarea name="message" id="message" cols="90" rows="6" placeholder="Put Message here"> </textarea>
     </div>
     <input type="submit" value="Send" name="submit">
 
    </form>


</body>
</html>

<?php


   include "connect.php";


   if(isset($_POST['submit'])){

    $full_name=$_POST['name'];
    $message=$_POST['message'];
    $email=$_POST['email'];


    if(empty($full_name)||empty($message)||empty($email)){
   

        echo "<script>alert('fill out all fields')</script>";
        exit;
    
    
       }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

        echo "<script>alert('invalid email')</script>";
        exit;

    }



    $sql1="SELECT *FROM feedback WHERE email='$email' AND message='$message'";
   $result=mysqli_query($con,$sql1);
    if(mysqli_num_rows($result)>0){

    echo "<script>alert('feedback already sent')</script>";
    exit;

    }


    $sql="INSERT INTO feedback(fullName,email,message)
    values(?,?,?)";

    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"sss", $full_name,$email,$message);

    if(mysqli_stmt_execute($stmt)){

     echo "<script>alert('feedback sent')</script>";

    }
    else{
        echo "<script>alert('feedback not sent!')</script>";
        }

   }
     




?>
