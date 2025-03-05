


<?php


include "connect.php";
session_start();

//  if(!(isset($_SESSION["username"]))){

//     header("Location: login_page.php"); 

//  }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
   
   <style>
      /* *{
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      } */
    
     .container{
      display: grid;
      grid-template-columns: 1fr 1fr 1fr 1fr;
      margin: 50px auto;
      width: 80%;

    
     }


      .carts{
         width: 90%;
         height: 70vh;
         font-style: normal;
         text-transform: uppercase;
         /* display: flex;
         flex-direction: column;
         justify-content: space-between; */
      }
      img{
         width: 100%;
         height: 50vh;
      }
      p{
         margin: 10px;
         font-size: 1.71429em;
         color: #a58e7c;
         margin: 10px 0;
      }
      input{
         width: 30%;
         margin-top: 7px;
      }
      input[type='submit']{
         padding: 5px 12px;
         background-color: lightseagreen;
         border: none;
         border-radius: 10px;
         width: 60%;
         margin-top: 15px;
        
      }
      
      
      .name{
         color: black;
         font-size: 20px;
         font-size: 1.3rem;
    text-decoration: none;
    font-weight: bold;
    color: #4d4d4d;
    margin: 10px 0 0 0;
    text-transform: uppercase;
    font-style: normal;
      }
      .price{
         color: red;
         font-size: 17px;
         font-size: 1.71429em;
         color: #a58e7c;
         margin: 0px 0;
         font-style: normal;
      }
      .delete-price {
    font-size: 1.29em;
    color: #9d9d9d;
    margin: 0;
}
      p a{
         text-decoration: none;
         color: black;
      }
      .add:hover{
         border: 2px solid gray;
         background-color: transparent;
      }
      span{
    color:#f21b3f;
}
h1{
        color: black;
        font-size: 3.5rem;
        font-family: cursive;
        text-align: center;
        margin-top: 60px;
        animation-name: h1;
        animation-duration: 2s;
        animation-delay: 0s;
    }
    @keyframes h1 {
    0%{transform: translateX(800px);}
}
.cart-btn{
    z-index: 400;
    background-color: #a58e7c;
    border: 3px solid #a58e7c;
    color: #fff;
    position: relative;
    left: 15px;
    top: -150px;
    font-size: 17px;
    padding: 10px 40px;


}
.cart-btn:hover {
   background-color: #fff;
   color: #a58e7c;

}
 a{
   text-decoration: none;
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



  <h1>Shopping Cart</h1>
   
  <div class="container">
  <?php

$sql="SELECT * FROM product";
$result=mysqli_query($con,$sql); 


if(mysqli_num_rows($result)>0){


     
    while ($row=mysqli_fetch_assoc($result))
    { 

      ?>

  <div class="carts">
  <img src="<?php echo 'pics/'.$row['image']; ?>" alt="">

  <p class="name"><?php echo $row['productName']; ?></p>
  <p class="price">ETB <?php echo $row['price']; ?></p>
  <h6 class="delete-price"><del>ETB  <?php echo $row['price']+300; ?></del></h6>

  <form action="cart.php" method="post">

  <a class="cart-btn" href="orderPage.php?id=<?php echo $row['id']; ?>">Add to cart</a>
  
  <input type="hidden"  name="name" value="<?php echo $row['productName']; ?>"><br>
  <input type="hidden"  name="id" value="<?php echo $row['id']; ?>"><br>
  <input type="hidden"  name="price" value="<?php echo $row['price']; ?>" >

  </form>
  
 



 
  </div>

  <?php  
 }
}
else{
   echo "<script>alert(cannot obtain images)</script>";
}
  ?>

  </div>


  <footer>
    <div class="inner-div">
      <div class="inner-top">
        <div class="adress">
          <h6 class="item-price">ADDRESS</h6>
          <h6 class="delete-price">Sikela, Nigid Bank Bestejerba</h6><br>
            <p><a class="link" href="tel">Phone: +251917577381</a></p>
            <p><a class="link" href="gmail.com">Email: ebrahim@gmail.com</a></p>

        </div>
        <div class="service">
          <h6 class="item-price">OUR SERVICES</h6>
          <h6 class="delete-price">Order History<br>
            Return</h6>

        </div>
        <div class="payment">
          <h6 class="item-price">PAYMENTS</h6>
          <h6 class="delete-price">Secured Payment</h6>
          <div class="payment-container">
            <a href=""><img src="images/CBE-img.jpg" alt=""></a>
            <a href=""><img src="images/amole-img.jpg" alt=""></a>
            <a href=""><img src="images/telebirr-img.png" alt=""></a>
            <a href=""><img src="images/apolo-img.jpg" alt=""></a>

          </div>

        </div>

      </div>
      <div class="inner-bottom">
        <div class="social-media-container">
          <a href="www.facebook.com"><img src="images/facebook-icon.png" alt=""></a>
          <a href="www.twitter.com"><img src="images/twitter-icon.png" alt=""></a>
          <a href="pinterest.com"><img src="images/pintrest-icon.png" alt=""></a>
          <a href="www.instagram.com"><img src="images/instagram-icon.png" alt=""></a>

        </div>
        <div class="copy-container">
          <h6 class="copy-text">Copyright © 2023 - All Rights Reserved</h6>


        </div>

      </div>

    </div>

  </footer>
 </body>
 </html>



      
 





