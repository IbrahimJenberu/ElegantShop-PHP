
<?php

session_start();


if(!(isset($_SESSION["username"]))){

    header("Location: login_page.php"); 

 }

include "connect.php";

$username=$_SESSION["username"];

$sql1="SELECT * FROM customer WHERE username='$username'";
$result=mysqli_query($con,$sql1);

if(mysqli_num_rows($result)>0){

while ($row=mysqli_fetch_assoc($result))
    { 

         $full_name=$row['full_name'];
         $address=$row['address'];
         $phone=$row['phone'];
         $username=$row['username'];

    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orderPage</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
                body {
            background-color: #343a40;
        }
        table{
        margin: 50px auto;
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
     .back{
        text-decoration: none;
    padding: 8px 20px;
     color: white;
     background-color: lightseagreen;
     margin: 0 auto;
     border: none;
     position: absolute;
     top: 150px;
   }

   input[type='submit']{

    padding: 8px 20px;
     color: white;
     background-color: #f21b3f;
     margin: 0 auto;
     border: none;
     position: absolute;
     top: 520px;
     left: 696px;
     font-size: 17px;

   }
.order-list {
    padding: 10px 20px;
    background-color: lightseagreen;
    color: white;
    text-decoration: none;
    font-size: 18px;
    position: relative;
    top: -175px;
    left: 230px;
}
    @keyframes h2 {
    0%{transform: translateX(-800px);}
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
      <div class="logo-container">
        <img src="images/perfect-logo.png" alt="">

      </div>
      <nav>
        <a href="index.html"><span>*</span>HOME</a>
        <a href="customerPage.php"><span>*</span>CATEGORIES</a>   
        <a href="login_page.php"><span>*</span>LOGIN</a>
        <a href="feedback.php"><span>*</span>CONTACT</a>
      </nav>
  </header>
  <h1>BUY & FEEL SAFE</h1>

<a class="back" href="customerPage.php">Back</a>
  
  <form action="orderPage.php" method="post">
    <?php

if($_SERVER["REQUEST_METHOD"]=="GET"){

    $id=$_GET['id'];

    $_SESSION['id']=$id;

}

  $sql1="SELECT * FROM product where id={$_SESSION['id']}";
   $result=mysqli_query($con,$sql1);

if(mysqli_num_rows($result)>0){

   
        echo "<table style='margin:50 auto' border='1' cellpadding='10' cellspacing='0'>
        <tr><th>id</th><th>product_name</th><th>price</th><th>quantity</th><th>product_size</th></tr>";
    while ($row=mysqli_fetch_assoc($result)){
        $productName=$row['productName'];
        $price=$row['price'];
        
 
        echo "<tr><td>$row[id]</td>.
        <td>$row[productName]</td>
        <td>$row[price]</td>
        <td><input type='number' name='quantity' min='1' value='1'></td>
        <td><input type='number' name='size' min='37' value='37'></td>
      

        </tr>";

    }
    echo "</table>";
       
}

?>

<input type="submit" value="Add To Orderlist" name="submit">

  </form>

  <a class="order-list" href="orderList.php?username=<?php echo $_SESSION['username']; ?>">See Order List</a>

</body>
</html>

<?php

if(isset($_POST['submit'])){


    if($_SERVER["REQUEST_METHOD"]=="GET"){

        $id=$_GET['id'];
    
        $_SESSION['id']=$id;
    
    }


   $quantity=$_POST["quantity"];
   $product_size=$_POST['size'];
   

   $sql3="SELECT * from history WHERE username='$_SESSION[username]' AND id='$_SESSION[id]'";

     $result=mysqli_query($con,$sql3);

     if(mysqli_num_rows($result)>0){

        echo "<script>alert('item already added to order list!')</script>";
        exit;
     }
     else {
        


   $sql="INSERT INTO history(id,username,full_name,phone,address,productName,quantity,price,product_size)
       values(?,?,?,?,?,?,?,?,?)";
    
    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,"sssssssss",$_SESSION['id'],$username,$full_name,$phone,$address,$productName,$quantity,$price,$product_size);
  
   


    if(mysqli_stmt_execute($stmt)){

        echo "<script>alert('item inserted to orderlist')</script>";
       
    }
    else{
        echo "<script>alert('error in inserting to orderlist')</script>";

    }








    $sql1="INSERT INTO history2(id,username,full_name,phone,address,productName,quantity,price,product_size)
       values(?,?,?,?,?,?,?,?,?)";
    
    $stmt=mysqli_prepare($con,$sql1);
    mysqli_stmt_bind_param($stmt,"sssssssss",$_SESSION['id'],$username,$full_name,$phone,$address,$productName,$quantity,$price,$product_size);
  
   


    if(!mysqli_stmt_execute($stmt)){

        echo "<script>alert('error in inserting to orderlist')</script>";
    }


}
}

   





?>
