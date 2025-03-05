
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
    <title>view feedback</title>
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

        .clear{
        padding: 8px 20px;
        text-decoration: none;
        color: white;
        text-align: center;
        background-color: #f21b3f;
        border: 3px solid red;
        color: #fff;
        position: relative;
        top: 215px;
        left: 230px;
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
    

 <form action="view_feedback_history.php" method="post">

  <input type="submit" class="clear" onClick=" javascript: return confirm(' are sure of deleting all history');" value="clear history" name="submit">
 </form>

 <h1>Customers Feedback</h1>
</body>
</html>


<?php

$sql="SELECT * FROM feedback";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){


        echo "<table   border='0' cellpadding='10' cellspacing='0'>
        <tr><th>id</th><th>full_name</th><th>email</th><th>message</th></tr>";
    while ($row=mysqli_fetch_assoc($result)){
 
        echo "<tr><td>$row[id]</td>
        <td>$row[fullName]</td>
        <td>$row[email]</td>
        <td>$row[message]</td>
        </tr>";

    }
    echo "</table>";
       
}

else{
 
echo "<script>alert('there is no feedback history')</script>";
echo "<script>window.location='adminPage.php'</script>";


}




if(isset($_POST['submit'])){


  $sql1="DELETE FROM feedback where 1=1";

  if(mysqli_query($con,$sql1)){

    echo "<script>alert(' feedback history deleted' )</script>";
    echo "<script>window.location='adminPage.php'</script>";
  }
  else{
    echo "<script>alert(' feedback history not deleted' )</script>";
    exit;

  }


}


?>


