

<?php

include "connect.php";

session_start();

if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }


if($_SERVER["REQUEST_METHOD"]=="GET"){

    $id=$_GET['id'];

      echo "<script>

   document.getElementsByClassName('delete')[0].addEventListener('click',function(){

    let val=confirm('are you sure of deleting this customer');

    if(val==false){
        window.location='customer_info.php';
    }

   });

</script>";

    $sql="DELETE FROM customer where id={$id}";
    if(mysqli_query($con,$sql)){

        echo "<script>alert('customer deleted sucessfully')</script>";
        echo "<script>window.location='customer_info.php'</script>";
        
    }
    else{
        echo "<script>alert('customer not deleted')</script>";
        echo "<script>window.location='customer_info.php'</script>";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
