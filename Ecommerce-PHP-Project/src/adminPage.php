<?php
 session_start();


 if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #343a40;
        }
        .header-container {
    width: 100%;
    height: 15vh;
    background-color: #1f2327;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.logo-container img {
    width: 100%;
    height: 15vh;
    margin-left: 30px;
    display: flex;
    background-size: cover;
    align-items: center;

}
nav {
    width: 90%;
    height: 17vh;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    position: relative;
    left: 100PX;
    

}
nav a{
    text-decoration: none;
    font-size: 1.6rem;
    color: #a58e7c;

}
nav a:hover {
    scale: 1.1;
    color: #E8F0FE;
}
        .container{
            width: 100%;
            height: 70px;
            background-color: lightseagreen;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        .container a{
            text-decoration: none;
            color: white;
            font-size: 25px;
            font-weight: 600;
        }
        button{
            padding: 7px 30px;
            background-color: #f21b3f;
            color: white;
            border: none;

        }

        .drop{
            position: relative;
        }
        
        
        .drop:hover .down{
            height: 80px;
        }
        span{
        color:#f21b3f;
    }
    h1{
        color: white;
        font-size: 3.5rem;
        font-family: cursive;
        text-align: center;
        margin-top: 100px;
        animation-name: h1;
    animation-duration: 2s;
    animation-delay: 0s;
    }
    @keyframes h1 {
    0%{transform: translateX(800px);}
}

    </style>
</head>
<body>
<header class="header-container">

      <nav>
   <a href="index.html"><span>*</span>HOME</a>
   <a href="customer_info.php"><span>*</span>CUSTOMER INFO</a>
   <a href="product_info.php"><span>*</span>PRODUCT INFO</a>
   <a href="view_transaction.php"><span>*</span>VIEW ORDER</a>
   <a href="view_feedback_history.php"><span>*</span>FEEDBACKS</a>

<form action="adminPage.php" method="post">
<button name="logout">Log out</button>
</form>
      </nav>
  </header>



      
     



</div>
    

<h1>WELLCOME TO ADMINS PAGE</h1>


</body>
</html>


<?php

 include "connect.php";



 
 
 

if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    header("Location: login_page.php");
}


?>
