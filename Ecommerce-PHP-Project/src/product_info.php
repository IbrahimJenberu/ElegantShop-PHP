
<?php

session_start();

include "connect.php";

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
    <title>product info</title>

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
    justify-content: space-around;
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
}
span{
        color:#f21b3f;
    }
    button{
            padding: 7px 30px;
            background-color: #f21b3f;
            color: white;
            border: none;

        }
        .add{
            text-decoration: none;
            color: white;
            padding: 8px 20px;
            text-align: center;
            background-color: #a58e7c;
            border: 3px solid #a58e7c;
            color: #fff;
            position: relative;
            top: 225px;
            left: 230px;
    }

    .back{
            text-decoration: none;
            color: white;
            padding: 8px 20px;
            text-align: center;
            background-color: #a58e7c;
        border: 3px solid #a58e7c;
        color: #fff;
            position: relative;
            top: 35px;
            left: 15px;
    }
    


    table{
        margin: 150px auto;
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
        background-color: #B7B7B7;

    }
    td {
        border: 1px solid #9d9d9d;
    }
    tr {
        width: 900px;
        height: 50px;
        border-top: 1px solid #9d9d9d;
        text-align: center;
    }
    tr:nth-child(odd){
        background-color: #65647C;
    }
    a{
        text-decoration: none;
        padding: 8px 20px;
        color: white;
    }

    .edit{
        background-color: lightseagreen;
        margin: 25px;
        padding: 5px 15px;
    }
    .delete{
        background-color: lightcoral;
        padding: 5px 15px;
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

.search-container{
    position: relative;
    top: 60px;
    left: 550px;
    width: 40%;
    

}
.search-container input{
    padding: 10px 20px;
    background-color: #E8F0FE;
    border: none;
    color: #1f2327;
    font-size: 20px;
    outline: none;

}
.search-container input[type='submit']
{
    padding: 10.5px 20px;
    margin-left: -3px;
    background-color: #f21b3f;
    border: none;
    color:  #E8F0FE;
    font-size: 20px;
}
    </style>
</head>
<body>
<header class="header-container">

<nav>
<a href="customer_info.php"><span>*</span>CUSTOMER INFO</a>
<a href="product_info.php"><span>*</span>PRODUCT INFO</a>
<a href="view_transaction.php"><span>*</span>VIEW ORDER</a>
<a href="view_feedback_history.php"><span>*</span>FEEDBACKS</a>

<form action="adminPage.php" method="post">
<button name="logout" class="logout">Log out</button>
</form>
</nav>
</header>

<form action="product_info.php" method="post" class="search-container">
    <input type="search" name="search" placeholder="search by id">
    <input type="submit" name="submit" value="Search" >
</form>




<?php



if(isset($_POST['submit'])){

    $search=$_POST['search'];
   
    $sql="SELECT * FROM product where id='$search'";
    $result=mysqli_query($con,$sql);
  
  
  if(mysqli_num_rows($result)>0){
  
  
          echo "<table border='0' cellpadding='10' cellspacing='0'>
          <tr><th>Id</th><th>Product_Name</th><th>Product_Price</th><th>Image</th><th>Operations</th></tr>";
        while ($row=mysqli_fetch_assoc($result)){
   
          echo "<tr>
          <td>$row[id]</td>.
          <td>$row[productName]</td>
          <td>$row[price]</td>
          <td>$row[image]</td>
          <td>
          <a class='edit' href='editProduct.php?id=$row[id]'>Edit</a>
          <a class='delete' onClick=\"javascript:return confirm(' are sure of deleting this product');\"  href='deleteProduct.php?id=$row[id]'>Delete</a>
          
          </td>
  
          </tr>";
  
      }
      echo "</table>";
      exit;
  }
       else{
        echo "<script>alert('product not found')</script>";
       }
   
  
   
   }

   


?>





  <a href="addProduct.php" class="add">ADD product</a>
<h1>Product Information</h1>
</body>
</html>

<?php









 $sql="SELECT * FROM product";
  $result=mysqli_query($con,$sql);


if(mysqli_num_rows($result)>0){


        echo "<table border='0' cellpadding='10' cellspacing='0'>
        <tr><th>Id</th><th>Product_Name</th><th>Product_Price</th><th>Image</th><th>Operations</th></tr>";
      while ($row=mysqli_fetch_assoc($result)){
 
        echo "<tr>
        <td>$row[id]</td>.
        <td>$row[productName]</td>
        <td>$row[price]</td>
        <td>$row[image]</td>
        <td>
        <a class='edit' href='editProduct.php?id=$row[id]'>Edit</a>
        <a class='delete' href='deleteProduct.php?id=$row[id]'>Delete</a>
        </td>

        </tr>";

    }
    echo "</table>";

}



?>
