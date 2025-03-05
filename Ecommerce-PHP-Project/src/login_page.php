


<?php

session_start();

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
    width: 60%;
    height: 17vh;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    right: 160px;

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
            background-color: #1f2327;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
            margin: 30px auto;
            box-shadow: 0px 0px 5px 1px black;
        }
        .form div{

            width: 60%;
            display: flex;
        }
        .top-div{
           
            width: 150%;
            height: 27vh;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            position: relative;
            margin-top: 20px;
        }
        input{
            width: 25vw;
            font-size: 16px;
            padding: 9px 12px;
            border-radius: 5px;
            outline: none;
            background-color: #E8F0FE;
        }
        /* input[type="radio"]{
            width: 10%;
        } */
        label{
            font-size: 20px;
            color: #D4D4D4;
        }
        h1{
            height: 50px;
            width: 100%;  
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 0; 
            padding: 5px;
            font-size: 35px;
            text-align: center;
            color: white;
        
        }
        .top-lable {
            margin: 20px 280px -30px 0px;
            color: #D4D4D4;
            font-size: 17px;

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

<p style="color:red" id="demo"></p>
         <h1>login</h1>
    
  <form action="login_page.php" class="form" method="post">
<div class="top-div">
       <label for="" class="top-lable">Username</label><br>
        <input type="text" name="username" placeholder="username" required>
      <label for="" class="top-lable">Password</label><br>
        <input type="password" name="password" placeholder="password" required>
</div>


        <div>
            <label for="admin">Admin</label><input type="radio" name="role" value="admin" id="admin" required>
            <label for="customer">Customer</label><input type="radio" name="role" value="customer" id="customer" required>
        </div>


    
         <input type="submit" name="submit" value="Login">
         <h4>Not a member yet?<a href="registration.php"> Sign Up</a></h4>
  </form>
</body>
</html>






<?php




include ("connect.php");





    if(isset($_POST["submit"])){

       

   
        $username=$_POST["username"];
        $password=$_POST["password"];
        $role=$_POST["role"];

       
 

        if($role=="admin"){

            $sql="SELECT * FROM admin WHERE username='$username' and password='$password'";
            $result=mysqli_query($con,$sql);
          
            if(mysqli_num_rows($result)>0){
                
                $_SESSION["username"]=$username;
                $_SESSION["password"]=$password;
                $_SESSION["role"]=$role;
                echo "<script>window.location='adminPage.php'</script>";
                // header("Location: adminPage.php");
            }
          else{
            echo "<script>document.getElementById('demo').innerHTML='invalid username or password'</script>";
          }
    
        }


        if($role=="customer"){

            $sql1="SELECT * FROM customer WHERE username='$username' ";
            $result=mysqli_query($con,$sql1);
           

            
          
            if(mysqli_num_rows($result)>0){
  

                $row=mysqli_fetch_assoc($result);
                $encpassword=$row['password'];
                

                    if(strncmp(md5($password),$encpassword,strlen($encpassword))==0){

                        $_SESSION["username"]=$username;
                        $_SESSION["password"]=$password;
                        $_SESSION["role"]=$role;
                     echo "<script>window.location='customerPage.php'</script>";

                    }
                    else{
                        echo "<script>document.getElementById('demo').innerHTML='invalid username or password'</script>";

                    }
 
            }
          else{
            echo "<script>document.getElementById('demo').innerHTML='invalid username or password'</script>";
          }

            
        }
    
       
       
    }
    

mysqli_close($con);


?>

