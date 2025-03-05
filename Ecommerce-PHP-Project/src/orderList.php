

<?php
session_start();

include "connect.php";


 if(!(isset($_SESSION["username"]))){

    header("Location: login_page.php"); 

 }





  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order list</title>
    <link rel="stylesheet" href="style.css">

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #343a40;
        }
        table{
        margin: 350px auto;
        width: 70%;
        color: white;
        border: 1px solid #9d9d9d;
        animation-name: h2;
    animation-duration: 2s;
    animation-delay: 0s;
        
        
    }
    @keyframes h2 {
    0%{transform: translateX(-800px);}
}
    th {
        height: 60px;
        width: 900px;
        border: 1px solid #9d9d9d;
    

    }
    td {
        border: 1px solid #9d9d9d;
    }
    tr {
        width: 900px;
        height: 70px;
        border-top: 1px solid #9d9d9d;
        text-align: center;
    }
    a{
        padding: 8px 20px;
        text-decoration: none;
        color: white;
    }
    .add{
       text-align: center;
       background-color: #a58e7c;
      border: 3px solid #a58e7c;
      color: #fff;
        position: relative;
        top: 225px;
        left: 230px;
    }
    .back{
        background-color: #a58e7c;
        border: 3px solid #a58e7c;
        color: #fff;
        position: absolute;
        top: 140px;
        left:10px;
    }

    .edit{
        background-color: lightseagreen;
        padding: 2px 5px;
    }
    .delete{
        background-color: lightcoral;
        padding: 2px 5px;
    }
    h1{
        text-transform: capitalize;
        color: white;
        font-size: 3.5rem;
        font-family: cursive;
        text-align: center;
        margin-top: 100px;
        margin-bottom: -100px;
        animation-name: h1;
    animation-duration: 2s;
    animation-delay: 0s;
    }
    @keyframes h1 {
    0%{transform: translateX(800px);}
}
        input[type="submit"]{
            margin-bottom: 10px;
            background-color: #f21b3f;
            border: none;
            color: white;
        }
        input[type="submit"]:hover{
            opacity: 0.8;
        }
        p{
            text-align: center;
            margin: 10px;
            color: white;
        }
        h4{
            margin-bottom: 20px;
            font-size: 18px;
            color: #D4D4D4;
        }
        a{
            margin-left: 5px;
            color: #eab308;
            text-decoration: none;
        }
        span{
    color:#f21b3f;
}
        a{
            text-decoration: none;
        }
   .buy{
     padding: 8px 40px;
     color: white;
     background-color: lightseagreen;
     margin: 0 auto;
     border: none;
     position: relative;
     bottom: 150px;
     left: 720px;
   }
   .back{
    padding: 8px 20px;
     color: white;
     background-color: lightseagreen;
     margin: 0 auto;
     border: none;
     position: absolute;
     top: 10px;
   }

    </style>
</head>
<body>


  <h1>YOUR ORDERS</h1>


  <?php



if($_SERVER["REQUEST_METHOD"]=="GET"){

    $username=$_GET['username'];
    $_SESSION['us']=$username;
    
    
    $sql= " SELECT * FROM   history where username='$username'";
    
    $result=mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result)>0){
    
        $sumAll=0.0;
            echo "<table style='margin:150px auto;width:70%;text-align:center' border='1' cellpadding='10' cellspacing='0'>
            <tr><th>id</th><th>product_name</th><th>product_size</th><th>price</th><th>quantity</th><th>total</th></tr>";
        while ($row=mysqli_fetch_assoc($result)){
    
            $total=(double)$row['quantity']*(double)$row['price'];
            
            $sumAll =$sumAll+  $total;
    
            
     
            echo "<tr><td>$row[id]</td>.
            <td>$row[productName]</td>
            <td>$row[product_size]</td>
            <td>$row[price]</td>
            <td>$row[quantity]</td>
            <td>$total</td>
           
    
            </tr>";
    
        }
        echo "<tr><td colspan='5'>Total</td><td>$sumAll</td></tr>";
        echo "</table>";
           
    }
    else{
    
         echo "<script>alert('you have not ordered yet!')</script>";
    }
    
    }




?>

    <a class="back" href="customerPage.php">Back</a>
    <form action="orderList.php" method="post">

     <input class="buy" type="submit" value="BUY" name="submit">

    </form>
</body>
</html>

<?php


   if(isset($_POST['submit'])){


   


    $sql="DELETE FROM history WHERE username='$_SESSION[us]' ";

     if(mysqli_query($con,$sql)){
        echo "<script>alert(' you have sucessfully buy those items ,we will bring them all safe')</script>";
        echo "<script>window.location='customerPage.php'</script>";
        
     }
     else{
        echo "<script>alert(' something wrong in buying the products')</script>";
     }


    }


?>
