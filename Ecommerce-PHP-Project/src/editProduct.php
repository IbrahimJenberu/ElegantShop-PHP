
<?php
include "connect.php";

session_start();


if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }


if($_SERVER["REQUEST_METHOD"]=="GET"){

    $id=$_GET['id'];


    $sql="SELECT * FROM product where id={$id}";
    
    $result=mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result)==1){
    
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $name=$row["productName"];
        $price=$row["price"];
        $image=$row["image"];

        
    }

}
else
{


    if($_POST["submit"]){


    $id=$_POST["id"];
    $name=$_POST["name"];
    $price=$_POST["price"];
     
      $file_name=$_FILES["file"]['name'];
      $tmp_name=$_FILES["file"]['tmp_name'];
     

     


    do{
        if(empty($name)||empty($price)||empty($file_name)){

            echo "<script>alert('fill out all fields')</script>";
            echo "<script>window.location='product_info.php'</script>";
            
            exit;
           }

           $sql1= "UPDATE product SET productName='$name' , price='$price' , image='$file_name'  WHERE id={$id}";
       
           if(mysqli_query($con,$sql1)){

            echo "<script>alert('product updated sucessfully')</script>";
            echo "<script>window.location='product_info.php'</script>";


             
               exit;
           }
           else{
               echo "<script>alert('erorr in updating a product')</script>";
               echo "<script>window.location='product_info.php'</script>";
           
               exit;
           }


    }
    while(true);

}


}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>edit product</title>

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
      .form{
            width: 27vw;
            height: 52vh;
            display: flex;
            padding-top: 0;
            background-color: #1f2327;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            margin: 50px auto;
            box-shadow: 0px 0px 5px 1px black;
            border-radius: 5px;
      }
      .form div{
        width: 100%;
        flex-direction: column;
        display: flex;
       justify-content: space-between;
      }
      input{
        margin: auto;
        line-height: 2;
        padding: 8px 12px;
        background-color: #E8F0FE;
        border: none;
        font-size: 15px;
        width: 90%;
        border-radius: 5px;
      }

      input[type="file"]{
      margin-right: 41px;
      margin: auto;

      }
      input[type="submit"]{
        color: white;
        padding: 5px;
        background-color: #f21b3f;
        border: none;
        font-size: 20px;
        margin: auto;
  
      }

      label{
        color: #D4D4D4;
        font-size: 20px;
        margin: 10px 20px;
      }
      h1{
        text-align: center;
        color: white;
        font-weight: bold;
        margin-top: 50px;
      }
      .back{
        padding: 8px 20px;
        text-decoration: none;
        color: white;
        text-align: center;
        background-color: #f21b3f;
        position: relative;
        top: 0px;
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
<h1>Edit products</h1>



    
   <form class="form" action="editProduct.php" method="post" enctype="multipart/form-data">

   
    <div>
        <label for=""><span>*</span>Item name</label>
        <input type="text" name="name" placeholder="Enter Item name"  value="<?php echo $name; ?>" required>
    </div>

    <div>
        <label for=""><span>*</span>Item price</label>
        <input type="text" name="price" placeholder="Enter Item price" value="<?php echo $price; ?>" required>
    </div>
    <div>
        <label for=""><span>*</span>Item image</label>
        <input type="file" name="file" value="<?php echo $image; ?>" required>
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

  <input type="submit" value="submit" name="submit">


   </form>

   


</body>
</html>


