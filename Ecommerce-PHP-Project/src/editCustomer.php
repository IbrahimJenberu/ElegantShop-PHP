



<?php
include "connect.php";

session_start();

if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }




if($_SERVER["REQUEST_METHOD"]=="GET"){

    $id=$_GET['id'];


    $sql="SELECT * FROM customer where id=$id";
    
    $result=mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result)==1){
    
        $row = mysqli_fetch_assoc($result);
        $id=$row['id'];
        $full_name=$row['full_name'];
        $address=$row["address"];
        $phone=$row["phone"];
        $email=$row["email"];
        $username=$row["username"];
        $password=$row["password"];

        
    }
    
    

}
else{


    if($_POST["submit"]){

    $id=$_POST["id"];
    $address=$_POST["address"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $username=$_POST["username"];
    $password=$_POST["password"];


    do{
        if(empty($address)||empty($phone)||empty($email)||empty($username)||empty($password)){

            echo "<script>alert('fill out all fields')</script>";
            echo "<script>window.location='customer_info.php'</script>";
            // header("location: customer_info.php");
            exit;
           }

           $sql1= " UPDATE customer SET address='$address' , phone='$phone',
           email='$email', username='$username' WHERE id={$id}";
       
           if(mysqli_query($con,$sql1)){
            echo "<script>alert('customer info upated')</script>";
            echo "<script>window.location='customer_info.php'</script>";
               exit;
           }
           else{
               echo "<script>alert('erorr in updating a customer')</script>";
               echo "<script>window.location='customer_info.php'</script>";
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
    <title>registration</title>

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
    color: #E8F0FE;
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
        .logout{
            padding: 5px 30px;
            background-color: #f21b3f;
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
   <a href="view_feedback_history.php"><span>*</span>CFEEDBACKS</a>

<form action="adminPage.php" method="post">
<button name="logout" class="logout">Log out</button>
</form>
      </nav>
  </header>


<h1>Edit Customer Information</h1>

<form class="form" action="editCustomer.php" method="post">

<div>
<label for=""><span>*</span>Name:</label><br>
<input type="text" name="name" value="<?php echo $full_name; ?>" required>
</div>

<div>
<label for="username"><span>*</span>Username:</label><br>
<input type="text" name="username" value="<?php echo $username; ?>" required>
</div>
<div>
<label for="password"><span>*</span>password:</label><br>
<input type="password" readonly name="password" value="<?php echo $password; ?>" required>
</div>

<div>
<label for="email"><span>*</span>Email:</label><br>
<input type="email" name="email" value="<?php echo $email; ?>"  required>
</div>

<div>
<label for="phone"><span>*</span>Phone:</label><br>
<input type="tel" name="phone" maxlength="10" minlength="10" value="<?php echo $phone; ?>" required>
</div>

<div>
<label for="address"><span>*</span>Address:</label><br>
<textarea name="address" id="" cols="20" rows="3" required><?php echo $address; ?></textarea>
</div>

<input type="hidden" name="id" value="<?php echo $id; ?>">

<input type="submit" value="Register" name="submit" >
 

</form>
    
</body>
</html>




