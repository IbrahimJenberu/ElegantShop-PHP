


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
span{
        color:#f21b3f;
    }
    button{
            padding: 7px 30px;
            background-color: #f21b3f;
            color: white;
            border: none;

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



<form action="customer_info.php" method="post" class="search-container">
    <input type="search" name="search" placeholder="search by username">
    <input type="submit" name="submit" value="Search" >
</form>



<?php



if(isset($_POST['submit'])){

    $search=$_POST['search'];
   
       $sql3="SELECT * FROM customer where username='$search'";
       $result=mysqli_query($con,$sql3);
       
       if(mysqli_num_rows($result)>0){
       
       
               echo "<table  cellpadding='10' cellspacing='0'>
               <tr><th>Id</th><th>Address</th><th>Email</th><th>Phone</th><th>Username</th><th>Password</th></tr>";
           while ($row=mysqli_fetch_assoc($result)){
        
               echo "<tr><td>$row[id]</td>.
               <td>$row[address]</td>
               <td>$row[email]</td>
               <td>$row[phone]</td>
               <td>$row[username]</td>
               <td>$row[password]</td>
               
       
               </tr>";
       
           }
           echo "</table>";
           exit;
              
       }
       else{
        echo "<script>alert('user not found')</script>";
       }
   
  
   
   }

   


?>



    
  <a class="add" href="registration2.php">Add customer</a>
<h1>Customer Information</h1>



</body>
</html>

   

<?php













$sql1="SELECT * FROM customer";
$result=mysqli_query($con,$sql1);

if(mysqli_num_rows($result)>0){


        echo "<table  cellpadding='10' cellspacing='0'>
        <tr><th>Id</th><th>Address</th><th>Email</th><th>Phone</th><th>Username</th><th>Password</th><th>Operations</th></tr>";
    while ($row=mysqli_fetch_assoc($result)){
 
        echo "<tr><td>$row[id]</td>.
        <td>$row[address]</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[username]</td>
        <td>$row[password]</td>
        <td>
        <a class='edit' href='editCustomer.php?id=$row[id]'>Edit</a>
        <a class='delete' onClick=\" javascript: return confirm(' are sure of deleting this customer');\" href='deleteCustomer.php?id=$row[id]'>Delete</a>
        </td>

        </tr>";

    }
    echo "</table>";
       
}

?>


