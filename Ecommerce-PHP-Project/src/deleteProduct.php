

<?php

include "connect.php";

session_start();

if(!(isset($_SESSION["username"])&&(($_SESSION["role"]=="admin")))){

    header("Location: login_page.php"); 

 }


 
 

if($_SERVER["REQUEST_METHOD"]=="GET"){
    echo "<script>
        let val=confirm('are you sure of deleting this product');
        
        if(val!=true)
            <?php  window.location=\'product_info.php\; ?>
        }
        
      </script>";

    $id=$_GET['id'];

    $sql="DELETE FROM product where id={$id}";
    if(mysqli_query($con,$sql)){
        
        echo "<script>alert('product deleted')</script>";
         header("location: product_info.php");
    }
    else{
        echo "<script>alert('product not deleted')</script>";
        header("location: product_info.php");
    }

}


?>
