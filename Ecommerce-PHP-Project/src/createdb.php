
<?php

include "connect.php";


$sql="CREATE DATABASE projectdb";

if(!mysqli_query($con,$sql)){

     echo "datbase not created";

}
else{
     echo "you have created a database";
}




?>
